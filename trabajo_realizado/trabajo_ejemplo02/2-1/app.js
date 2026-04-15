const texto = document.querySelector("#texto");
const btnCambiar = document.querySelector("#btnCambiar");
const btnRestaurar = document.querySelector("#btnRestaurar");

const textoOriginal = texto.textContent;

const idiomas = [
  { texto: "Texto Original", idioma: "Español", color: "#333", fontSize: "60px" },
  { texto: "Original Text", idioma: "English", color: "blue", fontSize: "60px" },
  { texto: "Texte Original", idioma: "Français", color: "green", fontSize: "60px" },
  { texto: "Testo Originale", idioma: "Italiano", color: "orange", fontSize: "60px" }
];

let indiceIdioma = 0;

btnCambiar.addEventListener("click", () => {
  indiceIdioma = (indiceIdioma + 1) % idiomas.length;

  texto.textContent = idiomas[indiceIdioma].texto;
  texto.style.color = idiomas[indiceIdioma].color;
  texto.style.fontSize = idiomas[indiceIdioma].fontSize;
});

btnRestaurar.addEventListener("click", () => {
  texto.textContent = textoOriginal;
  texto.style.color = "#333";
  texto.style.fontSize = "22px";
  indiceIdioma = 0;
});
