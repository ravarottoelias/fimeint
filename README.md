# fimeint

## Despliegue
Instalación dependencias
```sh
composer install
```
Permisos para cache
```sh
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

Permisos a la carpeta public/uploads
```
chmod -R 777 public/uploads/
```

### Migraciones y seeders
Correr migraciones y seeders.


### Queue and Jobs
Luego del despliegue ejecutar el siguiente comando para correr los jobs en background
```sh
php artisan queue:listen --queue=default,emails,payments --tries=1 --memory=128 --timeout=300 >>  storage/logs/queue_log.log &
```
Verificar si el comando está corriendo
```
ps -aux | grep artisan
```

Se debe tener configurado en el .env
```
QUEUE_DRIVER=database
```

### Otros

