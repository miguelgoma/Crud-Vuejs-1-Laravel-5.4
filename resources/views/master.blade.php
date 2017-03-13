<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empleados</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/justified-nav.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="masthead">
        <nav class="navbar navbar-light bg-faded rounded mb-3"></nav>
      </div>
        <div class="container" id="manage-vue">
      @yield('content')
    </div>
    
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <h2>Reportes</h2>
            <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"> Exportar datos <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <!--<li><a href="{{route('htmltopdf',['downloadpdf'=>'pdf'])}}">En PDF</a></li>-->
                  <li><a href="{{ route('htmltopdf',['downloadexcel'=>'excel']) }}">En Excel</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>
        </div>
        <footer class="footer">
            <p>&copy; Company 2017</p>
        </footer>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/empleados.js"></script>
  </body>
</html>