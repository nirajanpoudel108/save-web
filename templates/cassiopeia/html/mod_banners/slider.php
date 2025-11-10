<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_banners
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

// ✅ Load Bootstrap 5 assets (CSS + JS)
HTMLHelper::_('bootstrap.loadCss');
HTMLHelper::_('bootstrap.framework');

// Exit if no banners
if (empty($list)) {
    return;
}

// Add autoplay and pause on hover
$doc = Factory::getDocument();
$doc->addScriptDeclaration("
document.addEventListener('DOMContentLoaded', function() {
    const bannerCarousel = document.querySelector('#bannerCarousel');
    if (bannerCarousel) {
        new bootstrap.Carousel(bannerCarousel, {
            interval: 3000,  // auto-slide every 3 seconds
            pause: 'hover'
        });
    }
});
");
?>
<div id="bannerCarousel" style="margin-top: 1px;" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($list as $i => $item) : ?>
      <?php
        // ✅ Correct way to get image URL
        $imageurl = $item->params->get('imageurl');
        $clickurl = $item->clickurl ?? '';
        $altText  = htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');
        $desc     = $item->description ?? '';
      ?>

      <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
        <?php if (!empty($clickurl)) : ?>
          <a href="<?php echo $clickurl; ?>" target="_blank" rel="noopener">
            <img src="<?php echo $imageurl; ?>" class="d-block w-100" alt="<?php echo $altText; ?>" style="max-height:530px; object-fit:cover;">
          </a>
        <?php else : ?>
          <img src="<?php echo $imageurl; ?>" class="d-block w-100" alt="<?php echo $altText; ?>" style="max-height:530px; object-fit:cover;">
        <?php endif; ?>

        <?php if (!empty($desc)) : ?>
          <div class="carousel-caption d-none d-md-block">
            <h5><?php echo $altText; ?></h5>
            <p><?php echo $desc; ?></p>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

  <!-- Indicators -->
  <div class="carousel-indicators">
    <?php foreach ($list as $i => $item) : ?>
      <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
    <?php endforeach; ?>
  </div>
</div>
