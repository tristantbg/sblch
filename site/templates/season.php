<?php snippet('header') ?>

<div id="sections-navigation">
	<div class="active"><a class="subtitle uppercase" href="#saison-edito">Édito</a></div>
	<?php foreach ($categories->filterBy('intendedTemplate', 'events') as $key => $section): ?>
		<div><a class="subtitle uppercase" href="#<?= $section->uid() ?>"><?= $section->title()->html() ?></a></div>
	<?php endforeach ?>
	<div><a class="subtitle uppercase" href="#rencontres">Rencontres</a></div>
	<?php if ($archives->count() > 0): ?>
	<div><a class="subtitle uppercase" href="#archives">Archives</a></div>
	<?php endif ?>
</div>

<div id="scroll-sections">

	<section id="saison-edito" class="section p0"
	<?php if ($featured = $page->featured()->toFile()): ?>
	style="background-image: url('<?= $featured->width(4000)->url() ?>')"
	<?php endif ?>
	>
		<div id="edito-text">
			<div class="title mb4 uppercase"><h2 class="title"><?= e($page->seasonTitle()->isNotEmpty(), $page->seasonTitle()->html(), 'Édito') ?></h2></div>
			<div class="section-text text"><?= $page->text()->kt() ?></div>
		</div>
	</section>

	<?php foreach ($categories->filterBy('intendedTemplate', 'events') as $key => $section): ?>
		<section id="<?= $section->uid() ?>" class="section">
			<div class="title mb4 uppercase"><h2 class="title"><?= $section->title()->html() ?></h2></div>
			<?php snippet('section-events', ['events' => $events, 'section' => $section]) ?>
		</section>
	<?php endforeach ?>

	<section id="rencontres" class="section js-badger-accordion">

		<div class="title mb4 uppercase"><h2 class="title">Rencontres</h2></div>

		<?php foreach ($categories->filterBy('intendedTemplate', 'events_category') as $key => $section): ?>
			<section id="<?= $section->uid() ?>" class="sub-section " style="background: <?= $section->color() ?>">
				<div class="title light uppercase js-badger-accordion-header">
					<div class="section-icon">
						<?php if ($section->icon()->isNotEmpty()): ?>
							<div class="icon">
								<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#<?= $section->icon() ?>" /></svg>
							</div>
						<?php endif ?>
					</div>
					<div class="section-title"><?= $section->title()->html() ?></div>
					<div class="dropdown">
						<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#dropdown" /></svg>
					</div>
				</div>
				<div class="badger-accordion__panel js-badger-accordion-panel">
					<div class="section-events js-badger-accordion-panel-inner">
						<?php if ($section->text()->isNotEmpty()): ?>
							<div class="sub-section--text text">
								<?= $section->text()->kt() ?>
							</div>
						<?php endif ?>
						<?php foreach ($events as $key => $event): ?>

							<?php if ($event->parent()->is($section)): ?>
								<a href="<?= $event->url() ?>" class="event<?php e($event->isFinished(), ' finished') ?>">
									<div class="event-title bold uppercase text pl0_5"><?= $event->title()->html() ?></div>
									<div class="event-date light text"><?= $event->formattedDate(false) ?></div>
									<div class="event-distribution mb1">
										<?php foreach ($event->distribution()->toStructure()->limit(2) as $key => $d): ?>
											<div><?= $d->title().c::get('distribution.divider').$d->text()->ktRaw() ?></div>
										<?php endforeach ?>
									</div>
								</a>
							<?php endif ?>

						<?php endforeach ?>
					</div>
				</div>
			</section>
		<?php endforeach ?>

	</section>

	<?php if ($archives->count() > 0): ?>

	<section id="archives" class="section">

		<div class="mb4">
			<div class="title uppercase"><h2>Archives</h2></div>
			<div class="text light uppercase">(des productions de la Reine Blanche)</div>
		</div>
		<?php snippet('section-events', ['events' => $archives, 'withYear' => true]) ?>

	</section>

	<?php endif ?>

</div>

<?php snippet('footer') ?>
