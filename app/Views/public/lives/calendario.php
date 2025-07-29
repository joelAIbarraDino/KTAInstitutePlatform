<?php 
    $topScripts = '
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    '; 
?>
<?php include_once __DIR__.'/../../components/header.php'; ?>

<main>
    <section class="cursos-banner" data-aos="fade">
        <div class="cursos-banner__container">
            <h2 data-aos="fade-up" class="cursos-banner__titulo" data-section="calendar" data-label="title">Calendario de cursos en vivo</h2>
            <!-- <p class="cursos-banner__desc" id="main-content" data-section="courses" data-label="label">Empieza, cambia o avanza en tu carrera con KTA como guía.</p> -->
        </div>
    </section>
    <div class="calendar-conteiner">
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