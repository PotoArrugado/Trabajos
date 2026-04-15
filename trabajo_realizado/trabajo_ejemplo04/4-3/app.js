const valor = document.querySelector("#valor");
const btnMas = document.querySelector("#btnMas");
const btnMenos = document.querySelector("#btnMenos");
const btnReset = document.querySelector("#btnReset");

let contador = 0;
const MIN = 0;
const MAX = 10;

function render() {
  valor.textContent = contador;

  /* LÓGICA DE COLOR GRADUAL:
    Usamos HSL (Hue, Saturation, Lightness).
    Mantendremos el tono (Hue) en 210 (azul) y variaremos la claridad (Lightness).
    A menor número, más claro (blanco); a mayor número, más oscuro/intenso.
  */
  const luminosidad = 100 - (contador * 7); // De 100% a 30%
  document.body.style.backgroundColor = `hsl(210, 70%, ${luminosidad}%)`;

  // Cambiar el color del texto para que sea legible
  if (contador > 6) {
    document.body.style.color = "white";
    valor.style.color = "white";
  } else {
    document.body.style.color = "#333";
    valor.style.color = "#1a4d8f";
  }
}

btnMas.addEventListener("click", () => {
  if (contador < MAX) {
    contador++;
    render();
  }
});

btnMenos.addEventListener("click", () => {
  if (contador > MIN) {
    contador--;
    render();
  }
});

btnReset.addEventListener("click", () => {
  contador = MIN;
  render();
});

// Render inicial
render();