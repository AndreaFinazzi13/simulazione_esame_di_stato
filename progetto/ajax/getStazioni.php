<?php
//settaggio della risposta in json 
header('Content-Type: application/json');
//inclusione delle credenziali
require_once("../database/credenziali.php");

//variabili per l'utilizzo del database (all'interno delle variabili ci sono già i dati salvati nelle medesime variabili all'interno di "credenziali")
global $host, $user, $psw, $dbname;

try {
    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);

    //controllo se si verifica un errore nella connessione al database
    if ($conn->connect_error) {
        //comunicazione del fallimento della connessione
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    //query sql per ricercare la stazione inserita dall'utente nel database
    $sql = "SELECT * FROM stazione";

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

    //costruzione della tabella in cui si inseriranno tutte le stazioni presenti nel database
    $table = "<tr><th>Stazione</th><th>Numero di slot</th><th>Numero civico</th><th>Via</th><th>Città</th><th>Latitudine</th><th>Longitudine</th></tr>";

    //scorrimento delle stazioni presenti nel database
    while ($row = $result->fetch_assoc())
        //completamento tabella con tutte le stazioni
        $table .= "<tr><td>$row[nome]</td><td>$row[numeroSlot]</td><td> $row[civico]</td><td> $row[via]</td><td> $row[paese]</td><td> $row[latitudine]</td><td> $row[longitudine]</td><td><button onclick='modifica($row[ID], \"$row[nome]\")'>Modifica</button></td><td><button onclick='elimina($row[ID])'>Elimina</button></td></tr>";

    //invio della tabella
    $arr = array("status" => "ok", "message" => $table);
    //conversione dell'array in formato json e return a js
    echo json_encode($arr);

    //gestione eccezioni
} catch (Exception $e) {
    //login non andato a buon fine
    $arr = array("status" => "no", "message" => $e->getMessage());
    //return a js
    echo json_encode($arr);
}
