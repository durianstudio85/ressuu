<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ressu.me @yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
   <!--  <link href='https://fonts.googleapis.com/css?family=Signika:400,600,300,700' rel='stylesheet' type='text/css'> -->
 <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/fav icon.png">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <script>
        $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
 
  

</head>

<header class="">
   <nav class="navbar navbar-default navbar-static-top navs">
      <div class="container">
        <div class=" navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <div class="col-md-3 logo"><a href="{{ url('/home') }}"><img src="../images/logo.png"></a></div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <nav class="col-md-3 navicon">
            
        </nav>
          <div class="col-md-6">
               <div class="inner-addon left-addon">
              
                </div>
          </div>
        </div>
      </div>
    </nav>
</header> 

<body class="@yield('body-class')">

 @yield('content')


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
</body>
</html>
