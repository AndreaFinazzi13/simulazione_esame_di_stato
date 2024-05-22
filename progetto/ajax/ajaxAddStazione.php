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

    //recupero degli attributi della nuova stazione
    $nome=$_GET["nome"];
    $nSlot=$_GET["nSlot"];
    $civico=$_GET["civico"];
    $via=$_GET["via"];
    $paese=$_GET["paese"];
    $provincia=$_GET["provincia"];
    $regione=$_GET["regione"];
    $stato=$_GET["stato"];
    $lat=$_GET["lat"];
    $lon=$_GET["lon"];

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per inserire una nuova stazione nel database
    $sql= "INSERT INTO stazione (nome, numeroSlot, civico, via, paese, provincia, regione, stato, latitudine, longitudine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);
    //controllo se la preparazione della query presenta errori
    if (!$stmt) 
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    
    //inserimento dei parametri all'interno della query preparata
    $stmt->bind_param("siisssssdd", $nome, $nSlot, $civico, $via, $paese, $provincia, $regione, $stato, $lat, $lon);
    
    //esecuzione della query creata
    if ($stmt->execute()){
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "ok", "message" => "Inserimento stazione effettuato");
        //conversione dell'array in formato json e visualizzazione
        echo json_encode($arr);
    }
    else{
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "no", "message" => "ERRORE! Operazione non riuscita");
        //conversione dell'array in formato json e return a js
        echo json_encode($arr);
    }

    //conclusione quey
    $stmt->close();
