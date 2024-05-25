//Dependencias
import {ShoppingCart} from "./ShoppingCart.mjs";
import {htmlToElement} from "./Utils.mjs";

//Variables globables
let carrito;
let queryContenido=".content";
let queryDesplegable=".carritoDesplegable";
let queryDesplegado=".carritoDesplegado";


//Inicialización de la página
window.addEventListener("load",init);

async function init(){
    //Inicialización del carrito
    carrito=new ShoppingCart();
    //Obtengo posición DIV principal
    var div=document.querySelector(queryContenido);

    //Obtengo productos de Servidor
   // var productos= await solicarProductosServer();

    //Añado los productos del servidor
    for(let i=0;i<3;i++){
        var nodo=nuevoNodoProducto(productos[i].name,productos[i].url,1)
        div.appendChild(nodo);
    }

    //Carrito desplegable
    document.querySelector(queryDesplegable).addEventListener("mouseenter",mostrarCarrito);
    document.querySelector(queryDesplegable).addEventListener("mouseleave",ocultarCarrito);

}

//Diseñamos la tarjeta de producto y asociamos los eventos
//function nuevoNodoProducto(titulo,img,value=0) {
function nuevoNodoProducto(product_title,image_name, product_price, description, value=0) {

    var html = `<li class="cartaLi flex">
                    <div class="card p-2 my-2">
                        <div class="card-body">
                            <p class="card-title">${product_title}</p>
                            <p class="card-title">${product_price}</p>
                            <p class="card-title">${description}</p>
                            <img  src="${image_name}" /><br>
                            <button type="button" class="btn btn-primary aumentar">+1</button>
                            <button type="button" class="btn btn-primary reducir">-1</button>
                            <button type="button" class="btn btn-primary eliminar">Delete</button>
                            <input class="toValue" type="number" min="0" max="10" value="${value}"/>
                        </div>
                    </div>
                </li>`;

    let nodo=htmlToElement(html);

    //Asocio eventos
    nodo.querySelector(".aumentar").addEventListener("click",()=>carrito.carritoAumentar(product_title));
    nodo.querySelector(".reducir").addEventListener("click",()=>carrito.carritoReducir(product_title));
    nodo.querySelector(".eliminar").addEventListener("click",()=>carrito.carritoEliminar(product_title));
    nodo.querySelector(".toValue").addEventListener("change",()=>carrito.carritoModificarValor(product_title));
    return nodo;
}

function nuevoNodoProductoDesplegable(product_title) {
    var html = `<li>${product_title}</li>`;
    return htmlToElement(html);
}


//Carrito desplegable
function mostrarCarrito(){
    let nodo=document.querySelector(queryDesplegado);
    actualizarDesplegable(nodo,carrito.carritoActual);
    nodo.style.display="block";
    console.log("a")

}

function ocultarCarrito(){
    document.querySelector(queryDesplegado).style.display="none"
    console.log("b")
}

function actualizarDesplegable(nodo,carritoActual){
    //1. Obtengo la capa donde voy a mostrar la información
    var carritoDespl=nodo;

    //2. Elimino el contenido actual de dicha capa
    while(carritoDespl.firstChild) carritoDespl.removeChild(carritoDespl.firstChild);

    //3. Añado los elementos actuales del carrito a la capa
    for (let [key, value] of carritoActual) {
        var nodo=nuevoNodoProductoDesplegable(`${key} - ${value}`);
        carritoDespl.appendChild(nodo);
    }
}