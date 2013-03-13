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
            // Create add button
            $add_button = new GridFieldAddNewButton('toolbar-header-left');
            $add_button->setButtonName('Add Slide');
			
		    // Add carousel editor
            $grid_config = GridFieldConfig_RecordEditor::create()
				->removeComponentsByType('GridFieldAddNewButton')
				->removeComponentsByType('GridFieldFilterHeader')
				->addComponent($add_button);
            
            $carousel_table = GridField::create('Slides', false, $this->owner->Slides()->sort('Sort DESC'), $grid_config);
		
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
        return $this->owner->renderWith('CarouselSlides', array('Slides' => $this->owner->Slides()));
    }
}
