<html>
    <head>
        <!--titolo della pagina-->
        <title> Login utente </title>

        <!--inclusione della libreria per crittograffazione password-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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
        <div id="formLogin">
            <!--titolo interno alla pagina-->
            <h1> Pagina di login </h1>

            <!--spazio di inserimento dell'username-->
            <input type="text" id="mail" name="mail" placeholder="mail"> <br>
            <!--spazio di inserimento della password-->
            <input type="password" id="password" name="password" placeholder="password"> <br>

            <!--bottone per effettuare la login-->
            <button class="b" type="button" onclick="login()"> Login </button> <br>
            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Home </button>
        </div>
    </body>
</html>