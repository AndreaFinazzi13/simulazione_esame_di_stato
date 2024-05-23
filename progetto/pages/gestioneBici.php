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
        <title> Gestione bici </title>
    
        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/operazioniBici.js"></script>

        <!--foglio di stile interno-->
        <link rel="stylesheet" href="../style/style.css">

        <script>
            //controllo se il documento è stato caricato
            $("document").ready(function(){
                //riempimento della tabella con le bici presenti nel database
                //richiesta get
                $.get("../ajax/getBici.php", function(data){
                    
                    //controllo che l'operazione sia andata a buon fine
                    if(data["status"] == "ok"){
                        //inserimento nell'apposita tabella delle bici ottenute con ajax
                        $("#tabellaBici").html(data.message);
                    }
                    else    
                        //visualizzazione errore 
                        alert(data["message"]);
                }, 'json');
            });

            //inserimento nuova bici nel db
            function inserisciBici(){
                //reindirizzamento alla pagina di inserimento bici
                window.location.href="addBici.php";
            }

            //torna a index
            function back(){
                //reindirizzamento alla pagina home
                window.location.href="paginaAdmin.php";
            }
        </script>
    </head>
    <body>
        <!--contenitore degli elementi html-->
        <div id="formBici">
            <!--titolo interno alla pagina-->
            <h1> Pagina di gestione delle bici </h1>

            <!--sottotitolo-->
            <h2>Lista bici</h2>
            <table id="tabellaBici"></table>

            <!--bottone per inserire una bici-->
            <button class="b" type="button" onclick="inserisciBici()"> Aggiungi nuova bici </button><br>

            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Indietro </button>

            <!--sezione di modifica-->
            <div class="divModificaBici">
                <!--titolo della sezione-->
                <h1 id="titolo"></h1>
                
                <!--spazio di inserimento del numero seriale della bici-->
                Numero seriale: <input type="text" id="seriale" name="seriale"> <br>
                <!--spazio di inserimento del codice rfd-->
                Codice rfd: <input type="text" id="rfd" name="rfd"> <br>
                <!--spazio di inserimento del codice gps-->
                Codice gps: <input type="text" id="gps" name="gps"> <br>

                <!--bottone per effettuare la modifica-->
                <button class="b" type="button" onclick="modificaBici()"> Modifica </button> <br>
                <!--bottone per effettuare chiudere la sezione di modifica-->
                <button class="b" type="button" onclick="chiudiModifiche()"> Chiudi </button> <br>
            </div>
        </div>
    </body>
</html>