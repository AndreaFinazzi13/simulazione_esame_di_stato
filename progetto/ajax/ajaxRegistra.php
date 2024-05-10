<?php
    //settaggio della risposta in json 
    header('Content-Type: application/json');
    //inclusione delle credenziali
    require_once("../database/credenziali.php");

    //variabili per l'utilizzo del database (all'interno delle variabili ci sono già i dati salvati nelle medesime variabili all'interno di "credenziali")
    global $host, $user, $psw, $dbname;

    try{
        //recupero dell'username e la password passati dall'admin
        $username=$_GET["username"];
        $password=$_GET["password"];

        //l'admin è solo uno ed è già stato creato
        $isAdmin=0;

        //connessione al database
        $conn = new mysqli($host, $user, $psw, $dbname);
        //controllo se si verifica un errore nella connessione al database
        if ($conn->connect_error) {
            //comunicazione del fallimento della connessione
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        //query sql per ricercare l'utente inserito dall'utente nel database
        $sql= "INSERT INTO utenti (ID, username, password, isAdmin) VALUES (NULL, ?, ?, ?)";
        //preparazione della query per verificare eventuali errori
        $stmt = $conn->prepare($sql);
        //controllo se la preparazione della query presenta errori
        if (!$stmt) 
            //comunicazione di eventuali errori
            throw new Exception("Errore nella preparazione della query: " . $conn->error);
        
        //inserimento dei parametri all'interno della query preparata
        //ss --> 2 stringhe
        $stmt->bind_param("ssi", $username, $password, $isAdmin);
        //esecuzione della query creata
        if ($stmt->execute()){
            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "ok", "message" => "Registrazione utente effettuata");
            //conversione dell'array in formato json e visualizzazione
            echo json_encode($arr);
        }
        else{
            //salvataggio della risposta in un nuovo array
            $arr = array("status" => "ko", "message" => "Username già utilizzato");
            //conversione dell'array in formato json e return a js
            echo json_encode($arr);
        }
        
    //gestione eccezioni
    } catch (Exception $e) {
        //login non andato a buon fine
        $arr = array("status" => "ko", "message" => $e->getMessage());
        //return a js
        echo json_encode($arr);
    }
