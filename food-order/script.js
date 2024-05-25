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

//MESA
const mesaText = document.querySelector('.mesa');
const saveNameButton = document.querySelector('.saveNameBtn');

const mesaContainer = document.querySelector(".mesa-container");

saveNameButton.addEventListener('click', () => {
  const mesa = document.querySelector('.name').value;
  mesaText.textContent = mesa;
  sessionStorage.setItem('name', mesa);
});

function displaymesa() {
  const nameFromLocalStorage = sessionStorage.getItem('name');

  if (nameFromLocalStorage) {
    mesaText.textContent = 'Tu mesa es la ' + nameFromLocalStorage;
  } else {
    mesaText.textContent = 'Número mesa';
  }
}

displaymesa();

saveNameButton.addEventListener("click", () => {
  mesaContainer.classList.remove("active");
  localStorage.setItem("mesaActivada", "true");
});

setTimeout(() => {
  if (!sessionStorage.getItem("mesaActivada")) {
    mesaContainer.classList.add("active");
  }
}, 1000);


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



