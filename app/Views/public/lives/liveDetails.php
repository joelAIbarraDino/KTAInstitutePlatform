<?php 

    include_once __DIR__.'/../../components/header.php';
    
    use App\Classes\Helpers;
    $fechas =  Helpers::formatearFechasHoras($live->dates_times);    
?>

<main>

    <div class="info-curso">
        <img class="info-curso__background" src="/assets/background/lives/<?=$live->background?>" alt="<?=$live->background?>">

        <div class="info-curso__cover">
            <a class="info-curso__return" href="javascript:history.back()" data-section="course-details" data-label="return"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
            
            <div class="info-curso__type" data-section="live-details" data-label="type-content">
                <i class='bx bxl-zoom' ></i> <span>Contenido en vivo</span>
            </div>
            
            <h1 class="info-curso__name" data-section="live-<?=$live->id_live?>" data-label="name"><?=$live->name?></h1>
            <p class="info-curso__lema" data-section="live-details" data-label="lema"><strong>Este es un curso en vivo que se dará el:</strong></p>

            <div class="info-curso__details">

                <?php if($live->enrollment >2): ?>
                    <div class="info-curso__detail">
                        <i class='bx bxs-graduation'></i> <?=$live->enrollment?> <span data-section="course-details" data-label="students">estudiantes</span>
                    </div>
                <?php endif;?>
                
                <div class="info-curso__detail">
                    <i class='bx bx-calendar'></i> <span><?=$fechas['fechas']?></span>
                </div>

                <div class="info-curso__detail">
                    <i class='bx bx-time-five'></i><span><?=$fechas['horas']?></span>
                </div>

            </div>

            <div class="info-curso__description" data-section="live-<?=$live->id_live?>" data-label="description">
                <?=$live->description ?>
            </div>

            <div class="info-curso__price-container">
                <?php if($live->discount && date('Y-m-d') <= $live->discount_ends_date &&  date('H:i:s') <= $live->discount_ends_time): ?>
                        <p class="info-curso__price info-curso__price--original">$ <?=$live->price?> USD</p>
                        <p class="info-curso__price info-curso__price--oferta">$ <?= $live->price * (1 - ($live->discount/100))?> USD</p>
                <?php else: ?>
                        <p class="info-curso__price info-curso__price--normal">$ <?=$live->price?> USD</p>
                <?php endif;?>
            </div>

            <a href="/checkout/live/<?=$live->url?>" class="info-curso__button" data-section="course-details" data-label="checkout">Comprar ahora</a>

        </div>
    </div>

    <div class="detalles-curso">
        <div class="detalles-curso__top">
            <div class="detalles-curso__tabs">
                <button data-step="1" class="btn_tab detalles-curso__tab detalles-curso__tab--active" data-section="course-details" data-label="tab-details">Detalles</button>
            </div>
        </div>

        <div class="detalles-cursos__tab-cont">
            
            <div id="step-1" class="detalles-curso__content detalles-curso__content--active">
                <?php if($live->details):?>
                    <div class="width-70" data-section="live-<?=$live->id_live?>" data-label="details">
                        <?=$live->details?>
                    </div>
                <?php else:?>
                    <p class="acordeon__vacio">No hay detalles agregados</p>
                <?php endif;?>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__.'/../../components/footer.php';?>

<?php 

    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
        <script src="/assets/js/tabs.js"></script>
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>