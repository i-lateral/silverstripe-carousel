<?php

class CarouselSlide extends DataObject {

    private static $db = array(
        'Title'     => 'Varchar(99)',
        'Sort'      => 'Int'
    );

    private static $has_one = array(
        'Parent'    => 'Page',
        'Image'     => 'Image'
    );

    private static $casting = array(
        'Thumbnail' => 'Varchar'
    );

    private static $summary_fields = array(
        'Thumbnail' => 'Image',
        'Title'     => 'Title'
    );

    private static $default_sort = "Sort ASC";

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
