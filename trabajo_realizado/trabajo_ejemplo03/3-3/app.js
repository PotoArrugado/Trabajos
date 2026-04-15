const descripcion = document.querySelector("#descripcion");
const estado = document.querySelector("#estado");

const btnBienvenida = document.querySelector("#btnBienvenida");
const btnInformacion = document.querySelector("#btnInformacion");
const btnConsejo = document.querySelector("#btnConsejo");

const mensajes = {
  bienvenida: "Bienvenido. Aquí hay un modo de cómo cambiar mensajes con botones.",
  informacion: "Esta página usa JavaScript para actualizar el contenido sin recargar el navegador.",
  consejo: "Consejo: al usar botones claros y texto breve, los usuarios comprenden rapidamente las opciones."
};

function cambiarMensaje(tipo) {
  descripcion.textContent = mensajes[tipo];
  estado.textContent = `Modo actual: ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`;
}

btnBienvenida.addEventListener("click", () => {
  cambiarMensaje("bienvenida");
});

btnInformacion.addEventListener("click", () => {
  cambiarMensaje("informacion");
});

btnConsejo.addEventListener("click", () => {
  cambiarMensaje("consejo");
});
