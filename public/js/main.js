var mymap = L.map('mapid').setView([43.5818619, 7.1283061], 17);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoicmVtcmVtNTMiLCJhIjoiY2tpdmJ5N2x5MGk0MTJ6bWV1bXpyamZ6OSJ9.7AO4TE_70Zof2CSwLBTRzA'
}).addTo(mymap);

var marker = L.marker([43.5818619, 7.1283061])
    .addTo(mymap)
    .bindPopup('<h4>RMTJ, c\'est ici! </h4>6 rue du Revely, ANTIBES<br/>tous les jours 18h-22h')
    .openPopup();