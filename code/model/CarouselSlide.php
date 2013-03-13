<?php

class CarouselSlide extends DataObject {
    
    public static $db = array(
        'Title'     => 'Varchar(99)',
        'Sort'      => 'Int'
    );
    
    public static $has_one = array(
        'Parent'    => 'Page',
        'Image'     => 'Image'
    );
    
    public static $casting = array(
	    'Thumbnail'	=> 'Varchar'
    );
    
    public static $summary_fields = array(
		'Thumbnail'	=> 'Image',
		'Title'		=> 'Title'
    );
    
    public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName('ParentID');
		
		return $fields;
	}
    
    public function getThumbnail() {
        if($this->Image())
            return $this->Image()->CMSThumbnail();
        else
            return '(No Image)';
    }
}
