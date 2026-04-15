const valor = document.querySelector("#valor");
const btnToggle = document.querySelector("#btnMas");
const btnReset = document.querySelector("#btnReset");

let disponible = true;

function render() {
  if (disponible) {
    valor.textContent = "DISPONIBLE";
    valor.style.color = "green";
  } else {
    valor.textContent = "OCUPADO";
    valor.style.color = "red";
  }
}

btnToggle.addEventListener("click", () => {
  disponible = !disponible;
  render();
});

btnReset.addEventListener("click", () => {
  disponible = true;
  render();
});

render();