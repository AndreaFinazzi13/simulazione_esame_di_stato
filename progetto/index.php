<html>
    <head>
        <!--in questa pagina visualizzare la mappa e fornire la possibilità di loggarsi-->
        <!--titolo del documento-->
        <title> Pagina iniziale </title>
        <meta charset="utf-8">

        <!--layout pagina-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--foglio di stile Leaflet-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <!--foglio di stile interno-->
        <link rel="stylesheet" href="style/style.css">

        <!--inclusione della libreria che permette di usare lo script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--script leaflet-->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <!--inclusione della pagina interna in cui si gestisce leaflet-->
        <script src="js/leaflet.js"></script>

        <!--parte di scripting-->
        <script>
            //metodo che permette di reindirizzare l'esecuzione verso la pagina di login degli utenti
            function goToLogin(){
                //reindirizzamento alla pagina di login
                window.location.href="pages/login.php";
            }
            //metodo che permette di reindirizzare l'esecuzione verso la pagina di login degli utenti
            function goToRegistra(){
                //reindirizzamento alla pagina di registrazione
                window.location.href="pages/registrazione.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formVisualizza">
            <h1> Noleggio biciclette Brescia</h1> <br>
            <!--bottone per registrarsi-->
            <button class="b" type="button" onclick="goToRegistra()"> Registrati</button> <br>
            Hai gia' un account?
            <!--bottone per loggarsi-->
            <button class="b" type="button" onclick="goToLogin()"> Login </button>
            <!--spazio di inserimento mappa-->
            <div id="contenitoreMappa">
                <!--spazio in cui inserire la mappa-->
                <div id="mappaBrescia"></div>
            </div>
        </div>
    </body>
</html>