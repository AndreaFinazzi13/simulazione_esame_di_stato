//verifica che la pagina sia stata caricata
document.addEventListener('DOMContentLoaded', function() {
    //coordinate di Brescia (città d'esempio per la simulazione)
    let longitudine = 10.2118;
    let latitudine = 45.5416;

    //inizializzazione mappa
    let mappa = L.map('mappaBrescia').setView([latitudine, longitudine], 13);

    //creazione del tile layer (immagine della mappa) che deve essere inserita nell'aposito div
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mappa);    //aggiunta dell'immagine alla mappa

    //inserimento delle coordinate di Brescia nella mappa
    L.marker([latitudine, longitudine]).addTo(mappa)
        .bindPopup('<b>Brescia</b>')
        .openPopup();
});
