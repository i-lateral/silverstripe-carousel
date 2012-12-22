<?php

class CarouselPage extends DataExtension {
    public static $db = array(
        'ShowCarousel'  => 'Boolean'
    );
    
    public static $has_many = array(
        'Slides' => 'CarouselSlide'
    );
    
    public function updateCMSFields(FieldList $fields) {
		
		if($this->owner->ShowCarousel) {
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
		} else {
		    $fields->removeByName('Slides');
		}
		
		$fields->removeByName('ShowCarousel');
        
        parent::updateCMSFields($fields);
    }
    
    public function updateSettingsFields(FieldList $fields) {
	    $carousel = FieldGroup::create(
	        CheckboxField::create('ShowCarousel', 'Show a carousel on this page?')
		)->setTitle('Carousel');
		
	    $fields->addFieldToTab('Root.Settings', $carousel);
    }
    
    public function CarouselSlides() {
        $filter = "ParentID = {$this->owner->ID}";
        $sort = 'Sort ASC';
        
        $slides = CarouselSlide::get($filter, $sort);
        
        return $this->owner->renderWith('CarouselSlides', array('Slides' => $slides));
    }
}
