# Adivine la Palabra

Juego de adivinanza de palabras. Frontend en React (Vite) + Tailwind, backend en PHP orientado a objetos con MySQL.

## Requisitos

- XAMPP (Apache + MySQL) corriendo en `localhost`
- Node.js

## Instalación

1. Importar `database/schema.sql` en MySQL (crea la base `final_juego_ahorcado` con sus tablas y palabras de ejemplo).
2. Colocar la carpeta `api/` dentro de `htdocs` para que Apache la sirva.
3. Instalar dependencias del frontend:
   ```
   npm install
   ```
4. Levantar el servidor de desarrollo:
   ```
   npm run dev
   ```
