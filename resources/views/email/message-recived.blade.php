<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mailer Demo</title>
</head>
 
<body>
Has recibido un contacto desde la página web 
<br>

    <b>Nombre:</b> {{ $messageRecived['name'] }} <br>
    <b>Email:</b> {{ $messageRecived['email'] }} <br>
    <b>Teléfono:</b> {{ $messageRecived['telefono'] }} <br>
    <b>Mensaje:</b> {{ $messageRecived['message'] }} <br>

<br>

</body>
</html>