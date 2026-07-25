# Adivine la Palabra — Resumen para la defensa

Guía de estudio del funcionamiento completo del proyecto. Pensada para poder
explicar con tus palabras cómo funciona todo y responder repreguntas.

---

## 1. Stack y arquitectura general

**Frontend:** React (con Vite, en JavaScript) + Tailwind CSS v4.
**Backend:** PHP orientado a objetos + MySQL (con la extensión `mysqli`).
**Comunicación:** el frontend le pega a los `.php` del backend con `fetch`
(AJAX moderno), y el backend responde siempre en formato **JSON**.

El frontend y el backend son **dos aplicaciones separadas**:

- React corre en el servidor de desarrollo de Vite (`localhost:5173`).
- Los `.php` los sirve Apache (XAMPP) en `localhost`.

Como son dos orígenes distintos (puertos distintos), el navegador aplica la
política de **CORS** — por eso cada endpoint PHP manda cabeceras
`Access-Control-Allow-*` autorizando al origen `localhost:5173`.

> **Por qué separados:** React no "corre" en Apache durante el desarrollo;
> Vite compila el JSX en tiempo real. Para producción se haría `npm run build`,
> que genera HTML/CSS/JS estáticos en `dist/` que sí puede servir Apache.

---

## 2. Estructura de archivos

### Backend (`api/`)

| Archivo | Rol |
|---|---|
| `Db.php` | Función `conectar()`: crea la conexión mysqli. Un solo lugar con los datos de la base. |
| `Usuario.php` | Clase `Usuario`. Métodos estáticos `login()` y `registro()`. Maneja el hasheo de contraseñas. |
| `Palabra.php` | Clase `Palabra`. `obtenerPalabra($dificultad)` elige una palabra al azar de la base. |
| `Partida.php` | Clase `Partida`. `guardar(...)` inserta la partida terminada; `obtenerRanking()` arma el top 10. |
| `Login.php` | Endpoint: recibe usuario/contraseña, valida, y guarda el id en la sesión. |
| `Registro.php` | Endpoint: crea un usuario nuevo. |
| `IniciarPartida.php` | Endpoint: elige palabra y arma el estado inicial de la partida en la sesión. |
| `Adivinar.php` | Endpoint: **el corazón del juego**. Procesa cada letra arriesgada. |
| `FinalizarPartida.php` | Endpoint: cierra una partida como perdida (abandono o timeout). |
| `Ranking.php` | Endpoint: devuelve el top 10. |
| `auth.js`, `juego.js` | Funciones JS que hacen los `fetch` al backend (no son PHP, viven acá por comodidad). |

### Frontend (`src/components/`)

| Componente | Rol |
|---|---|
| `App.jsx` | El "router": decide qué pantalla mostrar según un estado `pantalla`. |
| `Login.jsx` / `Registro.jsx` | Formularios de acceso. |
| `Juego.jsx` | Contenedor del juego. Tiene el header persistente y decide entre selección o tablero. |
| `SeleccionPartida.jsx` | Elegir dificultad y tiempo. |
| `Tablero.jsx` | La partida en curso: casillas, input de letra, puntaje, timer. |
| `Resultado.jsx` | Pantalla final con el resultado y el ranking. |
| `Ranking.jsx` | Tabla del top 10. |
| `Confeti.jsx`, `PatronLetras.jsx` | Detalles visuales (animación de victoria, fondo). |
| `ui/Button.jsx`, `ui/Input.jsx` | Componentes reutilizables con estilo común. |

---

## 3. Navegación entre pantallas (sin React Router)

En vez de usar una librería de rutas, `App.jsx` funciona como una **máquina de
estados**: guarda una variable `pantalla` (`"login"`, `"registro"`, `"juego"`,
`"resultado"`) y renderiza el componente correspondiente con un `if`.

```jsx
const [pantalla, setPantalla] = useState("login");
// ...
if (pantalla === "juego") return <Juego ... />;
```

Cada componente recibe funciones (callbacks) para pedir el cambio de pantalla.
Ej: `Login` recibe `onLogin`, y al loguearse con éxito llama `onLogin(usuario)`,
lo que hace que `App` guarde el usuario y cambie `pantalla` a `"juego"`.

> **Por qué así:** con 4 pantallas y sin URLs que compartir, un router es
> sobreingeniería. Un estado + condicionales alcanza y es más fácil de explicar.

---

## 4. Flujo completo, paso a paso

### 4.1. Registro

1. El usuario completa mail, nombre de usuario y contraseña (dos veces).
2. React valida que las dos contraseñas coincidan (validación de comodidad).
3. `registroApi()` manda los datos a `Registro.php`.
4. `Usuario::registro()` **hashea la contraseña** con `password_hash()` y hace
   el `INSERT`.
