<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard FIMe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="apple-icon.png">
    {{-- <link rel="shortcut icon" href="favicon.ico"> --}}
    <link rel="manifest" href="{{asset('manifest.json')}}">
    
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha256-nbyata2PJRjImhByQzik2ot6gSHSU4Cqdz5bNYL2zcU=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css" integrity="sha256-NkyhTCRnLQ7iMv7F3TQWjVq25kLnjhbKEVPqGJBcCUg=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app-dashboard.css') }}">
    <!--===============================================================================================-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    @yield('stylesheet')

</head>


    {{-- <nav class="navbar navbar-expand navbar-dark bg-primary">
    </nav>
    
    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            @include('admin.includes.sidebar')
        </div>
        
        <div class="content p-4">
            @include('admin.includes.flashmessage')
            @yield('content')
        </div>
    </div> --}}
    
    <body class="sb-nav-fixed">
        @include('admin.includes.navbar')
        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('admin.includes.sidebar')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    

        <!---------------------------
        // SECCION SCRIPT.
        ---------------------------->
        <!--===============================================================================================-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!--===============================================================================================-->
        <script src="{{ mix('js/app-dashboard.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}" charset="utf-8"></script>
        <!--===============================================================================================-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js" integrity="sha256-OG/103wXh6XINV06JTPspzNgKNa/jnP1LjPP5Y3XQDY=" crossorigin="anonymous"></script>
        <!--===============================================================================================-->
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="/js/sb-admin-scripts.js"></script>
        <script src="/js/sb-admin-datatables-simple-demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        @include ('_jsVariables')

        @yield('script') 

        <script src="{{ asset('js/fimeint.js') }}" type="text/javascript"></script>

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