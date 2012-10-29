<?php

class CarouselPage extends DataObjectDecorator {
    public static $extra_statics = array(
        'db' => array(
            'Slides' => 'CarouselSlide'
        )
    );
    
    public function updateCMSFields(FieldSet $fields) {
		
		$GalleryTable = new ComplexTableField(
			$this->owner,
			'Slides',
			'CarouselSlide',
			null
		);
		
		$fields->addFieldToTab('Root.Content.Carousel', $GalleryTable);
        
        parent::updateCMSFields($fields);
    }
    
    public function CarouselSlides() {
        $filter = "ParentID = {$this->owner->ID}";
        $sort = 'Sort ASC';
        
        $slides = DataObject::get('CarouselSlide', $filter, $sort);
        
        return $this->owner->renderWith('CarouselSlides', array('Slides' => $slides));
    }
}
