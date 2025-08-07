<?php if(!is_null($bannerAsesoria)):?>
    <section class="curso-banner-asesoria">
        <p class="curso-banner-asesoria__texto" data-section="bannerAsesoria-<?=$bannerAsesoria->id_banner_asesoria?>" data-label="text_banner"><?=$bannerAsesoria->text_banner?></p>

        <?php if(isset($bannerAsesoria->CTA)):?>
            <a href="<?=$bannerAsesoria->link?>">
                <div class="curso-banner-asesoria__button" data-section="bannerAsesoria-<?=$bannerAsesoria->id_banner_asesoria?>" data-label="CTA"><?=$bannerAsesoria->CTA?></div>
            </a>
        <?php endif;?>
    </section>
<?php endif;?>