5. Si el nombre de usuario o el mail ya existen, la base lo rechaza (tienen
   restricción `UNIQUE`) y se devuelve un mensaje de error.

### 4.2. Login y sesión

1. `loginApi()` manda usuario/contraseña a `Login.php`.
2. `Usuario::login()` busca al usuario por nombre, y compara la contraseña con
   `password_verify()` contra el hash guardado.
3. Si es correcta, `Login.php` **guarda el id del usuario en `$_SESSION`**:
   ```php
   $_SESSION['usuario_id'] = $resultado['user']->getId();
   ```
4. PHP manda una **cookie de sesión** al navegador. A partir de acá, cada
   pedido al backend viaja con esa cookie (por eso los `fetch` usan
   `credentials: "include"`), y el servidor sabe quién es el usuario sin que el
   frontend tenga que mandar el id.

> **Decisión de seguridad clave:** el id del usuario nunca lo manda el cliente.
> Vive en la sesión del servidor. Si confiáramos en un id mandado por el
> frontend, cualquiera podría hacerse pasar por otro usuario.

### 4.3. Iniciar partida

1. El usuario elige dificultad (baja/media/alta) y tiempo (sin límite, 1, 3 o 5
   minutos).
2. `iniciarPartida(dificultad)` le pega a `IniciarPartida.php`. **No manda el id
   del usuario** — el backend lo saca de la sesión.
3. `Palabra::obtenerPalabra($dificultad)` elige una palabra al azar de la base
   con `ORDER BY RAND() LIMIT 1`.
4. El backend arma el **estado de la partida y lo guarda en la sesión**:
   ```php
   $_SESSION['partida'] = [
     'usuario_id'         => $usuarioId,
     'palabra'            => $palabra,
     'descubiertas'       => array_fill(0, strlen($palabra), false), // ej: [f,f,f,f]
     'letras_arriesgadas' => [],
     'puntaje_letras'     => 0,
     'puntaje_pistas'     => 0,
     'dificultad'         => $dificultad,
   ];
   ```
5. Al frontend solo le devuelve la **cantidad de letras** (no la palabra, para
   que no se pueda "espiar" desde el navegador).

> **Por qué la palabra vive en la sesión y no en el frontend:** si el frontend
> conociera la palabra, se podría hacer trampa mirando el código. El navegador
> solo sabe cuántas letras tiene; la palabra real nunca sale del servidor hasta
> que se termina la partida.

### 4.4. Adivinar letras (el corazón — `Adivinar.php`)

Cada vez que el usuario arriesga una letra:

1. **Se normaliza a minúscula** (`mb_strtolower`), así "A" y "a" son lo mismo.
2. **Se rechaza si no aporta nada:** si esa letra ya la arriesgó antes, o si esa
   letra ya está visible en pantalla (revelada por una pista). En ese caso no
   suma ni resta nada.
3. **Se busca la letra en la palabra:**
   - **Si está** (acierto): se marcan como descubiertas **todas** sus
     ocurrencias, se suma **1 punto a letras adivinadas**, y el jugador
     mantiene el turno.
   - **Si no está** (fallo): se suma **1 punto a pistas**, y la aplicación
     **revela una pista**: busca la primera letra todavía no descubierta
     (de izquierda a derecha) y la muestra, junto con todas sus ocurrencias.
4. Se arma la **máscara** para mostrar en pantalla: letra si está descubierta,
   `*` si no (ej: `ga*i*ta`).
5. **Se chequea si la palabra está completa** (si ya no queda ningún `*`).

Ejemplo del enunciado (`gaviota`, dificultad media):

```
Arriesga 'a' → *a****a   (acierto, letras=1)
Arriesga 'h' → ga****a   (falla → pista revela 'g', pistas=1)
Arriesga 'i' → ga*i**a   (acierto, letras=2)
Arriesga 't' → ga*i*ta   (acierto, letras=3)
Arriesga 'p' → gavi*ta   (falla → pista revela 'v', pistas=2)
Arriesga 'o' → gaviota   (acierto, letras=4) → COMPLETA
```

### 4.5. Fin de partida y puntaje

Cuando se completa la palabra:

```php
$multiplicador = ['baja' => 1, 'media' => 2, 'alta' => 3][$dificultad];
$gano   = $puntaje_letras > $puntaje_pistas;   // gana si adivinó más de las que le pistaron
$empate = $puntaje_letras === $puntaje_pistas;
$puntajeAcumulado = ($gano || $empate) ? $puntaje_letras * $multiplicador : 0;
```

