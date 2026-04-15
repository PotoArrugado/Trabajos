const descripcion = document.querySelector("#descripcion");

const mostrador = document.querySelector("#tamaño");

const btnAumentar = document.querySelector("#btnAumentar");
const btnDisminuir = document.querySelector("#btnDisminuir");
const btnReiniciar = document.querySelector("#btnReiniciar");

let tamañoActual = 18;
const tamaño_minimo = 12;
const tamaño_maximo = 36;
const incremento = 2;

function actualizarZoom() {
  descripcion.style.fontSize = tamañoActual + "px";
  mostrador.textContent = `Tamaño actual: ${tamañoActual}px`;
}

btnAumentar.addEventListener("click", () => {
  if (tamañoActual < tamaño_maximo) {
    tamañoActual += incremento;
    actualizarZoom();
  }
});

btnDisminuir.addEventListener("click", () => {
  if (tamañoActual > tamaño_minimo) {
    tamañoActual -= incremento;
    actualizarZoom();
  }
});

btnReiniciar.addEventListener("click", () => {
  tamañoActual = 18;
  actualizarZoom();
});
