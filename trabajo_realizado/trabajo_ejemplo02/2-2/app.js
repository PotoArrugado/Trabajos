const texto = document.querySelector("#texto");
const btnCambiar = document.querySelector("#btnCambiar");
const btnRestaurar = document.querySelector("#btnRestaurar");

const textoOriginal = texto.textContent;

const emociones = [
  { texto: "Estoy bien", color: "#333", fontSize: "22px" },
  { texto: "Estoy feliz", color: "green", fontSize: "24px" },
  { texto: "Estoy triste", color: "blue", fontSize: "24px" },
  { texto: "Estoy enojado", color: "red", fontSize: "24px" },
  { texto: "Estoy sorprendido", color: "orange", fontSize: "24px" }
];

let indiceEmocion = 0;

btnCambiar.addEventListener("click", () => {
  indiceEmocion = (indiceEmocion + 1) % emociones.length;
  texto.textContent = emociones[indiceEmocion].texto;
  texto.style.color = emociones[indiceEmocion].color;
  texto.style.fontSize = emociones[indiceEmocion].fontSize;
});

btnRestaurar.addEventListener("click", () => {
  texto.textContent = textoOriginal;
  texto.style.color = "#333";
  texto.style.fontSize = "22px";
  indiceEmocion = 0;
});
