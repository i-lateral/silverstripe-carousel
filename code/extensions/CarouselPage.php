<?php

class CarouselPage extends DataExtension {
    public static $db = array(
        'ShowCarousel'  => 'Boolean',
        'CarouselWidth' => 'Int',
        'CarouselHeight'=> 'Int'
    );

    public static $has_many = array(
        'Slides' => 'CarouselSlide'
    );

    public static $defaults = array(
        'CarouselWidth' => 750,
        'CarouselHeight' => 350
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
        $fields->removeByName('CarouselWidth');
        $fields->removeByName('CarouselHeight');

        parent::updateCMSFields($fields);
    }

    public function updateSettingsFields(FieldList $fields) {
        $message = '<p>Configure this page to use a carousel</p>';
        $fields->addFieldToTab('Root.Settings', LiteralField::create("CarouselMessage", $message));

        $carousel = FieldGroup::create(
            CheckboxField::create('ShowCarousel', 'Show a carousel on this page?')
        )->setTitle('Carousel');

        $fields->addFieldToTab('Root.Settings', $carousel);

        if($this->owner->ShowCarousel) {
            $fields->addFieldToTab('Root.Settings', NumericField::create('CarouselWidth', 'Width'));
            $fields->addFieldToTab('Root.Settings', NumericField::create('CarouselHeight', 'Height'));
        }
    }

    public function CarouselSlides() {
        // Load CSS to size the carousel
         Requirements::customCSS(
<<<CSS
    .carousel-container {
        width: {$this->owner->CarouselWidth}px;
        height: {$this->owner->CarouselHeight}px;
    }
CSS
        );

        return $this->owner->renderWith('CarouselSlides', array('Slides' => $this->owner->Slides()));
    }
}
