<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Component\Content\Site\Helper\RouteHelper as ContentHelperRoute;
use Joomla\CMS\Router\Route;
use Joomla\Registry\Registry;

// Load custom CSS for blog
$doc = Joomla\CMS\Factory::getDocument();
$doc->addStyleSheet('templates/your_template/css/blog-default.css');


if (!empty($this->items)) :
?>
<div class="category-blog-3col row g-4">
    <?php foreach ($this->items as $item) :

        // Generate the article link
        $itemLink = Route::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));

        // Get intro image
        $images = new Registry($item->images);
        $image = $images->get('image_intro');

        // Clean intro text
        $introtext = strip_tags($item->introtext);
    ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <?php if ($image): ?>
                    <a href="<?php echo $itemLink; ?>">
                        <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" 
                             class="card-img-top rounded-top" 
                             style="width:346px; height: 311px"
                             alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                    </a>
                <?php endif; ?>

                <div class="card-body">
                    <h5 class="card-title mb-2">
                        <a href="<?php echo $itemLink; ?>" class="text-dark text-decoration-none">
                            <?php echo $item->title; ?>
                        </a>
                    </h5>
                    <small class="text-muted d-block mb-2">
                        <?php echo HTMLHelper::_('date', $item->created, 'd M Y'); ?>
                    </small>
                    <p class="card-text mb-0">
                        <?php echo HTMLHelper::_('string.truncate', $introtext, 120, true, false); ?>
                    </p>
                </div>

                <div class="card-footer border-0 bg-white">
                    <a href="<?php echo $itemLink; ?>" class="text-primary small text-decoration-none">
                        Read More →
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
