# Para crear un nuevo proyecto en laravel se debe instalar de manera global luego de composer

```bash
	composer global require laravel/installer
	laravel new example-app
```

# Como creamos un nombre de dominio en windows

Ya que es un poco tedioso navegar constantemente a:
http://localhost/laravel/blog/public/
Entonces cambiaremos esto para solo ir a :
*blog.test*

Ejecutamos el block de notas como administrador y vamos a la siguiente carpeta:

**C:\Windows\System32\drivers\etc\**

Y abrimos este archivo **hosts**

Y adicionamos la siguiente configuracion:

```
	127.0.0.1 blog.test
```

De esta manera le indicamos que la interfaz que tenemos de loopback apuntara la que ya conocemos *127.0.0.1* y tambien el dominio que pusimos *blog.test*

Ahora lo que debemos hacer es navegar a la siguiente ruta para configurar e indicarle a xampp que usaremos ese dominio:

**C:\xampp\apache\conf\extra\**

Y buscar el archivo:
**httpd-vhosts.conf**

Abrimos con el block de notas y añadimos la siguiente configuracion:

```bash
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/xampp/htdocs"
</VirtualHost>

<VirtualHost *:80>
    ServerName blog.test
    DocumentRoot "C:/xampp/htdocs/laravel/blog/public"
</VirtualHost>
```
Y ahora si navegamos a blog.test tendremos la ruta de nuestro proyecto


# Notas del proyecto

* El archivo web.php que esta ubicado en el directorio **routes/web.php** es el archivo que se encarga de manejar las rutas de nuestro proyecto.




# Pasos para clonar el repositorio del proyecto
1. Clonar el repositorio
```bash
    git clone https://github.com/laravel/blog.git <- url de prueba
```
2. Instalar dependencias
```bash
    cd blog
    composer install
```
3. Generar llave de seguridad
```bash
    php artisan key:generate
```
4. Crear el archivo de variables de entorno
Copiar el archivo .env.example a .env
Cambiar las credenciales de las dependencias usadas

5. Crear la base de datos (si es SQLite)
Crear el archivo database/database.sqlite

6. Correr las migraciones
```bash	
	php artisan migrate
```








