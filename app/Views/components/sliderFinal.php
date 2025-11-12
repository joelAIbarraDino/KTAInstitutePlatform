<section class="hero-layout1">
    <div class="vs-carousel" data-fade="true" data-arrows="true" data-dots="true">
        
        <?php foreach($sliders as $slider):?>
            <div>
                <div class="hero-inner">
                    
                    <?php if($slider->type_background=="picture"):?>
                        <div class="hero-bg" data-bg-src="/assets/slidebar/<?=$slider->background?>"></div>
                    <?php else:?>
                        <iframe
                            src="https://player.vimeo.com/video/<?=$slider->id_video?>?background=1&autoplay=1&loop=1&byline=0&title=0&muted=1"
                            frameborder="0"
                            allow="autoplay; fullscreen"
                            allowfullscreen
                            class="slider__video"
                            id="bg-video"
                        ></iframe>
                    <?php endif;?>
                    
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title animated" data-section="slidebar-<?=$slider->id_slidebar?>" data-label="title"><?=$slider->title?></h1>
                            <p class="hero-text animated" data-section="slidebar-<?=$slider->id_slidebar?>" data-label="subtitle"><?=$slider->subtitle?></p>
                            
                            <?php if($slider->link && $slider->CTA):?>
                                <div class="hero-btns animated">
                                    <a href="<?=$slider->link?>" class="vs-btn style5"><i class="far fa-angle-right"></i> <span data-section="slidebar-<?=$slider->id_slidebar?>" data-label="CTA"><?=$slider->CTA?></span></a>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</section>

<div style="width:100%; height:8rem">
    <?php if(is_null($gif)):?>
        <img src="/assets/images/gif.gif" alt="gif" >
    <?php else:?>
        <img src="/assets/gifs/<?=$gif->file_url?>" alt="gif" style="width:100%; height:100%"> 
    <?php endif;?>
</div>