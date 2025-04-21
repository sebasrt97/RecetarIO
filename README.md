#RecetarIO

#Dependencias necesarias:

Docker Desktop (ejecución de contenedores)
Node.js (v18 o superior) y npm
Composer (gestor de dependencias PHP)
WSL2 para Windows
Composer


#Clonar e instalación del proyecto desde la rama 'dev'

git clone https://github.com/sebasrt97/RecetarIO
cd recetario
git checkout dev

#Copiar el archivo de entorno:
cp .env.example .env

#Levantar el entorno con Docker Compose:
docker-compose up -d --build

#Instalar dependencias de la aplicación:
docker exec -it recetario_app composer install.
docker exec -it recetario_app npm install
docker exec -it recetario_app npm run build
docker exec -it recetario_app php artisan key:generate
docker exec -it recetario_app php artisan migrate

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
