<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

$images = json_decode($this->item->images);
$introImage = isset($images->image_intro) ? $images->image_intro : '';
$introAlt = isset($images->image_intro_alt) ? $images->image_intro_alt : '';
?>

<article class="featured-item row my-4 py-3 border-bottom align-items-center">
    <?php if ($introImage) : ?>
        <div class="col-md-5 mb-3 mb-md-0">
            <a href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
                <img src="<?php echo htmlspecialchars($introImage, ENT_QUOTES, 'UTF-8'); ?>"
                     class="img-fluid rounded shadow-sm w-100"
                     alt="<?php echo htmlspecialchars($introAlt, ENT_QUOTES, 'UTF-8'); ?>">
            </a>
        </div>
    <?php endif; ?>

    <div class="col-md-7">
        <h2 class="h4 fw-bold mb-2">
            <a href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>" class="text-decoration-none">
                <?php echo $this->escape($this->item->title); ?>
            </a>
        </h2>

        <?php if ($this->params->get('show_intro')) : ?>
            <div class="intro-text">
                <?php echo $this->item->introtext; ?>
            </div>
        <?php endif; ?>

        <?php if ($this->item->readmore) : ?>
            <a class="btn btn-primary btn-sm mt-2" href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
                <?php echo JText::_('COM_CONTENT_READ_MORE'); ?>
            </a>
        <?php endif; ?>
    </div>
</article>
