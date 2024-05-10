//modificare la login() e ajaxRegistrannnnn


//metodo che permette di loggarsi al sito controllando le credenziali
function login(){
    //ottenimento username
    let username=$("#username").val();
    //ottenimento password
    let password=$("#password").val();

    //controllo se l'utente ha fornito un input valido
    if(username == "" || password == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto (admin)
    else{
        //cripting password
        let pswMD5 = CryptoJS.MD5(password).toString();
        
        //richiesta get
        $.get("../ajax/ajaxLogin.php", {username: username, password: pswMD5}, function(data){
            try{
                //controllo che il login sia andato a buon fine
                if(data["status"] == "ok"){
                    //controllo se l'utente loggato è l'admin o un utente comune
                    if(data["isAdmin"] == 1)
                        //reindirizzamento alla pagina dell'admin
                        window.location.href = "../pages/paginaAdmin.php";
                    //se l'utente loggato non è admin
                    else
                        //reindirizzamento alla pagina di un utente comune
                        window.location.href="../pages/paginaUtente.php";
                }

            //gestone errori
            } catch(error){
                //visualizzazione errore
                alert(error);
            }
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
    //salvataggio via
    let via=$("#via").val();
    //salvataggio cap
    let cap=$("#cap").val();
    //salvataggio paese
    let paese=$("#paese").val();
    //salvataggio regione
    let regione=$("#regione").val();
    //salvataggio stato
    let stato=$("#stato").val();

    //controllo se l'admin ha inserito correttamente la password e la conferma password
    if(password != "" || password != password2){
        //visualizzazione errore (password diverse)
        alert("ERRORE! Le due password non corrispondono");
    }
    //controllo se l'utente ha fornito un input valido
    else if(mail == "" || nome == "" || cognome == "" || via == "" || cap == "" || paese == "" || regione == "" || stato == ""){
        //visualizzazione errore (input incompleto)
        alert("ERRORE! Compilare tutti i campi");
    }
    //input corretto
    else{
        //cripting password
        let pswMD5 = CryptoJS.MD5(password).toString();
        //richiesta get
        $.get("../ajax/ajaxRegistra.php", {username: username, password: pswMD5, nome: nome, cognome: cognome, via: via, cap: cap, paese: paese, regione: regione, stato: stato}, function(data){
            try{
                //visualizzazione del risultato della login
                alert(data["message"]);
            //gestone errori
            } catch(error){
                //visualizzazione errore
                alert(error);
            }
        }, 'json');
    }
}