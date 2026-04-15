const texto = document.querySelector("#texto");
const btnCambiar = document.querySelector("#btnCambiar");
const btnRestaurar = document.querySelector("#btnRestaurar");

const textoOriginal = texto.textContent;

const frases = [
  { texto: "El éxito es el resultado de la perseverancia", color: "#333", fontSize: "22px" },
  { texto: "Nunca te rindas", color: "#d9534f", fontSize: "24px" },
  { texto: "La paciencia es clave", color: "#5cb85c", fontSize: "24px" },
  { texto: "Cada día es una nueva oportunidad", color: "#5bc0de", fontSize: "24px" },
  { texto: "Tu esfuerzo tiene valor", color: "#f0ad4e", fontSize: "24px" }
];

let indiceFrase = 0;

btnCambiar.addEventListener("click", () => {
  indiceFrase = (indiceFrase + 1) % frases.length;
  texto.textContent = frases[indiceFrase].texto;
  texto.style.color = frases[indiceFrase].color;
  texto.style.fontSize = frases[indiceFrase].fontSize;
});

btnRestaurar.addEventListener("click", () => {
  texto.textContent = textoOriginal;
  texto.style.color = "#333";
  texto.style.fontSize = "22px";
  indiceFrase = 0;
});
