echo "Iniciando app RecetarIO"

docker-compose up -d --build

sleep 5

docker exec -it  recetario_app  php artisan config:clear
#Limpiar cache

docker exec -it recetario_app  php artisan migrate
#Aplica las migraciones

echo "Laravel en http://localhost:8000 y phpMyAdmin en http://localhost:8080" 
