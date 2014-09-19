<?php

/**
 * Representation of a slide object that can be extended to add extra
 * data (such as links, additional content, etc)
 * 
 * @author i-lateral (http://www.i-lateral.com)
 * @package carousel
 */
class CarouselSlide extends DataObject {

    /**
     * DB Columns
     * 
     * @var array
     * @config
     */
    static $db = array(
        'Title'     => 'Varchar(99)',
        'Sort'      => 'Int'
    );

    /**
     * Has One relations
     * 
     * @var array
     * @config
     */
    static $has_one = array(
        'Parent'    => 'Page',
        'Image'     => 'Image'
    );

    /**
     * Default casting for functions to templates
     * 
     * @var array
     * @config
     */
    static $casting = array(
        'Thumbnail' => 'Varchar'
    );

    /**
     * Summary columns/fields for this object
     * 
     * @var array
     * @config
     */
    static $summary_fields = array(
        'Thumbnail' => 'Image',
        'Title'     => 'Title'
    );

    /**
     * Default sorting of this object
     * 
     * @var string
     * @config
     */
    static $default_sort = "Sort ASC";
    

    public function getSizedImage() {
        $width = $this->Parent()->CarouselWidth;
        $height = $this->Parent()->CarouselHeight;

        if($width && $height)
            return $this->Image()->croppedImage($width, $height);
        else
            return false;
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('ParentID');
        $fields->removeByName('Sort');

        return $fields;
    }

    public function getThumbnail() {
        if($this->Image())
            return $this->Image()->CMSThumbnail();
        else
            return '(No Image)';
    }
}
