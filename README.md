# RbBurger

Web de restaurante con parte cliente y panel de administración, creada con HTML, CSS, JavaScript, Bootstrap, PHP y MySQL.

🎥    🎥 **[Vídeo del funcionamiento de la web](https://youtu.be/jUHMY8jGzzI)**

> Proyecto de demostración hecho en entorno local (XAMPP), sin servidor en producción.

## Qué incluye

**Sección cliente**
- Categorías y alimentos destacados en la página de inicio
- Barra de búsqueda
- Listado de categorías y de alimentos
- Página de contacto
- Botón para avisar al camarero o pedir la cuenta indicando la mesa en la estés
- Diseño adaptado a móvil

**Sección administrador**
- Login de administradores
- Gestión de usuarios, categorías y alimentos (añadir, editar y eliminar)
- Panel de avisos de los clientes, con posibilidad de actualizarlos o eliminarlos

## Tecnologías 💻

HTML · CSS · JavaScript · Bootstrap · PHP · MySQL

## Cómo probarlo en local

1. Instala [XAMPP](https://www.apachefriends.org/) e inicia Apache y MySQL.
2. Copia la carpeta `food-order` en `C:\xampp\htdocs\`.
3. Abre `localhost/phpmyadmin`, crea una base de datos llamada `food-order` e importa `food-order/database/food-order.sql`.
4. Los datos de conexión están en `food-order/config/constants.php` (por defecto `root` sin contraseña, como en XAMPP).
5. Abre `localhost/food-order/` en el navegador.

**Acceso de administrador de demostración:** `ruben` / `1234`
