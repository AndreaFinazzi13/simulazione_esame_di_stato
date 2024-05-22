<?php
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
    $id=$_GET["id"];

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per inserire un nuovo cliente nel database
    $sql= "UPDATE stazione SET nome = ?, numeroSlot = ?, civico = ? WHERE ID = ?";
        
    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);
    //controllo se la preparazione della query presenta errori
    if (!$stmt) 
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    
    //inserimento dei parametri all'interno della query preparata
    //ss --> 2 stringhe
    $stmt->bind_param("siisssssiii", $nome, $nSlot, $civico, $id);
    
    //esecuzione della query creata
    if ($stmt->execute()){
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "ok", "message" => "Modifica della stazione effettuata");
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
