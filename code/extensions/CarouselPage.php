<?php

class CarouselPage extends DataExtension {
    public static $has_many = array(
        'Slides' => 'CarouselSlide'
    );
    
    public function updateCMSFields(FieldList $fields) {
		
		// Add calc options
        $grid_config = GridFieldConfig::create();
        $grid_config->addComponents(
            new GridFieldAddnewButton(),
            new GridFieldDeleteAction(),
            new GridFieldDataColumns(),
            new GridFieldDetailForm(),
            new GridFieldEditButton(),
            new GridFieldSortableHeader()
        );
        
        $carousel_table = GridField::create('Slides', null, $this->owner->Slides()->sort('Sort DESC'), $grid_config);
		
		$fields->addFieldToTab('Root.Carousel', $carousel_table);
        
        parent::updateCMSFields($fields);
    }
    
    public function CarouselSlides() {
        $filter = "ParentID = {$this->owner->ID}";
        $sort = 'Sort ASC';
        
        $slides = CarouselSlide::get($filter, $sort);
        
        return $this->owner->renderWith('CarouselSlides', array('Slides' => $slides));
    }
}
