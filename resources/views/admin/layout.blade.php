<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard FIMe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('bootadmin/css/bootadmin.min.css') }}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" href="{{ asset('bootadmin/css/fontawesome-all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--===============================================================================================-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700' rel='stylesheet' type='text/css'>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha256-nbyata2PJRjImhByQzik2ot6gSHSU4Cqdz5bNYL2zcU=" crossorigin="anonymous" />
    <!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap4-theme.min.css')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css" integrity="sha256-NkyhTCRnLQ7iMv7F3TQWjVq25kLnjhbKEVPqGJBcCUg=" crossorigin="anonymous" />
    <!--===============================================================================================-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    @yield('stylesheet')

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        @include('admin.includes.navbar')
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            @include('admin.includes.sidebar')
        </div>

        <div class="content p-4">
            @include('admin.includes.flashmessage')
            @yield('content')
        </div>
    </div>

    <!---------------------------
    // SECCION SCRIPT.
    ---------------------------->
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="{{ mix('js/app.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}" charset="utf-8"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('bootadmin/js/bootadmin.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js" integrity="sha256-OG/103wXh6XINV06JTPspzNgKNa/jnP1LjPP5Y3XQDY=" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    @yield('script')

    <script type="text/javascript">
        
        //Dropzone General Config
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        Dropzone.autoDiscover = false;
        
        //Dropzone Files Multimedia
        if (document.getElementById('dropzone-multimedia')) {
            var myDropzone = new Dropzone("#dropzone-multimedia",{ 
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf",
                init: function() {
                    this.on("success", function(file, response) {
                        additem(response);
                    });
                }
            });

            myDropzone.on("sending", function(file, xhr, formData) {
               formData.append("_token", CSRF_TOKEN);
            }); 
        }

        var openFile = function(event) {
        var input = event.target;

        var reader = new FileReader();
            reader.onload = function(){
              var dataURL = reader.result;
              var output = document.getElementById('output');
              output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
    };

       
    </script>

</body>
</html>