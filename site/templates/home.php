<?php snippet('header') ?>

<div id="featured-events" class="slider" data-flickity='{ "setGallerySize": false, "pauseAutoPlayOnHover": false, "autoPlay": 5000, "pageDots": false, "prevNextButtons": false, "wrapAround": "true" }'>
	<?php foreach ($page->featured()->toStructure() as $key => $item): ?>
		<?php if ($event = $item->page()->toPage()): ?>
			<div class="slide" style="background-color: <?= $item->color()->split('|')[0] ?>; color: <?= $item->color()->split('|')[1] ?>;">
				<a href="<?= $event->url() ?>" class="featured-image rounded">
					<?php if($image = $event->featured()->toFile()): ?>
						<?php
						if(!isset($maxWidth)) $maxWidth = 2720;
						$ratio = 1/1;
						$placeholder = $image->crop(50, floor(50/$ratio))->url();
						$src = $image->crop(1000, floor(1000/$ratio))->url();
						$srcset = $image->crop(340, floor(340/$ratio))->url() . ' 340w,';
						for ($i = 680; $i <= $maxWidth; $i += 340) $srcset .= $image->crop($i, floor($i/$ratio))->url() . ' ' . $i . 'w,';
						?>
						<img
						class="lazyload<?php if(isset($preload)) echo ' lazypreload' ?>"
						src="<?= $src ?>"
						data-srcset="<?= $srcset ?>"
						data-sizes="auto"
						data-optimumx="1.5"
						width="100%" height="auto" />
					<?php endif ?>
				</a>
				<div class="featured-infos">
					<div class="event-category uppercase mb1">
						<a href="<?= page('la-saison')->url().'#'.$event->parent()->uid() ?>"><?= $event->parent()->title()->html() ?></a>
					</div>
					<div class="event-title title uppercase"><?= $event->title()->html() ?></div>
					<?php if ($event->subtitle()->isNotEmpty()): ?>
					<div class="event-subtitle subtitle uppercase light">
						<?= $event->subtitle()->html() ?>
					</div>
					<?php endif ?>
					<div class="mt3 x xjc xac" md="xw mt1">
						<div class="event-date subtitle"><?= $event->formattedDate() ?></div>
						<div class="event-cta x xjc ml4" md="ml0 mt2">
							<a href="<?= $event->url() ?>" class="button ghost uppercase">En savoir +</a>
							<?php if ($event->ticketing()->isNotEmpty()): ?>
							<a href="<?= $event->ticketing() ?>" class="button ghost uppercase">Réservez</a>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
	<?php endforeach ?>
</div>

<?php snippet('quick-calendar') ?>

<div id="featured-pages" class="pages-grid white">
  <div class="pages-grid--items">
    <?php foreach ($page->links()->toStructure() as $key => $item): ?>
      <div class="pages-grid--item">
        <a href="<?= $item->link() ?>" class="text-center" md="p1">
          <div class="item-image rounded mb1">
            <?php if ($item->image()->isNotEmpty()): ?>
            <?php snippet('responsive-image', ['field' => $item->image(), 'ratio' => 1/1, 'preload' => true, 'maxWidth' => 640]) ?>
            <?php else: ?>
            <?php snippet('responsive-image', ['field' => $site->placeholder(), 'ratio' => 1/1, 'preload' => true, 'maxWidth' => 640]) ?>
            <?php endif ?>
          </div>
          <div class="item-title uppercase bold"><?= $item->title()->html() ?></div>
          <div class="item-subtitle uppercase"><?= $item->subtitle()->html() ?></div>
          <div class="item-text mt1">
            <?= $item->text()->kt() ?>
          </div>
        </a>
        <div class="item-cta x xjc mt1">
          <a href="<?= $item->link() ?>" class="button ghost uppercase">En savoir +</a>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<?php snippet('footer') ?>
