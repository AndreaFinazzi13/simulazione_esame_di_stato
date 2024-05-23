<html>
    <head>
        <!--titolo della pagina-->
        <title> Registrazione nuovo utente </title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione della libreria per crittograffazione password-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/accesso.js"></script>

        <!--foglio di stile interno-->
        <link rel="stylesheet" href="../style/style.css">

        <script>
            //torna a index
            function back(){
                //reindirizzamento alla pagina home
                window.location.href="../index.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formRegistra">
            <!--titolo interno alla pagina-->
            <h1> Pagina di registrazione </h1>

            <!--spazio di inserimento della mail-->
            Mail: <input type="text" id="mail" name="mail"> <br>
            <!--spazio di inserimento della password-->
            Password: <input type="password" id="password" name="password"> <br>
            <!--spazio di conferma della password-->
            Conferma password: <input type="password" id="password2" name="password2"> <br>
            <!--spazio di inserimento del nome-->
            Nome: <input type="text" id="nome" name="nome"> <br>
            <!--spazio di inserimento del cognome-->
            Cognome: <input type="text" id="cognome" name="cognome"> <br>
            <!--spazio di inserimento del codice della carta di credito-->
            Codice carta di credito: <input type="text" id="cartaCredito" name="cartaCredito"> <br>

            <!--spazio di inserimento dell'indirizzo-->
            Indirizzo <br>
            Civico: <input type="text" id="civico" name="civico"> <br>
            Via: <input type="text" id="via" name="via"> <br>
            Paese: <input type="text" id="paese" name="paese"> <br>
            Provincia: <input type="text" id="provincia" name="provincia"> <br>
            Regione: <input type="text" id="regione" name="regione"> <br>
            Stato: <input type="text" id="stato" name="stato"> <br>

            <!--bottone per effettuare la registrazione-->
            <button class="b" type="button" onclick="registrazione()"> Registrazione </button> <br>
            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Home </button>
        </div>
    </body>
</html>