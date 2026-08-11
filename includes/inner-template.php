<?php
require_once __DIR__ . '/data.php';

$page = $page ?? null;
$sectionTitle = $sectionTitle ?? '';
$sectionPages = $sectionPages ?? [];
$active = $active ?? 'home';

if (!$page) {
    http_response_code(404);
    $page = [
        'title' => 'Page Not Found',
        'image' => 'assets/theme/img/black-pattern.jpg',
        'body' => 'The page you requested could not be found.',
    ];
}

$pageTitle = $page['title'] . ' | Param Packaging Pvt Ltd';
$wpPage = !empty($page['slug']) ? getWordPressPageBySlug($page['slug']) : null;
$innerTitle = $wpPage['post_title'] ?? $page['title'];
$innerContent = $wpPage ? localizeWordPressContent($wpPage['post_content']) : '';
$innerImage = !empty($wpPage['image_url']) ? $wpPage['image_url'] : $page['image'];
include __DIR__ . '/header.php';
?>
  <section id="parallax-inner" class="section static-inner-shell" data-stellar-background-ratio="0.5">
    <div class="quote1-pattern"></div>
    <div class="pattern5">
      <div class="page-section clearfix">
        <div class="page-wrapper">
          <div class="post-slider">
            <div class="feature-img">
              <a class="zoom-link" href="<?php echo h($innerImage); ?>" title="<?php echo h($innerTitle); ?>"><img src="<?php echo h($innerImage); ?>" alt="<?php echo h($innerTitle); ?>"></a>
            </div>
          </div>
          <div class="page-content static-page-content">
            <?php if ($innerContent): ?>
              <?php echo $innerContent; ?>
            <?php else: ?>
              <h2><?php echo h($page['title']); ?></h2>
              <?php foreach (preg_split('/\n\s*\n/', trim($page['body'])) as $paragraph): ?>
                <p><?php echo h($paragraph); ?></p>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <div class="inner-sidebar">
            <h4 class="widget-title"><?php echo h($sectionTitle); ?></h4>
            <ul>
              <?php foreach ($sectionPages as $item): ?>
                <li class="<?php echo $item['key'] === $page['key'] ? 'current-menu-item' : ''; ?>"><a href="<?php echo h($item['url']); ?>"><?php echo h($item['title']); ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="clr"></div>
        </div>
      </div>
    </div>
  </section>
<?php include __DIR__ . '/footer.php'; ?>
