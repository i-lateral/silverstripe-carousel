<?php

class CarouselContentController extends Extension {
    public function onBeforeInit() {    
        // Load required CSS
        Requirements::css('carousel/css/carousel.css');
    
        // Load required javascript 
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery.ui.js');
        Requirements::javascript('carousel/javascript/carousel.js');
    }
}
