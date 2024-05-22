idBici=-1;

//quando la pagina viene caricata
$(document).ready(async function () {
    $(".divModificaBici").hide();
});
  
//metodo che permette all'admin di inserire una nuova bici
function inserisci(){
    //salvataggio di tutte le variabili passate
    let seriale=$("#seriale").val();
    let rfd=$("#rfd").val();
    let gps=$("#gps").val();

    //controllo se l'utente ha fornito un input valido
    if(seriale =="" ||  rfd == "" || gps == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //controllo integrità input
    else if(seriale.length != 10 || rfd.length != 16 || gps.length != 16){
        //visualizzazione errore (input errato)
        alert("ERRORE! La lunghezza dei campi inseriti è errata");
    }
    //input corretto
    else{
        //richiesta get
        $.get("../ajax/ajaxAddBici.php", {seriale: seriale, rfd: rfd, gps: gps}, function(data){
            //visualizzazione del risultato dell'operazione
            alert(data["message"]);

        }, 'json');
    }
}

//chiusura della sezione di modifica delle bici
function chiudiModifiche(){
    //chiusura
    $(".divModificaBici").hide();
}

//apertura della sezione nella quale inserire i nuovi valori della bici
function modifica(id, seriale){
    //titolo azzerato
    $("#titolo").html("");
    //salvataggio dell'id e del nome della bici selezionata
    idBici = id;
    //inserimento del nome della bici che si sta modificando
    $("#titolo").append("Modifica della bici " + seriale);

    //visualizzazione del div in cui si possono inserire i nuovi valori
    $(".divModificaBici").show();
}

//metodo che permette all'admin di modificare i parametri di una bici
function modificaBici(){
    //salvataggio di tutte le variabili passate
    let seriale=$("#seriale").val();
    let rfd=$("#rfd").val();
    let gps=$("#gps").val();
    let id=idBici;

    //controllo se l'utente ha fornito un input valido
    if(seriale =="" || rfd == "" || gps == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //richiesta get
        $.get("../ajax/modifyBici.php", {seriale: seriale, rfd: rfd, gps: gps, id: id}, function(data){
            //visualizzazione del risultato dell'operazione
            alert(data["message"]);

            //controllo se l'operazione è riuscita
            if(data["status"] == "ok"){
                //visualizzazione tabella modificata
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
            }
                
        }, 'json');
    }
}

//metodo che permette all'admin di cancellare una bici dal db
function elimina(id){
    idBici=id;

    //richiesta get
    $.get("../ajax/deleteBici.php", {idBici: idBici}, function(data){
        //visualizzazione del risultato dell'operazione
        alert(data["message"]);

        //controllo se l'operazione è riuscita
        if(data["status"] == "ok"){
            //visualizzazione tabella modificata
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
        }

    }, 'json');
}
