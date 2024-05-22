<?php
    //controllo che la sessione sia partita
    if (!isset($_SESSION)) 
        //inizializzazione sessione
        session_start();
        
    //settaggio della risposta in json 
    header('Content-Type: application/json');
    //inclusione delle credenziali
    require_once("../database/credenziali.php");

    //variabili per l'utilizzo del database (all'interno delle variabili ci sono già i dati salvati nelle medesime variabili all'interno di "credenziali")
    global $host, $user, $psw, $dbname;

    //recupero della mail, della password e del ruolo passati dall'utente
    $mail=$_GET["mail"];
    $password=$_GET["password"];
    $ruolo=$_GET["ruolo"];

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query di login admin
    if($ruolo == "admin"){
        //query sql per ricercare l'utente inserito nel database
        $sql= "SELECT * FROM admin WHERE email = ? AND password = ?";

        //preparazione della query per verificare eventuali errori
        $stmt = $conn->prepare($sql);

        //controllo se la preparazione della query presenta errori
        if (!$stmt) 
            //comunicazione di eventuali errori
            throw new Exception("Errore nella preparazione della query: " . $conn->error);
        
        //inserimento dei parametri all'interno della query preparata
        //ss --> 2 stringhe
        $stmt->bind_param("ss", $mail, $password);
        
        //esecuzione della query creata
        if (!$stmt->execute()) 
            //comunicazione dell'errore nell'esecuzione della query
            throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

        //salvataggio risultati in apposita variabile
        $result = $stmt->get_result();

        //controllo se c'è una riga di risultato
        if ($result->num_rows == 1) {
            //estrazione del risultato della query
            $row = $result->fetch_assoc();

            //avvio sessione
            session_start();
            //salvataggio dell'username nella variabile di sessione
            $_SESSION["mail"] = $mail;

            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "ok", "message" => "Login effettuato");
            //conversione dell'array in formato json e visualizzazione
            echo json_encode($arr);
        }
        //se il risultato non c'è (non possono esserci più righe uguali)
        else {
            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "no", "message" => "Credenziali non valide");
            //conversione dell'array in formato json e return a js
            echo json_encode($arr);
        }
    }
    //query di login cliente
    else{
        //query sql per ricercare l'utente inserito nel database
        $sql= "SELECT * FROM cliente WHERE email = ? AND password = ?";

        //preparazione della query per verificare eventuali errori
        $stmt = $conn->prepare($sql);

        //controllo se la preparazione della query presenta errori
        if (!$stmt) 
            //comunicazione di eventuali errori
            throw new Exception("Errore nella preparazione della query: " . $conn->error);
        
        //inserimento dei parametri all'interno della query preparata
        //ss --> 2 stringhe
        $stmt->bind_param("ss", $mail, $password);
        
        //esecuzione della query creata
        if (!$stmt->execute()) 
            //comunicazione dell'errore nell'esecuzione della query
            throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

        //salvataggio risultati in apposita variabile
        $result = $stmt->get_result();

        //controllo se c'è una riga di risultato
        if ($result->num_rows == 1) {
            //estrazione del risultato della query
            $row = $result->fetch_assoc();

            //avvio sessione
            session_start();
            //salvataggio dell'username nella variabile di sessione
            $_SESSION["mail"] = $mail;

            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "ok", "message" => "Login effettuato");
            //conversione dell'array in formato json e visualizzazione
            echo json_encode($arr);
        }
        //se il risultato non c'è (non possono esserci più righe uguali)
        else {
            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "no", "message" => "Credenziali non valide");
            //conversione dell'array in formato json e return a js
            echo json_encode($arr);
        }
    }
        
