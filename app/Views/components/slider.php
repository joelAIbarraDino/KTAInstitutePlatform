<section class="slider-container">

    <?php if($sliders):?>
        <?php foreach($sliders as $key=>$slider):?>
            
            <div class="slider slider <?= $key==0?'active':''?>">
                <?php if($slider->type_background=="picture"):?>
                    <img src="/assets/slidebar/<?=$slider->background?>" alt="imagen de fondo" class="slider__background">
                <?php else:?>
                    <video autoplay muted loop playsinline class="slider__video">
                        <source src="/assets/videos/placeholder2.mp4" type="video/mp4" />
                    </video>
                <?php endif;?>
                
                <div class="slider__cover">
                    <div class="slider__text-container">
                        <h1 class="slider__text-title" style="color:<?=$slider->color_title?>; font-family:<?=$slider->font_title?>"><?=$slider->title?></h1>
                        <p class="slider__text-description" style="color:<?=$slider->color_subtitle?>; font-family:<?=$slider->font_subtitle?>"><?=$slider->subtitle?></p>
                    </div>
                    <?php if($slider->link && $slider->CTA):?>
                        <a class="slider__link" href="<?=$slider->link?>"><?=$slider->CTA?></a>
                    <?php endif;?>
                </div>
            </div>
        <?php endforeach;?>
    <?php else:?>
        <div class="slider slider active">
            <video autoplay muted loop playsinline class="slider__video">
                <source src="/assets/videos/placeholder2.mp4" type="video/mp4" />
            </video>
            
            <div class="slider__cover">
                <div class="slider__text-container">
                    <h1 class="slider__text-title" style="color:#fff;">SI QUIERES CRECER EN TU CARRERA COMO PREPARADOR DE IMPUESTOS, EN LABITAX PODEMOS AYUDARTE.</h1>
                    <p class="slider__text-description" style="color:#fff;">Llevamos más de 30 años formando en español a los mejores profesionales del país.</p>
                </div>
            </div>
        </div>
    
    <?php endif;?>
    
</section>
