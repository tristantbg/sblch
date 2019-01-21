<?php snippet('header') ?>

<div id="events-categories">
	<div class="desktop">
		<div>Trier par →</div>
		<div class="category uppercase<?php e($page->is(page('index')), ' active') ?>">
			<a href="<?= page('index')->url() ?>">
				Tous
			</a>
		</div>
		<?php foreach ($categories as $key => $c): ?>
			<div class="category uppercase<?php e($page->is($c), ' active') ?>">
				<a href="<?= $c->url() ?>">
					<?= $c->title() ?>
				</a>
			</div>
		<?php endforeach ?>
	</div>
	<div class="mobile">
		<div class="js-badger-accordion">
			<div class="uppercase js-badger-accordion-header" aria-expanded="false">
				<div>Trier par</div>
				<div class="dropdown">
					<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#dropdown" /></svg>
				</div>
			</div>
			<div class="badger-accordion__panel js-badger-accordion-panel -ba-is-hidden">
				<div class="js-badger-accordion-panel-inner">
					<div class="category uppercase<?php e($page->is(page('index')), ' active') ?>">
						<a href="<?= page('index')->url() ?>">
							Tous
						</a>
					</div>
					<?php foreach ($categories as $key => $c): ?>
						<div class="category uppercase<?php e($page->is($c), ' active') ?>">
							<a href="<?= $c->url() ?>">
								<?= $c->title() ?>
							</a>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($events->count() > 0): ?>
	<div id="events-grid" class="row">
		<?php snippet('pages-grid', ['items' => $events, 'white' => false]) ?>
	</div>
<?php endif ?>

<?php snippet('footer') ?>