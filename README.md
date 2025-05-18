#RecetarIO

```bash
#Dependencias necesarias:

Docker Desktop (ejecución de contenedores)
Composer (gestor de dependencias PHP)
WSL2 para Windows

Opcional: Node.jsm, Composer, npm

#Primera vez:
#Clonar e instalación del proyecto desde la rama 'dev'

git clone https://github.com/sebasrt97/RecetarIO
cd recetario
git checkout dev

#Copiar el archivo de entorno:
cp .env.example .env

#Inicializar el entorno, usar el script start.sh:
./start.sh
*Este comando construye la imagen de PHP/Laravel y ejecuta los RUN dentro del 'docker-compose.yml'.
*Se limpia la caché de configuración de laravel
*Ejecuta las migraciones de base de datos pendientes.

#Instalar dependencias de la aplicación:
docker exec -it recetario_app composer install.
docker exec -it recetario_app npm install
docker exec -it recetario_app npm run build
docker exec -it recetario_app php artisan key:generate (solo se ejecuta una vez)


#Uso diario:
#Arrancar el entorno: 
./start.sh

#Detener el entorno:
./stop.sh

#Pruebas: 
http://localhost:8000/register para crear un nuevo usuario.
http://localhost:8000/login para iniciar sesión.
http://localhost:8080 para gestionar directamente la base de datos.

#Autenticación base de datos:

DB_DATABASE=recetario
DB_USERNAME=recetas
DB_PASSWORD=123456

#Estado del proyecto:

#Módulo de autenticación completo
#Entorno Dockerizado funcionando
