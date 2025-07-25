<?php include_once __DIR__.'/../components/header.php'; ?>

<main class="cursos-principal">
    <section class="membresias">
        <?php foreach ($membresias as $membresia): ?>
            <article class="membresia-card">
                <h3 class="membresia-card__titulo"><?= ucfirst($membresia->type); ?></h3>
                
                <div class="membresia-card__logo-container">
                    <img class="membresia-card__logo" src="/assets/membresias/<?=$membresia->photo?>" alt="logo membresia">
                </div>
                <div class="membresia-card__info">
                    <p class="membresia-card__precio">$<?=number_format($membresia->price, 2); ?> USD</p>
                    <p class="membresia-card__duracion">Acceso por <?= $membresia->max_time_membership; ?> meses</p>
                </div>
                <div data-section="membership-<?=$membresia->id_membership?>" data-label="caract"><?=$membresia->caract; ?></div>
                
                <div class="membresia-card__btn-container">
                    <a class="membresia-card__btn" href="/checkout/membership/<?=$membresia->id_membership?>" data-section="course-details" data-label="checkout">Comprar ahora</a>
                </div>
                
            </article>
        <?php endforeach; ?>
    </section>

</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 

    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>