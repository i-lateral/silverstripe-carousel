Silverstripe Carousel Module
============================

Carousel module for the Silverstripe CMS.

## Author
This module was created by [i-lateral](http://www.i-lateral.com).

Although this module can be extended with your own templates / JavaScript,
the default makes use of [jQuery UI](http://www.jqueryui.com) and the 
[jquery UI rotate plugin](https://github.com/cmcculloh/jQuery-UI-Tabs-Rotate).

## Installation
Install this module either by downloading and adding to:

[silverstripe-root]/carousel

Then run: http://yoursiteurl.com/dev/build/

Or alternativly add to your projects composer.json

## Usage
Once installed, you must add the template variable $CarouselSlides to any
templates you require a carousel to appear on.

Then, you can setup a carousel by logging into the admin interface and editing
the page you want to add a carousel to.

Then click the "Settings" tab, and tick the "add carousel" checkbox.

Once this is done (and you have saved) you will see a width and height overwrite
appear (allowing you to change the size of your carousel).

Once you have finished configuring, you can go back to editing you page, and a
"carousel" tab should have appeared in the right hand site of the editing pane.