- **Gana** si la cantidad de letras adivinadas es mayor que las pistas.
- **Empata** si son iguales.
- **Pierde** si las pistas superan a las letras adivinadas.
- El **puntaje acumulado** (el que va al ranking) solo se guarda si ganó o
  empató, y se **multiplica por la dificultad**: baja ×1, media ×2, alta ×3.

En el ejemplo: 4 letras > 2 pistas → gana. Puntaje 4 × 2 (media) = **8 puntos
acumulados**.

La partida se guarda en la tabla `partidas` con `Partida::guardar(...)` y se
borra de la sesión (`unset($_SESSION['partida']`).

### 4.6. Abandonar o quedarse sin tiempo

- Si el usuario aprieta **"Abandonar partida"**, o si se **acaba el tiempo** en
  una partida con reloj, se llama a `FinalizarPartida.php`.
- Ese endpoint guarda la partida como **perdida con 0 puntos** acumulados.
- Es el mismo endpoint para los dos casos, porque el resultado es idéntico
  (derrota, sin puntos).

### 4.7. Ranking

Al terminar cualquier partida se muestra el top 10. `Partida::obtenerRanking()`
hace:

```sql
SELECT usuarios.nombre_usuario, SUM(partidas.puntaje_acumulado) AS puntaje_total
FROM partidas
INNER JOIN usuarios ON partidas.usuario_id = usuarios.id
GROUP BY partidas.usuario_id
ORDER BY SUM(partidas.puntaje_acumulado) DESC
LIMIT 10;
```

Suma **todo el puntaje acumulado de cada jugador** entre todas sus partidas, y
muestra los 10 más altos.

---

## 5. Base de datos

Tres tablas (`database/schema.sql`):

- **`usuarios`**: `id`, `nombre_usuario` (único), `mail` (único), `password`
  (el hash, nunca la contraseña en texto plano).
- **`palabras`**: `id`, `palabra`, `dificultad` (ENUM baja/media/alta).
- **`partidas`**: `id`, `usuario_id` (clave foránea a usuarios), `palabra`,
  `dificultad`, `puntaje_letras`, `puntaje_pistas`, `puntaje_acumulado`,
  `resultado` (ENUM ganada/perdida/empatada), `fecha`.

La dificultad de cada palabra se define por su longitud: baja = 3 a 5 letras,
media = 6 a 8, alta = más de 8.

---

## 6. Decisiones de diseño (para las repreguntas)

**¿Por qué guardás el estado del juego en la sesión y no en el frontend?**
Seguridad y confianza. Si el frontend tuviera la palabra o el puntaje, se podría
hacer trampa editando el código en el navegador. El servidor es la única fuente
de verdad; el frontend solo muestra lo que el backend le dice.

**¿Por qué el hasheo de contraseña es del lado del servidor?**
Si se hasheara en el cliente, el hash viajaría por la red y se convertiría de
hecho en la "contraseña real" — quien lo interceptara podría entrar. Además el
cliente es manipulable. `password_hash()`/`password_verify()` de PHP son el
estándar y usan un algoritmo seguro (bcrypt) con salt automático.

**¿Por qué mysqli con prepared statements?**
Los prepared statements (`prepare` + `bind_param`) evitan **inyección SQL**: los
datos del usuario nunca se concatenan directo en la consulta, van como
parámetros separados.

**¿Por qué CORS aparece ahora y no en proyectos PHP puros?**
Porque frontend (Vite :5173) y backend (Apache :80) son orígenes distintos. En
un proyecto PHP tradicional todo sale del mismo origen, así que el navegador no
aplica la restricción. Acá hay que autorizar explícitamente el origen del
frontend, y como usamos cookies de sesión, hace falta
`Allow-Credentials: true` + origen explícito (no comodín `*`).

**¿Por qué no usás un framework como Laravel?**
Por el tamaño del proyecto: PHP OOP plano con clases bien separadas
(Usuario, Palabra, Partida, Db) cumple con el paradigma orientado a objetos que
pide el enunciado, sin la curva de aprendizaje de un framework entero.

**¿Cómo evitás que sumen puntos repitiendo una letra ya descubierta?**
`Adivinar.php` rechaza la letra si ya fue arriesgada antes o si ya está visible
en la máscara (por ejemplo, si fue revelada por una pista). En esos casos no
suma ni letra ni pista.

---

## 7. Resumen en una frase

Un juego donde el **servidor** guarda la palabra y el estado de la partida en la
**sesión**, el **cliente** solo muestra la máscara y manda letras, el **puntaje**
se calcula comparando aciertos contra pistas y se multiplica por la dificultad,
y todo lo importante (palabra, puntaje, identidad del usuario) vive del lado
seguro del servidor.
