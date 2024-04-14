<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--===============================================================================================-->
    <meta property="og:site_name" content="FIME Int" />
    <meta property="og:title" content="Fundación Instituto de Mediación" />
    <meta property="og:description" content="Fundación Instituto de Mediación - Chaco Resistencia" />
    <meta property="og:url" content="https://fimeint.org/" />
    <meta property="og:determiner" content="the" />
    <meta property="og:locale" content="es_AR" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:image" content="https://fimeint.org/images/nuevo-logo-fime.png" />
  
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/icon" href="{{asset('images/favicon.png')}}"/>
    @yield('title_and_meta')
    <!--===============================================================================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" />
    <!--===============================================================================================-->
    <!-- Slick slider -->
    <link href="{{asset('css/slick.css')}}" rel="stylesheet">
    <!-- Fontawesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <!--===============================================================================================-->
    <!-- Google Fonts Raleway -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700" rel="stylesheet"> --}}
    <!-- Google Fonts Open sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap4-theme.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    @yield('mark-up-facebook')
     @yield('styles')
	</head>
  <body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v6.0"></script>
   <!--SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

  	<!-- Start Header -->
	@include('sitio.includes.header')

	<!-- Start main content -->
	<main>
		@yield('content')
	</main>
	
	<!-- Start footer -->
	@include('sitio.includes.footer')

	<!-- Scripts -->
	<!--  include 'includes/script.php';	 -->
	<!--===============================================================================================-->
	<!-- Facebook -->
	<div id="fb-root"></div>
	<!--===============================================================================================-->
	<!-- Main -->
	<script src="{{ mix('js/app.js') }}"></script>
	<!--===============================================================================================-->
	<!-- Google Recaptcha -->
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  <!-- Owl Carucel -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
	<!--===============================================================================================-->
  <!-- Progress Bar -->
  <script src="https://unpkg.com/circlebars@1.0.3/dist/circle.js"></script>
  <!-- Slick slider -->
  <script type="text/javascript" src="{{asset('js/slick.min.js') }}"></script>
  <!-- Filterable Gallery js -->
  <script type="text/javascript" src="{{asset('js/jquery.filterizr.min.js') }}"></script>
  <!-- Gallery Lightbox -->
  <script type="text/javascript" src="{{asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
	<script type="text/javascript">

    @if(session('success'))
      var msg = '{{ session('success') }}';
      swal.fire({
        position: 'center',
        type: 'success',
        title: msg,
        showConfirmButton: false,
        timer: 5500,
        icon: 'success',
      })
    @endif   

    //Disabled btn on click
    $(document).ready(function () {   
      $('#btnSubmit').on('click', function () {   
        var myForm = $("form");   
        if (myForm) {   
          $(this).prop('disabled', true);   
          $(myForm).submit();   
        }   
      });   
    });   

  </script>
  @yield('script')
  </body>
</html>