<?php snippet('header') ?>

<?php if ($page->ticketing()->isNotEmpty()): ?>
	<a href="<?= $page->ticketing() ?>" id="event-ticket" class="rounded">
		<svg class="invert"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#billet" /></svg>
    <div class="bold uppercase">Réservez</div>
	</a>
<?php endif ?>

<?php if ($prev = $page->previousEvent()): ?>
	<a id="event-navigation-prev" href="<?= $prev->url() ?>">
		<svg class="invert"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#arrow_left" /></svg>
	</a>
<?php endif ?>

<?php if ($next = $page->nextEvent()): ?>
	<a id="event-navigation-next" href="<?= $next->url() ?>">
		<svg class="invert"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#arrow_right" /></svg>
	</a>
<?php endif ?>



<div class="x xas" md="db">
<div
class="event-description"
<?php if ($page->parent()->intendedTemplate() == 'events_category' && $page->parent()->color()->isNotEmpty()): ?>
style="background-color: <?= $page->parent()->color() ?>"
<?php endif ?>
>
	<div class="event-header text-center">
		<div class="event-category uppercase mb1">
			<a href="<?= page('la-saison')->url().'#'.$page->parent()->uid() ?>"><?= $page->parent()->title()->html() ?></a>
		</div>
		<div class="event-title title uppercase"><?= $page->title()->html() ?></div>
		<?php if ($page->subtitlePage()->isNotEmpty() || $page->subtitle()->isNotEmpty()): ?>
		<div class="event-subtitle subtitle uppercase mt1" md="m0">
			<?php if ($page->subtitlePage()->isNotEmpty()): ?>
				<?= $page->subtitlePage()->kt() ?>
			<?php else: ?>
				<?= $page->subtitle()->html() ?>
			<?php endif ?>
		</div>
		<?php endif ?>
		<div class="event-date subtitle my3" md="ttu mt1 mb3"><?= $page->formattedDate() ?></div>
	</div>
	<div class="event-hero">
		<?php if ($page->featuredVideo()->isNotEmpty()): ?>
			<?= $page->featuredVideo()->embed() ?>
		<?php elseif($page->slider()->isNotEmpty()): ?>
			<?php if ($page->slider()->toStructure()->count() == 1): ?>
			<?php snippet('responsive-image', ['field' => $page->slider()->toStructure()->first()]) ?>
			<?php else: ?>
			<?php snippet('slider', [
				'medias' => $page->slider()->toStructure(),
				'options' => '{ "setGallerySize": true, "lazyLoad": 1, "adaptiveHeight": true, "wrapAround": true }'
			]) ?>
			<?php endif ?>
		<?php elseif($page->featured()->isNotEmpty()): ?>
			<?php snippet('responsive-image', ['field' => $page->featured()]) ?>
		<?php endif ?>
	</div>
	<?php if ($page->text()->isNotEmpty()): ?>
		<div id="event-text" class="text mt3">
			<?= $page->text()->kt() ?>
		</div>
	<?php endif ?>
	<?php if ($page->distribution()->isNotEmpty()): ?>
		<div id="event-distribution" class="text mt3">
			<?php foreach ($page->distribution()->toStructure() as $key => $item): ?>
				<div><?= $item->title()->upper().c::get('distribution.divider').$item->text()->ktRaw() ?></div>
			<?php endforeach ?>
		</div>
  <?php endif ?>
  <?php if($page->featuredVideo()->isNotEmpty() && $page->slider()->isNotEmpty()): ?>
      <?php if ($page->slider()->toStructure()->count() > 1): ?>
      <div class="row mt3">
        <?php snippet('slider', [
          'medias' => $page->slider()->toStructure(),
          'options' => '{ "setGallerySize": true, "lazyLoad": 1, "adaptiveHeight": true, "wrapAround": true }'
        ]) ?>
      </div>
      <?php endif ?>
	<?php endif ?>
	<?php if ($page->medias()->isNotEmpty()): ?>
		<div id="event-medias" class="mt3">
			<?php foreach ($page->medias()->toStructure() as $key => $image): ?>
				<?php snippet('responsive-image', ['field' => $image]) ?>
			<?php endforeach ?>
		</div>
	<?php endif ?>
</div>

<div class="event-infos">
	<?php if ($page->duration()->isNotEmpty()): ?>
	<div class="event-duration ghost rounded mb4">
		<div>Durée</div>
		<div><?= $page->duration()->html() ?></div>
	</div>
	<?php endif ?>

	<?php if ($page->parent()->intendedTemplate() == 'events_category' && $page->parent()->icon()->isNotEmpty()): ?>
	<div class="event-icon mb4">
		<a href="<?= page('la-saison')->url().'#'.$page->parent()->uid() ?>">
		<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#<?= $page->parent()->icon() ?>" /></svg>
		</a>
	</div>
	<?php elseif ($page->icon()->isNotEmpty()): ?>
	<div class="event-icon mb4">
		<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#<?= $page->icon() ?>" /></svg>
	</div>
	<?php endif ?>

	<?php if ($page->eventDates()->isNotEmpty()): ?>
	<div class="event-infosdates mb3">
		<div><?= $page->eventDates()->kt() ?></div>
	</div>
	<?php endif ?>

	<?php if ($representions->count() > 0): ?>
	<div class="event-representations mb3">
		<div class="bold uppercase bb">Dates</div>
		<?php foreach ($representions as $key => $date): ?>
			<div class="bb<?php e($date->date('Y-m-d H:i') < date('Y-m-d H:i'), ' finished') ?>"><?= ucfirst(utf8_encode(strftime('%A %d %B', $date->date()))).' → '.utf8_encode(strftime('%Hh%M', $date->date())) ?></div>
		<?php endforeach ?>
	</div>
	<?php endif ?>

	<?php if ($page->infos()->isNotEmpty()): ?>
	<div class="event-infospratiques mb3">
		<div class="bold uppercase">Informations pratiques</div>
		<div><?= $page->infos()->kt() ?></div>
	</div>
	<?php endif ?>

	<?php if ($downloads->count() > 0): ?>
	<div class="event-downloads mb3">
		<?php foreach ($downloads as $key => $download): ?>
			<div class="mb1">
				<a href="<?= $download->file()->toFile()->url() ?>" class="ghost button uppercase" target="_blank"><?= $download->title()->html() ?></a>
			</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>

	<?php if ($partners->count() > 0): ?>
	<div class="event-partners mb3">
		<div class="bold uppercase">Partenaires</div>
		<?php foreach ($partners as $key => $partner): ?>
			<div class="mb1">
				<?php if ($partner->link()->isNotEmpty()): ?>
				<a href="<?= $partner->link() ?>">
				<?php endif ?>
				<div><?= $partner->title()->html() ?></div>
        <?php if ($partner->image()->toFile()): ?>
        <div class="button px0"><?= $partner->image()->toFile()->height(50) ?></div>
        <?php endif ?>
				<?php if ($partner->link()->isNotEmpty()): ?>
				</a>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	</div>
	<?php endif ?>
</div>

</div>

<?php if($related->count() > 0): ?>
<div id="event-related">
	<?php snippet('pages-grid', ['title' => 'Autres événements', 'items' => $related]) ?>
</div>
<?php endif ?>

<?php snippet('footer') ?>
