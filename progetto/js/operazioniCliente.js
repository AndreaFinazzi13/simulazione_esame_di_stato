idCliente=-1;

//quando la pagina viene caricata
$(document).ready(async function () {
    //tabella di modifica oscurata
    $(".divModificaCliente").hide();

    //riempimento della tabella con le informazioni dell'account presenti nel database
    //richiesta get
    $.get("../ajax/getCliente.php", function(data){
        
        //controllo che l'operazione sia andata a buon fine
        if(data["status"] == "ok"){
            //inserimento nell'apposita tabella delle informazioni del cliente ottenute con ajax
            $("#visualizzaAccount").html(data.message);
        }
        else    
            //visualizzazione errore 
            alert(data["message"]);
    }, 'json');

    //riempimento della tabella con le informazioni riguardanti le tratte percorse dal cliente loggato
    //richiesta get
    $.get("../ajax/getTratte.php", function(data){
        
        //controllo che l'operazione sia andata a buon fine
        if(data["status"] == "ok"){
            //inserimento nell'apposita tabella delle informazioni delle tratte percorse dal cliente
            $("#tabellaTrattePercorse").html(data.message);
        }
        else    
            //visualizzazione errore 
            alert(data["message"]);
    }, 'json');
});

//chiusura della sezione di modifica delle informazioni del cliente
function chiudiModifiche(){
    //chiusura
    $(".divModificaCliente").hide();
}

//apertura della sezione nella quale inserire i nuovi valori del cliente
function modifica(id){
    //titolo azzerato
    $("#titolo").html("");
    //salvataggio dell'id e del nome del cliente selezionato
    idCliente = id;
    //inserimento del nome del cliente che si sta modificando
    $("#titolo").append("Modifica del profilo");

    //visualizzazione del div in cui si possono inserire i nuovi valori
    $(".divModificaCliente").show();
}

//metodo che permette all'utente di modificare i parametri del suo profilo
function modificaCliente(){
    //salvataggio di tutte le variabili passate
    let mail=$("#mail").val();
    let civico=$("#civico").val();
    let via=$("#via").val();
    let paese=$("#paese").val();
    let provincia=$("#provincia").val();
    let regione=$("#regione").val();
    let stato=$("#stato").val();
    let id=idCliente;

    //controllo se l'utente ha fornito un input valido
    if(mail =="" || civico == null || via == "" || paese == "" || provincia == "" || regione == "" || stato == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //richiesta get
        $.get("../ajax/modifyCliente.php", {mail: mail, civico: civico, via: via, paese: paese, provincia: provincia, regione: regione, stato: stato, id: id}, function(data){
            //visualizzazione del risultato dell'operazione
            alert(data["message"]);

            //controllo se l'operazione è riuscita
            if(data["status"] == "ok"){
                //visualizzazione tabella modificata
                //riempimento della tabella con le stazioni presenti nel database
                //richiesta get
                $.get("../ajax/getCliente.php", function(data){
                    
                    //controllo che l'operazione sia andata a buon fine
                    if(data["status"] == "ok"){
                        //inserimento nell'apposita tabella delle stazioni ottenute con ajax
                        $("#visualizzaAccount").html(data.message);
                    }
                    else    
                        //visualizzazione errore 
                        alert(data["message"]);
                }, 'json');
            }
                
        }, 'json');
    }
}