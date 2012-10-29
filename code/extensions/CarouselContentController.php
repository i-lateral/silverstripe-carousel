<?php

class CarouselContentController extends Extension {
    public function onBeforeInit() {
        // Disable HASH rewriting
        SSViewer::dontRewriteHashlinks();
    
        // Load required CSS
        Requirements::css('carousel/css/carousel.css');
    
        // Load required javascript 
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery-packed.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery.ui.core.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery.ui.widget.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-ui/jquery.ui.tabs.js');
        Requirements::javascript('carousel/javascript/carousel.js');
    }
}
