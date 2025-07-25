<?php 
    $topScripts = '
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    '; 
?>
<?php include_once __DIR__.'/../../components/header.php'; ?>

<main>
    <div class="calendar-conteiner">
        <h2  data-aos="fade-down" class="calendar-title">Calendario de cursos en vivo KTA</h2>
        <div data-aos="fade-up" id="calendar" class="calendar-desktop"></div>
        <div id="event-list" class="calendar-mobile hidden"></div>
    </div>

</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $calendarVersion = filemtime('assets/js/calendarLives.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
        <script src="/assets/js/calendarLives.js?v='.$calendarVersion.'"></script>
    ';
?>