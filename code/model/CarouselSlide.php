<?php

class CarouselSlide extends DataObject {
    
    public static $db = array(
        'Title'     => 'Varchar',
        'Content'   => 'Text',
        'Sort'      => 'Int'
    );
    
    public static $has_one = array(
        'Parent'    => 'Page',
        'Image'     => 'Image'
    );
    
}
