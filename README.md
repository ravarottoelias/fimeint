# fimeint

## Despliegue

### Queue and Jobs
Luego del despliegue ejecutar el siguiente comando para correr los jobs en background
```sh
nohup php artisan queue:work --queue=emails,payments,default --tries=3 --daemon >/dev/null 2>&1 &
```

