<section id="map" name="map">
    
    <div id="mapid"></div>
    <script>
        var mymap = L.map('mapid').setView({{$map}}, 6);
        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink,
                    maxZoom: 18,
                }).addTo(mymap);
        L.marker({{$map}}).addTo(mymap);
                
                
    </script>
</section>