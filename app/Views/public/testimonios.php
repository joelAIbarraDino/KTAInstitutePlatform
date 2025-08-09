<?php include_once __DIR__.'/../components/header.php'; ?>

<main class="review-page">

    <p data-aos="fade-up" data-aos-delay="100" class="maestros-index__subtitulo">Testimonios</p>
    <hr data-aos="fade-up" class="linea-personalizada">

    <div class="review-page__container" data-aos="fade-down">
        <?php foreach($reviews as $review):?>
            <div class="review">
                <div class="review__header">
                    <img class="review__photo" src="<?=$review->photo?>" alt="<?=$review->photo?>">
                    
                    <div class="review__name-container">
                        <div class="review__name"><?=$review->author_name?></div>
                        <div class="review__time"><?=$review->relative_time?></div>
                    </div>
                </div>

                <div class="review__rating">
                    <?php for($i = 0; $i< $review->rating; $i++):?>
                        <i class='bx bxs-star'></i>
                    <?php endfor;?>
                </div>

                <div class="review__text">
                    <?= $review->review?>
                </div>
                
                <a class="review__link" href="<?=$review->google_url?>" target="_blank" data-section="index" data-label="google_more">Ver review en Google</a>
            </div>
        <?php endforeach;?>
    </div>

</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 

    $menuVersion = filemtime('assets/js/menu.js');

    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>