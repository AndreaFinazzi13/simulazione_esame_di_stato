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
        <title> Pagina cliente </title>

        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/accesso.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/operazioniCliente.js"></script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="form">
            <!--titolo interno alla pagina-->
            <h1> Pagina cliente </h1>

            <!--sottotitolo-->
            <h2>Informazioni sull'account</h2>

            <!--sezione in cui visualizzare le informazioni dell'utente loggato-->
            <table id="visualizzaAccount"></table>

            <!--sezione di modifica-->
            <div class="divModificaCliente">
                <!--titolo della sezione-->
                <h1> Modifica del profilo</h1>
                
                <!--spazio di inserimento della mail-->
                Mail: <input type="text" id="mail" name="mail"> <br>
                <!--spazio di inserimento dell'indirizzo-->
                Civico: <input type="number" id="civico" name="civico"> <br>
                Via: <input type="text" id="via" name="via"> <br>
                Paese: <input type="text" id="paese" name="paese"> <br>
                Provincia: <input type="text" id="provincia" name="provincia"> <br>
                Regione: <input type="text" id="regione" name="regione"> <br>
                Stato: <input type="text" id="stato" name="stato"> <br>

                <!--bottone per effettuare la modifica-->
                <button class="b" type="button" onclick="modificaCliente()"> Modifica </button> <br>
                <!--bottone per effettuare chiudere la sezione di modifica-->
                <button class="b" type="button" onclick="chiudiModifiche()"> Chiudi </button> <br>
            </div>

            <!--visualizzazione delle tratte percorse-->
            <!--titolo della sezione-->
            <h1> Tratte percorse </h1>
            <!--tabella di visualizzazione-->
            <table id="tabellaTrattePercorse"></table>
                

            <!--bottone per effettuare la logout-->
            <button class="b" type="button" onclick="logout()"> Logout </button>
        </div>
    </body>
</html>