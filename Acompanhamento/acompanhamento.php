<?php include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acompanhamento de Pedido</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="/Acompanhamento/css/style.css">

</head>
<body>


<div class="page-header">
  <h1>Acompanhamento de Pedido</h1>
  <p>Aqui você pode acompanhar seu pedido.</p>

  
  <div class="status pending">Status: Pendente</div>
</div>

<div id="map"></div>

<div id="deliveryConfirmation" style="display: none;">
  <a href="/agradecimento/agradecimento.php">
    <button onclick="confirmDelivery()">Confirmar Entrega</button>
  </a>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  function startTracking() {
    
    const initialLocation = { lat: -23.5505, lng: -46.6333 };
    const storeLocation = { lat: -23.5505, lng: -46.6333 }; 
    const customerLocation = { lat: -23.5605, lng: -46.6433 }; 

    
    const map = L.map('map').setView([initialLocation.lat, initialLocation.lng], 15);

   
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    
    const marker = L.marker([initialLocation.lat, initialLocation.lng], { icon: createCustomIcon('pedido') }).addTo(map);

    
    const storeMarker = L.marker([storeLocation.lat, storeLocation.lng], { icon: createCustomIcon('loja') }).addTo(map);

    
    const customerMarker = L.marker([customerLocation.lat, customerLocation.lng], { icon: createCustomIcon('cliente') }).addTo(map);

    
    function updateMarkerLocation(lat, lng) {
      marker.setLatLng([lat, lng]).update();
      map.setView([lat, lng], map.getZoom());
    }

   
    function animateOrder() {
      let percent = 0;
      const duration = 5000; 
      const interval = 50; 

      const latDiff = customerLocation.lat - storeLocation.lat;
      const lngDiff = customerLocation.lng - storeLocation.lng;

      const moveStep = interval / duration;

      const moveInterval = setInterval(function () {
        percent += moveStep;

        const currentLat = storeLocation.lat + percent * latDiff;
        const currentLng = storeLocation.lng + percent * lngDiff;

        updateMarkerLocation(currentLat, currentLng);

        if (percent >= 1) {
          clearInterval(moveInterval);
          
          document.querySelector('.status').textContent = 'Status: Entregue';
          document.querySelector('.status').className = 'status delivered';

        
          document.getElementById('deliveryConfirmation').style.display = 'block';
        }
      }, interval);
    }

   
    function createCustomIcon(type) {
      const iconUrl = `/Acompanhamento/img/${type}-icon.png`;

      return L.icon({
        iconUrl,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });
    }

    
    setTimeout(function () {
   
      updateMarkerLocation(storeLocation.lat, storeLocation.lng);
      document.querySelector('.status').textContent = 'Status: Em trânsito';
      document.querySelector('.status').className = 'status shipped';


      animateOrder();
    }, 10000); 
  }

  function confirmDelivery() {
    alert('Entrega confirmada!'); 
  
    startTracking();
   
    document.getElementById('deliveryConfirmation').style.display = 'none';
    event.preventDefault();
  
  }


  startTracking();
</script>

</body>
</html>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';

    ?>