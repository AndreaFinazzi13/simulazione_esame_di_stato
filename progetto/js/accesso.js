//metodo che permette di loggarsi al sito controllando le credenziali
function login(){
    //ottenimento username
    let mail=$("#mail").val();
    //ottenimento password
    let password=$("#password").val();
    //ruolo utente
    let ruolo = "cliente";

    //controllo se si sta loggando un utente o un admin (gli admin hanno nella mail @vincentibike.com)
    if(mail.includes("@vincentibike.com"))
        //l'utente è admin
        ruolo="admin";

    //controllo se l'utente ha fornito un input valido
    if(mail == "" || password == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }

    //input corretto
    else{
        //cripting password
        let pswMD5 = CryptoJS.MD5(password).toString();
        
        //richiesta get
        $.get("../ajax/ajaxLogin.php", {mail: mail, password: pswMD5, ruolo: ruolo}, function(data){
            
            //controllo che il login sia andato a buon fine
            if(data["status"] == "ok"){
                //controllo se l'utente loggato è l'admin o un utente comune
                if(ruolo == "admin")
                    //reindirizzamento alla pagina dell'admin
                    window.location.href = "../pages/paginaAdmin.php";
                //se l'utente loggato non è admin
                else
                    //reindirizzamento alla pagina di un utente comune
                    window.location.href="../pages/paginaCliente.php";
            }
            else    
                //visualizzazione errore (input errato)
                alert(data["n"]);
        }, 'json');
    }
}

//metodo che permette all'admin di registrare un nuovo utente
function registrazione(){
    //salvataggio mail
    let mail=$("#mail").val();
    //salvataggio password
    let password=$("#password").val();
    //salvataggio password di conferma
    let password2=$("#password2").val();
    //salvataggio nome
    let nome=$("#nome").val();
    //salvataggio cognome
    let cognome=$("#cognome").val();
    //salvataggio carta di credito
    let cartaCredito=$("#cartaCredito").val();

    //indirizzo
    //salvataggio civico
    let civico=$("#civico").val();
    //salvataggio via
    let via=$("#via").val();
    //salvataggio paese
    let paese=$("#paese").val();
    //salvataggio provincia
    let provincia=$("#provincia").val();
    //salvataggio regione
    let regione=$("#regione").val();
    //salvataggio stato
    let stato=$("#stato").val();

    //controllo se l'admin ha inserito correttamente la password e la conferma password
    if(password != password2){
        //visualizzazione errore (password diverse)
        alert("ERRORE! Le due password non corrispondono");
    }
    //controllo se l'utente ha fornito un input valido
    else if(mail == "" || password == "" || nome == "" || cognome == "" || cartaCredito == "" || via == "" || civico == null || paese == "" || provincia == "" || regione == "" || stato == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //cripting password
        let pswMD5 = CryptoJS.MD5(password).toString();
        //richiesta get
        $.get("../ajax/ajaxRegistra.php", {mail: mail, password: pswMD5, nome: nome, cognome: cognome, cartaCredito: cartaCredito, civico: civico, via: via, paese: paese, provincia: provincia, regione: regione, stato: stato}, function(data){
            //visualizzazione del risultato della registrazione
            alert(data["message"]);

        }, 'json');
    }
}

function logout(){
    window.location.href="logout.php";
}