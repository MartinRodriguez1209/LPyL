const hanas = [
    'IMG_20240910_133955191.jpg',
    'IMG_20241122_115345356.jpg',
    'IMG_20241203_130415314.jpg',
    'IMG_20250923_104917463.jpg',
    'IMG_20251104_150007616_HDR.jpg',
    'IMG_20260122_235217989_HDR.jpg'
];

function seleccionarHanaAleatoria() {
    const indice = Math.floor(Math.random() * hanas.length);
    const imagenSeleccionada = hanas[indice];
    const img = document.getElementById('imagenHana');
    img.src = 'hana/' + imagenSeleccionada;
}

document.addEventListener('DOMContentLoaded', function() {
    const boton = document.getElementById('btnHana');
    boton.addEventListener('click', seleccionarHanaAleatoria);
});
