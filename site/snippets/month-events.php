<div class="month-events">
	<div class="month-title title light uppercase text-center mb4" md="m0"><?= ucfirst(utf8_encode(strftime('%B %Y',$month))) ?></div>
	<div class="month-items">
		<?php $callback = function($p) {return $p->date('j');}; ?>
		<?php $list = $events->filter(function($child) use ($month, $events){
      return strftime('%m %Y', $child->date()) == strftime('%m %Y',$month);
    })->group($callback)->toArray(); ksort($list) ?>
		<?php foreach ($list as $day => $itemsPerDay): ?>
			<div class="day x <?php e($itemsPerDay->first()->date('Y-m-d H:i') < date('Y-m-d H:i'), 'finished') ?><?php e($itemsPerDay->first()->date('Y-m-d') == date('Y-m-d'), ' today') ?>">
				<div class="day-title x c2<?php e(isWeekend($itemsPerDay->first()->date('Y-m-d')), ' weekend') ?>">
					<div class="c6 text-center"><?= $day ?></div>
					<div class="c6"><?= ucfirst(strftime('%a', $itemsPerDay->first()->date())) ?></div>
				</div>
				<div class="day-events c10">
					<?php foreach ($itemsPerDay as $key => $event): ?>
						<a href="<?= $event->parent()->url() ?>" class="event x c12">
							<div class="event-time pr1"><?= strftime('%H:%M', $event->date()) ?></div>
							<div class="event-title xx"><?= $event->parent()->parent()->title()->upper().': '.$event->parent()->title()->html() ?></div>
						</a>
					<?php endforeach ?>
				</div>
			</div>
		<?php endforeach ?>
		<?php if (count($list) == 0): ?>
			<div class="c12 p1">
				<div class="text-center uppercase">Aucun événement</div>
			</div>
		<?php endif ?>
	</div>
</div>
