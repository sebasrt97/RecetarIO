echo "Iniciando app RecetarIO"

docker-compose up -d --build

sleep 10
#Esperar 10 segundos para que se inicie el contenedor

#Comprobar si vendor existe
if ! docker exec recetario_app test -d /var/www/html/vendor; then
  docker exec -it recetario_app composer install
fi

#Comprobar si node_modules existe para saber si spm install se ejecuta antes de npm install
if ! docker exec recetario_app test -d /var/www/html/node_modules; then
  docker exec -it recetario_app npm install
  docker exec -it recetario_app npm run build
fi

#Limpiar cache
docker exec -it  recetario_app  php artisan config:clear

#Aplica las migraciones
docker exec -it recetario_app  php artisan migrate


echo "Laravel en http://localhost:8000 y phpMyAdmin en http://localhost:8080" 
