<!--controllo che la sessione sia partita-->
<?php 
    if (!isset($_SESSION)) {
        //inizializzazione sessione
        session_start();
    }
?>

<html>
    <head>
        <!--titolo della pagina-->
        <title> Inserimento nuova bici</title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/operazioniBici.js"></script>

        <script>
            //torna a index
            function back(){
                //reindirizzamento alla pagina home
                window.location.href="gestioneBici.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formLogin">
            <!--titolo interno alla pagina-->
            <h1> Pagina di inserimento bici </h1>

            <!--spazio di inserimento del numero seriale della bici-->
            Numero seriale(10 cifre): <input type="text" id="seriale" name="seriale"> <br>
            <!--spazio di inserimento dell'rfd della bici-->
            Codice rfd(16 cifre): <input type="text" id="rfd" name="rfd"> <br>
            <!--spazio di inserimento del gps della bici-->
            Codice gps(16 cifre): <input type="text" id="gps" name="gps"> <br>

            <!--bottone per effettuare l'inserimento-->
            <button class="b" type="button" onclick="inserisci()"> Inserisci </button> <br>
            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Indietro </button>
        </div>
    </body>
</html>