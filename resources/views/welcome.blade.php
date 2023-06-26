<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <link rel="stylesheet" type="text/css" media="screen" href="css/app.css" /> 

    </head>
    <body>

        <div class="wellcome">
            <h1>Bem vindo ao seu encurtador de links favorito!</h1>
        </div>

        <div class="container">

            <div class="formulario">
                <form action="{{route('encurtador.store')}}" method="POST">
                    <label for="link">Link:</label>
                    <input type="text" id="link" value="{{old('link')}}" name="link" required>
                    <button type="submit">Encurtar</button>
                </form>
            </div>
            <div class="linkGerado" onclick="copiarLink()">
                @if (isset($_GET['link_original']) && isset($_GET['link_encurtado']))
                Click para copiar: <a href="{{env('APP_URL'). 'l/' . $_GET['link_encurtado']}}" class="url">{{env('APP_URL'). 'l/' . $_GET['link_encurtado']}}</a>
                @endif
                
                @if (isset($_GET['link']))
                    <a href="{{env('APP_URL'). 'l/' . $_GET['link']}}" class="url"> {{env('APP_URL'). 'l/' . $_GET['link']}}</a>
                @endif
            </div>
        </div>
        
        <script>
            function copiarLink()
            {
                let url = document.querySelector('.url').href;

                var copyTextarea = document.createElement("textarea");
                copyTextarea.style.position = "fixed";
                copyTextarea.style.opacity = "0";
                copyTextarea.textContent = url;
            
                document.body.appendChild(copyTextarea);
                copyTextarea.select();
                document.execCommand("copy");
                document.body.removeChild(copyTextarea);
                
            }
        </script>

    </body>
</html>
