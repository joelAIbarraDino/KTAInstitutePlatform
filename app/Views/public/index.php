<?php include_once __DIR__.'/../components/header.php'; ?>

<?php include_once __DIR__.'/../components/slider.php'; ?>

<div class="gif">
    <img src="/assets/images/gif.gif" alt="gif" class="gif__image">
</div>

<div id="purchase-popup" class="popup hidden">
  <span id="popup-text"></span>
</div>

<a class="whatsapp" target="_blank" href="https://api.whatsapp.com/send/?phone=17866124893&text=Hola%20KTA,%20tengo%20una%20duda%20y%20necesito%20ayuda">
    <p class="whatsapp__tooltip">WhatsApp</p>
    <div class="whatsapp__icon">
        <i class='bx bxl-whatsapp'></i>
    </div>
</a>

<?php 

    $sliderVersion = filemtime('assets/js/slider.js');
    $saleVersion = filemtime('assets/js/saleAlerts.js');

    $scripts ='
        <script src="/assets/js/menu.js"></script>
        <script src="/assets/js/slider.js?v='.$sliderVersion.'"></script>
        <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
    ';
?>

