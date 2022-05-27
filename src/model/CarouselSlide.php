<?php

namespace ilateral\SilverStripe\Carousel\Model;

use SilverStripe\Assets\Image;
use gorriecoe\Link\Models\Link;
use SilverStripe\ORM\DataObject;
use gorriecoe\LinkField\LinkField;
use SilverStripe\CMS\Model\SiteTree;

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
        'Parent'    => SiteTree::class,
        'Image'     => Image::class,
        'Link'		=> Link::class
    ];

    /**
     * Ownership of relations
     *
     * @var array
     */
    private static $owns = [
        'Image',
        'Link'
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
        'Title'     => 'Title',
        'Link.Title'=> 'Title'
    );

    /**
     * Default sorting of this object
     * 
     * @var string
     * @config
     */
    private static $default_sort = "Sort ASC";

    /**
     * Default image profile to use
     *
     * @var string
     * @config
     */
    private static $default_proile = 'ShortCarousel';
    
    /**
     * Get fully rendered image for template
     *
     * @return HTMLText
     */
    public function getRenderedImage()
    {
        $parent = $this->Parent(); 
        $profile = $parent->CarouselProfile;
        if ($profile) {
            return $this->Image->{$profile}();
        } else {
            $profile = $this->config()->default_proile;
        }

        return $this->Image->{$profile}();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['ParentID', 'Sort']);

		$fields->addFieldToTab(
			'Root.Main', 
			LinkField::create(
                'LinkID',
                $this->fieldLabel('Link')
            )
		);

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
