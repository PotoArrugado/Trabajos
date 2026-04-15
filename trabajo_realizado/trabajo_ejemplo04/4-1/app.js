const valor = document.querySelector("#valor");
const btnMas = document.querySelector("#btnMas");
const btnMenos = document.querySelector("#btnMenos");
const btnReset = document.querySelector("#btnReset");

let contador = 0;
const LIMITE_MAXIMO = 10;

function render() {
  valor.textContent = contador;
  
  // Lógica de colores según el aforo
  if (contador >= LIMITE_MAXIMO) {
    valor.style.color = "red";
    valor.textContent = contador + " (LÍMITE ALCANZADO)";
  } else if (contador <= 0) {
    valor.style.color = "gray";
  } else {
    valor.style.color = "green";
  }
}

btnMas.addEventListener("click", () => {
  // Solo sumamos si no hemos pasado el límite
  if (contador < LIMITE_MAXIMO) {
    contador++;
    render();
  }
});

btnMenos.addEventListener("click", () => {
  // No permitimos números negativos
  if (contador > 0) {
    contador--;
    render();
  }
});

btnReset.addEventListener("click", () => {
  contador = 0;
  render();
});

render();