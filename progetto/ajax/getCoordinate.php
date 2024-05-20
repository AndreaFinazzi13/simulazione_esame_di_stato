<?php
    //settaggio della risposta in json 
    header('Content-Type: application/json');
    //inclusione delle credenziali
    require_once("../database/credenziali.php");

    //variabili per l'utilizzo del database (all'interno delle variabili ci sono già i dati salvati nelle medesime variabili all'interno di "credenziali")
    global $host, $user, $psw, $dbname;

    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
    //query sql per ricercare l'utente inserito nel database
    $sql= "SELECT via, latitudine, longitudine, numeroBiciDisponibili FROM stazione";

    //preparazione della query per verificare eventuali errori
    $stmt = $conn->prepare($sql);

    //controllo se la preparazione della query presenta errori
    if (!$stmt) 
        //comunicazione di eventuali errori
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    
    //esecuzione della query creata
    if (!$stmt->execute()) 
        //comunicazione dell'errore nell'esecuzione della query
        throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);

    //salvataggio risultati in apposita variabile
    $result = $stmt->get_result();

    //controllo se c'è almeno una riga di risultato
    if ($result->num_rows >= 1) {
        
        //variabile in cui salvare tutti i dati
        $res="";

        //scorrimento di tutti i record
        while ($row = $result->fetch_assoc()) {
            //lettura dei dati di interesse (latitudine e longitudine)
            $via = $row['via'];
            $latitudine = $row['latitudine'];
            $longitudine = $row['longitudine'];
            $numeroBiciDisponibili = $row['numeroBiciDisponibili'];
            
            //aggiunta del nuovo record alla stringa di ritorno
            $res .= $via . "," . $latitudine . "," . $longitudine . "," . $numeroBiciDisponibili . ";";
        }
        

        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "ok", "message" => $res);
        //conversione dell'array in formato json e visualizzazione
        echo json_encode($arr);
    }
    //se il risultato non c'è (non possono esserci più righe uguali)
    else {
        //salvataggio della risposta in un nuovo array
        $arr = array("status" => "no", "message" => "Stazioni non trovate");
        //conversione dell'array in formato json e return a js
        echo json_encode($arr);
    }

