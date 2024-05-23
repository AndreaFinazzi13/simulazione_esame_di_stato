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
        <title> Gestione stazioni </title>
    
        <!--inclusione della libreria che permette di usare gli script-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!--inclusione del file javascript-->
        <script src="../js/operazioniStazione.js"></script>

        <!--foglio di stile interno-->
        <link rel="stylesheet" href="../style/style.css">

        <script>
            //controllo se il documento è stato caricato
            $("document").ready(function(){
                //riempimento della tabella con le stazioni presenti nel database
                //richiesta get
                $.get("../ajax/getStazioni.php", function(data){
                    
                    //controllo che l'operazione sia andata a buon fine
                    if(data["status"] == "ok"){
                        //inserimento nell'apposita tabella delle stazioni ottenute con ajax
                        $("#tabellaStazioni").html(data.message);
                    }
                    else    
                        //visualizzazione errore 
                        alert(data["message"]);
                }, 'json');
            });

            //inserimento nuova stazione nel db
            function inserisciStazione(){
                //reindirizzamento alla pagina di inserimento stazione
                window.location.href="addStazione.php";
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
        <div id="formStazioni">
            <!--titolo interno alla pagina-->
            <h1> Pagina di gestione delle stazioni </h1>

            <!--sottotitolo-->
            <h2>Lista stazioni</h2>
            <table id="tabellaStazioni"></table>

            <!--bottone per inserire una stazione nuova-->
            <button class="b" type="button" onclick="inserisciStazione()"> Aggiungi nuova stazione </button><br>

            <!--bottone per tornare alla home-->
            <button class="b" type="button" onclick="back()"> Indietro </button>

            <!--sezione di modifica-->
            <div class="divModificaStazione">
                <!--titolo della sezione-->
                <h1 id="titolo"></h1>
                
                <!--spazio di inserimento del nome della stazione-->
                Nome: <input type="text" id="nome" name="nome"> <br>
                <!--spazio di inserimento del numero di slot-->
                Numero di slot: <input type="number" id="nSlot" name="nSlot"> <br>
                <!--spazio di inserimento del numero civico-->
                Numero civico: <input type="number" id="civico" name="civico"> <br>

                <!--bottone per effettuare la modifica-->
                <button class="b" type="button" onclick="modificaStazione()"> Modifica </button> <br>
                <!--bottone per effettuare chiudere la sezione di modifica-->
                <button class="b" type="button" onclick="chiudiModifiche()"> Chiudi </button> <br>
            </div>
        </div>
    </body>
</html>