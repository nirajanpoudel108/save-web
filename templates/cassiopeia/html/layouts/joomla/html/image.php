<?php
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Utilities\ArrayHelper;


// Clean the image URL
$img = HTMLHelper::_('cleanImageURL', $displayData['src']);
$displayData['src'] = $this->escape($img->url);

// Handle alt text
if (isset($displayData['alt']))
{
    if ($displayData['alt'] === false)
    {
        unset($displayData['alt']);
    }
    else
    {
        $displayData['alt'] = $this->escape($displayData['alt']);
    }
}

// Determine if this image belongs to the special category
$fixedCategoryId = [9, 10]; // categories you want to target
$applyFixedSize = false;

if (isset($displayData['catid'])) {
    if (is_array($displayData['catid'])) {
        // MULTIPLE CATEGORIES COMING FROM DATA
        $applyFixedSize = !empty(array_intersect($displayData['catid'], $fixedCategoryId));
    } else {
        // SINGLE CATEGORY COMING FROM DATA
        $applyFixedSize = in_array($displayData['catid'], $fixedCategoryId);
    }
}
// Apply width and height
if ($applyFixedSize) {
    // Fixed dimensions for this category
    $displayData['width']  = 300; // px
    $displayData['height'] = 230; // px
    if (empty($displayData['loading'])) {
        $displayData['loading'] = 'lazy';
    }
} elseif ($img->attributes['width'] > 0 && $img->attributes['height'] > 0) {
    // Default dimensions from image
    $displayData['width']  = $img->attributes['width'];
    $displayData['height'] = $img->attributes['height'];
    if (empty($displayData['loading'])) {
        $displayData['loading'] = 'lazy';
    }
}

// Render the image
echo '<img style="padding: 7px;" ' . ArrayHelper::toString($displayData) . '>';
