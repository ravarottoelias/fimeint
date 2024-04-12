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
nohup php artisan queue:work --queue=emails,payments,default --tries=3 --daemon >/dev/null 2>&1 &
```
Se debe tener configurado en el .env
```
QUEUE_DRIVER=database
```

