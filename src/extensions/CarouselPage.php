<?php

namespace ilateral\SilverStripe\Carousel\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use ilateral\SilverStripe\Carousel\Model\CarouselSlide;

/**
 * Extension to all page objects that add carousel slide relationships
 * 
 * @author i-lateral (http://www.i-lateral.com)
 * @package carousel
 */
class CarouselPage extends DataExtension
{
    
    /**
     * DB Columns
     * 
     * @var array
     * @config
     */
    private static $db = [
        'ShowCarousel'  => 'Boolean',
        "CarouselShowIndicators" => "Boolean",
        "CarouselShowControls" => "Boolean",
        'CarouselWidth' => 'Int',
        'CarouselHeight'=> 'Int',
        "CarouselInterval" => "Int"
    ];

    /**
     * Has Many relations
     * 
     * @var array
     * @config
     */
    private static $has_many = [
        'Slides' => CarouselSlide::class
    ];

    /**
     * Default variables
     * 
     * @var array
     * @config
     */
    private static $defaults = [
        'CarouselWidth' => 750,
        'CarouselHeight' => 350,
        'CarouselInterval' => 3000,
    ];

    public function updateCMSFields(FieldList $fields)
    {
        if($this->owner->ShowCarousel) {
            $carousel_table = GridField::create(
                'Slides',
                false,
                $this->owner->Slides(),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(new GridFieldOrderableRows('Sort'))
            );

            $fields->addFieldToTab('Root.Carousel', $carousel_table);
        } else {
            $fields->removeByName('Slides');
        }

        $fields->removeByName('ShowCarousel');
        $fields->removeByName('CarouselWidth');
        $fields->removeByName('CarouselHeight');

        parent::updateCMSFields($fields);
    }

    public function updateSettingsFields(FieldList $fields)
    {
        $message = '<p>Configure this page to use a carousel</p>';
        
        $fields->addFieldToTab(
            'Root.Settings',
            LiteralField::create("CarouselMessage", $message)
        );

        $carousel = FieldGroup::create(
            CheckboxField::create(
                'ShowCarousel',
                'Show a carousel on this page?'
            ),
            CheckboxField::create(
                'CarouselShowIndicators',
                $this->owner->fieldLabel('CarouselShowIndicators')
            ),
            CheckboxField::create(
                'CarouselShowControls',
                $this->owner->fieldLabel('CarouselShowControls')
            )
        )->setTitle('Carousel');

        $fields->addFieldToTab(
            'Root.Settings',
            $carousel
        );

        if($this->owner->ShowCarousel) {
            $fields->addFieldsToTab(
                'Root.Settings',
                [
                    NumericField::create(
                        'CarouselWidth',
                        $this->owner->fieldLabel('CarouselWidth')
                    ),
                    NumericField::create(
                        'CarouselHeight',
                        $this->owner->fieldLabel('CarouselHeight')
                    ),
                    NumericField::create(
                        'CarouselInterval',
                        $this->owner->fieldLabel('CarouselInterval')
                    )
                ]
            );
        }
    }

    public function CarouselSlides() {
        return $this
            ->owner
            ->renderWith(
                'ilateral\SilverStripe\Carousel\Includes\CarouselSlides',
                [
                    'Slides' => $this->owner->Slides(),
                    'Interval' => $this->owner->CarouselInterval ? $this->owner->CarouselInterval : 3000,
                    'ShowIndicators' => $this->owner->CarouselShowIndicators,
                    'ShowControls' => $this->owner->CarouselShowControls
                ]
            );
    }
}
