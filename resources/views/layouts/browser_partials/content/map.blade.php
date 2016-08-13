<section id="mymap" name="map">
    
    <div id="map"></div>
    
    <script>
        var mymap = L.map('mymap').setView([51.505, -0.09], 6);
        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink,
                    maxZoom: 18,
                }).addTo(mymap);
        L.marker([51.5, -0.09]).addTo(mymap);
                
                
    </script>
</section>