#RecetarIO

```bash

Características Principales
---Gestión de Recetas: CRUD completo.

---Ingredientes/Alérgenos: Asociación y control.

---Costes (Escandallos): Cálculo de precios y márgenes.

---PDFs: Exportación de recetas.

---Imágenes: Subida y visualización.

---Autenticación: Registro/inicio de sesión.

---Docker: Entorno de desarrollo aislado.

---Interfaz Responsiva: Con Tailwind CSS.

Requisitos Previos
---Necesitas instalar:

---Docker Desktop

---Node.js (v18+) y npm

---Composer

---WSL2 (para Windows)

Características Principales
---Gestión de Recetas: CRUD completo.

---Ingredientes/Alérgenos: Asociación y control.

---Costes (Escandallos): Cálculo de precios y márgenes.

---PDFs: Exportación de recetas.

---Imágenes: Subida y visualización.

---Autenticación: Registro/inicio de sesión.

---Docker: Entorno de desarrollo aislado.

---Interfaz Responsiva: Con Tailwind CSS.

Requisitos Previos
---Necesitas instalar:

---Docker Desktop

---Node.js (v18+) y npm

---Composer

---WSL2 (para Windows)

#Primera vez:
#Clonar e instalación del proyecto desde la rama 'main'

git clone https://github.com/sebasrt97/RecetarIO
cd RecetarIO
git checkout main

#Inicializar el entorno, usar el script start.sh:
./start.sh
*Levantar Docker Compose.
*Instalar dependencias (Composer, NPM).
*Compilar assets frontend.
*Generar APP_KEY.
*Limpiar cachés de Laravel.
*Ejecutar php artisan migrate:fresh --seed (¡borra datos!).
*Crear storage:link.

#En otro bash para vite
* npm run dev

#Ajustar Permisos (Importante)
# Si hay errores de "Permission denied" en storage o bootstrap/cache, ejecuta en tu host:
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
# Ajusta 'www-data' si tu grupo de servidor web es diferente.

#Luego, limpia caché y reinicia Docker:
docker exec -it recetario_app php artisan optimize:clear
docker-compose restart recetario_app

#Detener el entorno:
./stop.sh
cd RecetarIO
git checkout main

#Detener el entorno:
./stop.sh

#Pruebas: 
http://localhost:8000/ para el login y el boton de registrar
#Usurio: "admin@example.com" para ver ya subida los recetas
#Contraseña: 123456
http://localhost:8080 para gestionar directamente la base de datos.

#Autenticación base de datos:

DB_DATABASE=recetario
DB_USERNAME=recetas
DB_PASSWORD=123456

