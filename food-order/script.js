//Cookies
const cookieContainer = document.querySelector(".cookie-container");
const cookieButton = document.querySelector(".cookie-btn");

cookieButton.addEventListener("click", () => {
  cookieContainer.classList.remove("active");
  localStorage.setItem("cookieActivada", "true");
});

setTimeout(() => {
  if (!localStorage.getItem("cookieActivada")) {
    cookieContainer.classList.add("active");
  }
}, 2000);


//Para el botón para ir arriba
let calcScrollValue =() => {
  let scrollProgress = document.getElementById
  ("progress");
  let progressValue = document.getElementById
  ("progress-value");
  let pos = document.documentElement.scrollTop;
  let calcHeight =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;
  let scrollValue = Math.round((pos * 100) / calcHeight);
  if(pos>100){
    scrollProgress.style.display = "grid";
  } else {
    scrollProgress.style.display = "none";
  }
  scrollProgress.addEventListener("click", () => {
    document.documentElement.scrollTop = 0;
  });
};

window.onscroll = calcScrollValue;
windows.onload = calcScrollValue;


function mascara(valor) {
  if (valor.match(/^\d{2}$/) !== null) {
    return valor + '-';
  } else if (valor.match(/^\d{2}\-\d{2}$/) !== null) {
    return valor + '-';
  }
  return cadena;
}



