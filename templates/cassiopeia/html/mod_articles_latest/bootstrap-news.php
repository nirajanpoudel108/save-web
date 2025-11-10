<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Registry\Registry;

if (!$list) {
    return;
}

$chunkedList = array_chunk($list, 4); // Split into groups of 3 for carousel slides
?>

<div class="latest-news-bootstrap">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-1">
        <div>
            <h3 class="h5 fw-bold text-uppercase">    
                <?php echo htmlspecialchars($module->title, ENT_QUOTES, 'UTF-8'); ?>
            </h3>
           
            <!-- <p class="text-muted small mb-0">The news about recent activities for needed peoples</p> -->
        </div>
         
        <?php if (count($list) > 4): ?>
            <div class="btn-group btn-group-sm" role="group">
                <button class="btn btn-outline-secondary" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-outline-secondary" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        <?php endif; ?>
    </div>
<hr />
    <!-- Carousel -->
    <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php foreach ($chunkedList as $i => $chunk): ?>
                <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                    <div class="row g-4">
                        <?php foreach ($chunk as $item): 
                            $images = new Registry($item->images);
                            $image = $images->get('image_intro');
                            $introtext = strip_tags($item->introtext);
                        ?>
                            <div class="col-md-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <?php if ($image): ?>
                                        <a href="<?php echo $item->link; ?>">
                                            <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>"
                                                 class="card-img-top rounded-top"
                                                 alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                                        </a>
                                    <?php endif; ?>

                                    <div class="card-body">
                                        <small class="text-muted d-block mb-1">
                                            <!-- <i class="far fa-calendar me-1"></i> -->
                                            <!-- <?php echo HTMLHelper::_('date', $item->created, 'd M Y'); ?> -->
                                        </small>

                                        <h6 class="card-title fw-bold mb-2">
                                            <a href="<?php echo $item->link; ?>" class="text-decoration-none text-dark">
                                                <?php echo $item->title; ?>
                                            </a>
                                        </h6>

                                        <p class="card-text text-muted small mb-0">
                                            <?php echo HTMLHelper::_('string.truncate', $introtext, 500, true, false); ?>
                                        </p>
                                    </div>

                                    <div class="card-footer bg-white border-0">
                                        <a href="<?php echo $item->link; ?>" class="text-primary small text-decoration-none">
                                            Read More →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
