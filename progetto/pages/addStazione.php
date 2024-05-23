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
        <title> Inserimento nuova stazione</title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/operazioniStazione.js"></script>

        <!--foglio di stile interno-->
        <link rel="stylesheet" href="../style/style.css">

        <script>
            //torna a index
            function back(){
                //reindirizzamento alla pagina home
                window.location.href="gestioneStazioni.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formLogin">
            <!--titolo interno alla pagina-->
            <h1> Pagina di inserimento stazioni </h1>

            <!--spazio di inserimento del nome della stazione-->
            Nome: <input type="text" id="nome" name="nome"> <br>
            <!--spazio di inserimento del numero di slot-->
            Numero di slot: <input type="number" id="nSlot" name="nSlot"> <br>
            <!--spazio di inserimento del numero civico-->
            Numero civico: <input type="number" id="civico" name="civico"> <br>
            <!--spazio di inserimento della via-->
            Via: <input type="text" id="via" name="via"> <br>
            <!--spazio di inserimento del paese-->
            Città: <input type="text" id="paese" name="paese"> <br>
            <!--spazio di inserimento della provincia-->
            Provincia: <input type="text" id="provincia" name="provincia"> <br>
            <!--spazio di inserimento della regione-->
            Regione: <input type="text" id="regione" name="regione"> <br>
            <!--spazio di inserimento dello stato-->
            Stato: <input type="text" id="stato" name="stato"> <br>
            <!--spazio di inserimento della latitudine-->
            Latitudine: <input type="number" id="lat" name="lat" step="0.0000001"> <br>
            <!--spazio di inserimento della longitudine-->
            Longitudine: <input type="number" id="lon" name="lon" step="0.0000001"> <br>

            <!--bottone per effettuare l'inserimento-->
            <button class="b" type="button" onclick="inserisci()"> Inserisci </button> <br>
            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Indietro </button>
        </div>
    </body>
</html>