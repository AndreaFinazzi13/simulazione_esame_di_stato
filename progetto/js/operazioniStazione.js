idStazione=-1;

//quando la pagina viene caricata
$(document).ready(async function () {
    $(".divModificaStazione").hide();
});
  

//metodo che permette all'admin di inserire una nuova stazione
function inserisci(){
    //salvataggio di tutte le variabili passate
    let nome=$("#nSlot").val();
    let nSlot=$("#nSlot").val();
    let civico=$("#civico").val();
    let via=$("#via").val();
    let paese=$("#paese").val();
    let provincia=$("#provincia").val();
    let regione=$("#regione").val();
    let stato=$("#stato").val();
    let lat=$("#lat").val();
    let lon=$("#lon").val();

    //controllo se l'utente ha fornito un input valido
    if(nome =="" || nSlot == null || civico == null || via == "" || paese == "" || provincia == "" || regione == "" || stato == "" || lat == null || lon == null){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //richiesta get
        $.get("../ajax/ajaxAddStazione.php", {nome: nome, nSlot: nSlot, civico: civico, via: via, paese: paese, provincia: provincia, regione: regione, stato: stato, lat: lat, lon: lon}, function(data){
            //visualizzazione del risultato dell'operazione
            alert(data["message"]);

        }, 'json');
    }
}

//chiusura della sezione di modifica delle stazioni
function chiudiModifiche(){
    //chiusura
    $(".divModificaStazione").hide();
}

//apertura della sezione nella quale inserire i nuovi valori della stazione
function modifica(id, nome){
    //titolo azzerato
    $("#titolo").html("");
    //salvataggio dell'id e del nome della stazione selezionata
    idStazione = id;
    //inserimento del nome della stazione che si sta modificando
    $("#titolo").append("Modifica della stazione " + nome);

    //visualizzazione del div in cui si possono inserire i nuovi valori
    $(".divModificaStazione").show();
}

//metodo che permette all'admin di modificare i parametri di una stazione
function modificaStazione(){
    //salvataggio di tutte le variabili passate
    let nome=$("#nome").val();
    let nSlot=$("#nSlot").val();
    let civico=$("#civico").val();
    let id=idStazione;

    //controllo se l'utente ha fornito un input valido
    if(nome =="" || nSlot == null || civico == null){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //richiesta get
        $.get("../ajax/modifyStazione.php", {nome: nome, nSlot: nSlot, civico: civico, id: id}, function(data){
            //visualizzazione del risultato dell'operazione
            alert(data["message"]);

            //controllo se l'operazione è riuscita
            if(data["status"] == "ok"){
                //visualizzazione tabella modificata
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
            }
                
        }, 'json');
    }
}

//metodo che permette all'admin di cancellare una stazione dal db
function elimina(id){
    idStazione=id;

    //richiesta get
    $.get("../ajax/deleteStazione.php", {idStazione: idStazione}, function(data){
        //visualizzazione del risultato dell'operazione
        alert(data["message"]);

        //controllo se l'operazione è riuscita
        if(data["status"] == "ok"){
            //visualizzazione tabella modificata
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
        }

    }, 'json');
}