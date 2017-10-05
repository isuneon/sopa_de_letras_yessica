<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Laravel</title>

    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Title</a>
                </div>
        
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <form action="{{ URL::to('/test')}}" method="POST" role="form">
                    <legend>Sopa de Letras</legend>
                     {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Palabra a Buscar</label>
                        <input type="text" class="form-control" id="palabra" placeholder="Palabra a Buscar">
                    </div>
                    <div class="form-group">
                        <label for="">Palabra a Buscar</label>
                        <select class="form-control" id="matriz">
                            <option value="1">Matriz 1 Ejemplo</option>
                            <option value="2">Matriz 2 Ejemplo</option>
                            <option value="4">Matriz 4 Ejemplo</option>
                        </select>
                    </div>

                    <button type="button" id="enviar" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </body>
</html>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script  type="text/javascript" charset="utf-8">
    $("#enviar").click(function(){
        $.ajax({
            headers:{
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            data: {"palabra" : $('#palabra').val(), "matriz": $('#matriz').val() },
            type: "POST",
            dataType: "json",
            url: "{{ URL::to('/test')}}",
            beforeSend: function() {    
                 $("#loader").removeClass("hidden");
            },
            success: function(data)   {
                alert(data);                 
            },
            error: function() {
                alert('ajax call failed...');
            }
        });
    });
</script>
