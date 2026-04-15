const titulo = document.querySelector("#titulo");
const descripcion = document.querySelector("#descripcion");
const btnEspanol = document.querySelector("#btnEspanol");
const btnIngles = document.querySelector("#btnIngles");
const html = document.documentElement;

const contenido = {
  es: {
    titulo: "Selector de Idioma",
    descripcion: "Este es un ejemplo de selector de idioma"
  },
  en: {
    titulo: "Language Selector",
    descripcion: "This is an example of a language selector"
  }
};

let idiomaActual = "es";

function cambiarIdioma(nuevoIdioma) {
  idiomaActual = nuevoIdioma;
  
  titulo.textContent = contenido[nuevoIdioma].titulo;
  descripcion.textContent = contenido[nuevoIdioma].descripcion;
  
  html.setAttribute("lang", nuevoIdioma);
}

btnEspanol.addEventListener("click", () => {
  cambiarIdioma("es");
});

btnIngles.addEventListener("click", () => {
  cambiarIdioma("en");
});
