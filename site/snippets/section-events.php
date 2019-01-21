<?php if (!isset($withYear)){ $withYear = false; } ?>

<div class="section-events">
	<?php foreach ($events as $key => $event): ?>

		<?php if (!isset($section) || isset($section) && $event->parent()->is($section)): ?>
			<a href="<?= $event->url() ?>" class="event<?php e($event->isFinished(), ' finished') ?>">
				<div class="event-title bold uppercase text pl0_5" md="pl0"><?= $event->title()->html() ?></div>
				<div class="event-date light text"><?= $event->formattedDate($withYear) ?></div>
				<div class="event-distribution mb1 pl1" md="pl0">
					<?php foreach ($event->distribution()->toStructure()->limit(2) as $key => $d): ?>
						<div><?= $d->title().' : '.$d->text()->ktRaw() ?></div>
					<?php endforeach ?>
				</div>
				<div class="event-icon">
					<?php if ($event->icon()->isNotEmpty()): ?>
						<div class="icon">
							<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#<?= $event->icon() ?>" /></svg>
						</div>
					<?php endif ?>
				</div>
			</a>
		<?php endif ?>

	<?php endforeach ?>
</div>
