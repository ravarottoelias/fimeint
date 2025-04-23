<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificado N° {{ $cert->certificadoNumero }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
        }

        body {
            background-image: url({{ base_path('public/images/marco-certificado.png') }}); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            height: 100vh; /* Asegura que cubra toda la pantalla */
            margin: 0; /* Elimina los márgenes por defecto */
        }
        @page {
            margin: 2mm; /* Arriba, Derecha, Abajo, Izquierda */
        }
        .logo-fime{
            height: 112px;
            width: 188px;
            margin-top: 90px;
        }
        .cuerpo-certificado{
            font-size: 17px;
            width: 80%;
            margin: 0 auto;
            text-align: center;
            margin-bottom: 15px;
            font-weight: 400;
            color: #414141;

        
        }
        .nombre-yap{
            margin-top: 0px;
            margin-bottom: 0px;
            font-size: 40px;
            font-family: 'Times New Roman', Times, serif;
        }
        .dni-nro{
            margin-top: 0px;
        }
        .firma {
            float: left;
            width: 50%;
            height: 200px;
        }

        .firma-nombre{
            margin: 3px auto;
            font-size: 14px;
        }
        .page-break {
            page-break-before: always; /* O page-break-after: always; */
        }
        .cert-details{
            margin: 50px 0px 0px 80px;
        }
        .cert-details p{
            margin-bottom: 4px;
            margin-top: 0px;
        }
        .default-paragraph{
            font-style: italic; 
            margin: 0 auto; 
            width: 80%;
            font-size: 14px;
            color: #414141;
            margin-bottom: 65px;
        }

        .contenedor {
            position: relative;
            height: 100px;
            }

            .izquierda-data {
            position: absolute;
            left: 70;
            top: 35;
            }

            .derecha-qr {
            position: absolute;
            right: 8%;
            top: 55;
        }
        .mb-3{
            margin-bottom: 3px;
        }
        .homologacion-container{
            position: relative;
            top: 350px; 
            width: 100%;
        }
        .homologacion-container .row{
            margin: 0 auto;
            width: 80%;
        }
        .p-homologacion{
            text-align: center;
            font-size: 12px;
        }


    .firmas > .bloque {
      position: absolute;
      width: 50%;
      opacity: 0.8; /* Para ver ambos superpuestos */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 20%;
      top: 420;
    }
    
    .firmas > .bloque1 {
        left: 80;
    }
    
    .firmas > .bloque2 {
        right: 80;
    }

    </style>
</head>
<body>

    <body class="body">
        <div class="page-1">
            <center>
                <img class="logo-fime" src="{{ base_path('public/images/nuevo-logo-fime.png') }}" alt="">
                <p class="titulo mb-3">Por cuanto</p>
                <p class="nombre-yap">{{ $cert->alumnoNombreCompleto }}</p>
                <p class="dni-nro">DNI N° {{ $cert->alumnoCuit }}</p>
            </center>
            
            <p class="cuerpo-certificado">{{ $cert->certificadoBody }}</p>

            <div class="firmas">
                <div class="bloque bloque1">
                    <div class="firma firma-l">
                        <center>
                            <img src="{{ base_path('public/images/cert/firma-danielz.png') }}" alt="" height="110">
                            <p class="firma-nombre">Dr. Daniel F. Martínez Zampa</p>
                            <p class="firma-nombre">Docente Titular</p>
                        </center>
                    </div>
                </div>
                <div class="bloque bloque2">
                    <center>
                        <img src="{{ base_path('public/images/cert/firma-lilianv.png') }}" alt="" height="110">
                        <p class="firma-nombre">Dra. Lilian Edith Vargas</p>
                        <p class="firma-nombre">Responsable Institucional</p>
                    </center>
                </div>
              </div>
        </div>

        <div class="page-2">
            <div class="page-break">
                <div class="contenedor">
                    <div class="izquierda-data">
                        <div class="cert-details_">
                            <h4>FUNDACIÓN INSTITUTO DE MEDIACIÓN</h4>
                            <p>HABILITACIÓN Nº 21</p>
                            <p>LUGAR EMISIÓN: Resistencia, Chaco</p>
                            <p>FECHA: {{ $cert->createdAt }}</p>
                            <p> {{ $cert->tfCertificadoNumero }} - Certificado Nº: {{ $cert->certificadoNumero }}</p>
                        </div>
                    </div>
                    <div class="derecha-qr">
                        <img height="160px" src="data:image/png;base64, {{ $qr }}" alt="Código QR">
                    </div>
                    <div class="homologacion-container">
                        <div class="row">
                            <p class="p-homologacion">Homologado por:</p>
                            <p class="p-homologacion">{{ $cert->cursoHomologacion }}</p>
                        </div>
                    </div>
            </div>
        </div>
    </body>
</body>
</html>