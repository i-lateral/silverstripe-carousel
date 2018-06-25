<?php

namespace ilateral\SilverStripe\Carousel\Model;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Assets\Image;
use Sheadawson\Linkable\Models\Link;
use Page;


/**
 * Representation of a slide object that can be extended to add extra
 * data (such as links, additional content, etc)
 * 
 * @author i-lateral (http://www.i-lateral.com)
 * @package carousel
 */
class CarouselSlide extends DataObject
{

    private static $table_name = 'CarouselSlide';

    /**
     * DB Columns
     * 
     * @var array
     * @config
     */
    private static $db = [
        'Title'     => 'Varchar(99)',
        'Sort'      => 'Int'
    ];

    /**
     * Has One relations
     * 
     * @var array
     * @config
     */
    private static $has_one = [
        'Parent'    => Page::class,
        'Image'     => Image::class,
        //'Link'		=> Link::class
    ];

    /**
     * Ownership of relations
     *
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    /**
     * Default casting for functions to templates
     * 
     * @var array
     * @config
     */
    private static $casting = array(
        'Thumbnail' => 'Varchar'
    );

    /**
     * Summary columns/fields for this object
     * 
     * @var array
     * @config
     */
    private static $summary_fields = array(
        'Thumbnail' => 'Image',
        'Title'     => 'Title'
    );

    /**
     * Default sorting of this object
     * 
     * @var string
     * @config
     */
    private static $default_sort = "Sort ASC";
    

    public function getSizedImage()
    {
        $parent = $this->Parent(); 
        $width = $parent->CarouselWidth;
        $height = $parent->CarouselHeight;
        
        if($width && $height) {
            return $this->Image()->FocusFill($width, $height);
        } else {
            return false;
        }
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ParentID');
        $fields->removeByName('Sort');
		/*$fields->addFieldToTab(
			'Root.Main', 
			LinkField::create('LinkID', 'Link to page or file')
		);*/

        return $fields;
    }

    public function getThumbnail()
    {
        if($this->Image()) {
            return $this->Image()->CMSThumbnail();
        } else {
            return '(No Image)';
        }
    }
    
    /**
     * Check parent permissions
     *
     * @return Boolean
     */
    public function canView($member = null) {
        $extended = $this->extend('canView', $member);
        if($extended && $extended !== null) return $extended;

        return $this->Parent()->canView($member);
    }

    /**
     * Anyone can create a carousel slide
     *
     * @return Boolean
     */
    public function canCreate($member = null, $context = []) {
        $extended = $this->extend('canCreate', $member, $context);
        if($extended && $extended !== null) return $extended;

        return true;
    }

    /**
     * Check parent permissions
     *
     * @return Boolean
     */
    public function canEdit($member = null) {
        $extended = $this->extend('canEdit', $member);
        if($extended && $extended !== null) return $extended;

        return $this->Parent()->canEdit($member);
    }

    /**
     * Check parent permissions
     *
     * @return Boolean
     */
    public function canDelete($member = null) {
        $extended = $this->extend('canDelete', $member);
        if($extended && $extended !== null) return $extended;

        return $this->Parent()->canEdit($member);
    }
}
