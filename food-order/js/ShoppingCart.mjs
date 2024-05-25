export class ShoppingCart {
    key;
    carritoActual;
    constructor(key="carrito") {
        this.key=key;
        this.carritoActual=this.getCart();
    }

    //Uso del local storage
    getCart() {
        let carritoMemoria = localStorage.getItem(this.key);
        if (carritoMemoria == null) {
            return new Map();
        } else {
            return new Map(Object.entries(JSON.parse(carritoMemoria)));
        }
    }

    updateLocalStorage(){
        localStorage.setItem(this.key, JSON.stringify(Object.fromEntries(this.carritoActual)));
    }

    //Getters
    getNumberElementInCarrito(name) {
        return this.carritoActual.has(name) ? this.carritoActual.get(name) : 0;
    }

    //Metodos de establecer info

    carritoAumentar(nombreComida) {
        this.carritoActual.set(nombreComida, (this.carritoActual.get(nombreComida) || 0) + 1);
        this.updateLocalStorage();
    }

    carritoReducir(nombreComida) {      
        if (this.carritoActual.has(nombreComida)) {
            let nuevoValor = this.carritoActual.get(nombreComida) - 1;
            if (nuevoValor > 0) {
                this.carritoActual.set(nombreComida, nuevoValor);
            } else {
                this.carritoActual.delete(nombreComida);
            }
        }

        this.updateLocalStorage();
    }

    carritoEliminar(nombreComida) {
        this.carritoActual.delete(nombreComida);
        this.updateLocalStorage();
    }

    carritoModificarValor(nombreComida, value) {
        if (value > 0) {
            this.carritoActual.set(nombreComida, value);
        } else {
            this.carritoActual.delete(nombreComida);
        }
        this.updateLocalStorage();
    }


}