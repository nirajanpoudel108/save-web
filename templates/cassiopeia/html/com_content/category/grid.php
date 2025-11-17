<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Component\Content\Site\Helper\RouteHelper as ContentHelperRoute;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

// Load custom CSS for blog
$doc = Joomla\CMS\Factory::getDocument();
$doc->addStyleSheet('templates/your_template/css/blog-default.css');
?>
<div class="category-blog-1col row g-4">
    <?php foreach ($this->items as $item) :

        // Generate the article link
        $itemLink = Route::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));

        // Get intro image
        $images = new Registry($item->images);
        $image = $images->get('image_intro');

        // Clean intro text
        $introtext = strip_tags($item->introtext);
    ?>
        <div class="col-12">
            <div class="card h-100 shadow-sm border-0 flex-md-row">
                <?php if ($image): ?>
                    <div class="card-img-container" style="max-width: 300px; overflow: hidden;">
                        <a href="<?php echo $itemLink; ?>">
                            <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="card-img-left img-fluid rounded-start" 
                                 alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                        </a>
                    </div>
                <?php endif; ?>

                <div class="card-body">
                    <h4 class="card-title mb-2">
                        <a href="<?php echo $itemLink; ?>" class="text-dark text-decoration-none">
                            <?php echo $item->title; ?>
                        </a>
                    </h4>
                    <small class="text-muted d-block mb-2">
                        <?php echo HTMLHelper::_('date', $item->created, 'd M Y'); ?>
                    </small>
                    <p class="card-text mb-3">
                        <?php echo HTMLHelper::_('string.truncate', $introtext, 200, true, false); ?>
                    </p>
                    <a href="<?php echo $itemLink; ?>" class="text-primary small text-decoration-none">
                        Read More →
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
