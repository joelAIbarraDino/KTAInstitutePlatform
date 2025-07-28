<?php 

    $topScripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    ';
?>

<?php include_once __DIR__.'/../components/header.php'; ?>

<main class="membresia-page">

    <section class="membresia-page__top" data-aos="fade">
        <div class="membresia-page__top-left" data-aos="fade-right">
            <h2 class="membresia-page__top-title" data-section="memberships" data-label="title">Membresías KTA</h2>
            <p class="membresia-page__top-text" data-section="memberships" data-label="description">
                Acceso VIP durante 12 meses a todas las formaciones, cursos y educación continua. Más de 1000 horas de formación especializada.
            </p>

            <a href="#membresia-page__membresias" class="membresia-page__top-link">
                <div class="membresia-page__top-CTA" data-section="memberships" data-label="CTA">¡Consigue tu Membresía ahora!</div>
            </a>

        </div>

        <div>
            <img data-aos="fade-left" class="membresia__top-image" src="/assets/images/membresia-top.jpg" alt="" srcset="foto membresia">
        </div>
        
    </section>

    <section id="membresia-page__membresias" class="membresia-page__membresias" data-aos="fade">
        <h2 class="membresia-page__membresias-title" data-section="memberships" data-label="title_memberships" data-aos="fade-up">Nuestras membresías KTA</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($membresias as $membresia): ?>
                    <div class="swiper-slide">
                        <div class="membresia-page__membresias-card">
                            <div class="membresia-page__membresias-card-container">
                                <img class="membresia-page__membresias-card-image" src="/assets/membresias/<?=$membresia->photo?>" alt="" data-aos="fade-right">
                                <div class="membresia-page__membresias-card-text-container">
                                    <h3 class="membresia-page__membresias-card-title" data-section="membership-<?=$membresia->id_membership?>" data-label="type" data-aos="fade-left"><?=$membresia->type?></h3>
                                    <div class="membresia-page__membresias-card-desc" data-section="membership-<?=$membresia->id_membership?>" data-label="caract" data-aos="fade-left"><?=$membresia->caract?></div>
                                </div>
                            </div>
                            
                            <!-- <div class="membresia-page__membresias-card-courses">
                                <div class="membresia-page__membresias-card-courses-title">
                                    <p data-section="memberships" data-label="title_courses" >Cursos exclusivos con </p> <p data-section="membership-<?=$membresia->id_membership?>" data-label="type"><?=$membresia->type?></p> 
                                </div>
                            </div>
                             -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        
    </section>

</main>

<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay:{
            delay:4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        }
    });
</script>


<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 

    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>