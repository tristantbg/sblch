<?php
  $day1 = strtotime('today');
  $day2 = strtotime('today +1 day');
  $day3 = strtotime('today +2 day');
  $events = site()->index()->filterBy('intendedTemplate', 'representation')->visible();
?>

<div class="quick-calendar">
  <div class="day today">
    <div class="date uppercase bold text-center bb"><a href="<?= page('calendrier')->url() ?>">Aujourd’hui</a></div>
    <?php $itemsPerDay = $events->filter(function($child) use ($day1, $events){ return $child->date() >= $day1 && $child->date() < strtotime('+24 hour', $day1); })->flip(); ?>
    <?php foreach ($itemsPerDay as $key => $event): ?>
      <a href="<?= $event->parent()->url() ?>" class="event x c12 bb">
        <div class="event-time c3 pl1"><?= strftime('%H:%M', $event->date()) ?></div>
        <div class="event-title c9"><?= $event->parent()->parent()->title()->upper().': '.$event->parent()->title()->html() ?></div>
      </a>
    <?php endforeach ?>
    <?php if ($itemsPerDay->count() == 0): ?>
      <div class="event c12 bb pl1 text-center">
        Aucun événement
      </div>
    <?php endif ?>
  </div>
  <div class="day">
    <div class="date uppercase bold text-center bb">
      <a href="<?= page('calendrier')->url().strftime('/%m/%Y', $day2) ?>"><?= utf8_encode(strftime('%A %d %B', $day2)) ?></a>
    </div>
    <?php $itemsPerDay = $events->filter(function($child) use ($day2, $events){ return $child->date() >= $day2 && $child->date() < strtotime('+24 hour', $day2); })->flip(); ?>
    <?php foreach ($itemsPerDay as $key => $event): ?>
      <a href="<?= $event->parent()->url() ?>" class="event x c12 bb">
        <div class="event-time c3 pl1"><?= strftime('%H:%M', $event->date()) ?></div>
        <div class="event-title c9"><?= $event->parent()->parent()->title()->upper().': '.$event->parent()->title()->html() ?></div>
      </a>
    <?php endforeach ?>
    <?php if ($itemsPerDay->count() == 0): ?>
      <div class="event c12 bb pl1 text-center">
        Aucun événement
      </div>
    <?php endif ?>
  </div>
  <div class="day">
    <div class="date uppercase bold text-center bb">
      <a href="<?= page('calendrier')->url().strftime('/%m/%Y', $day3) ?>"><?= utf8_encode(strftime('%A %d %B', $day3)) ?></a>
    </div>
    <?php $itemsPerDay = $events->filter(function($child) use ($day3, $events){ return $child->date() >= $day3 && $child->date() < strtotime('+24 hour', $day3); })->flip(); ?>
    <?php foreach ($itemsPerDay as $key => $event): ?>
      <a href="<?= $event->parent()->url() ?>" class="event x c12 bb">
        <div class="event-time c3 pl1"><?= strftime('%H:%M', $event->date()) ?></div>
        <div class="event-title c9"><?= $event->parent()->parent()->title()->upper().': '.$event->parent()->title()->html() ?></div>
      </a>
    <?php endforeach ?>
    <?php if ($itemsPerDay->count() == 0): ?>
      <div class="event c12 bb pl1 text-center">
        Aucun événement
      </div>
    <?php endif ?>
  </div>
  <div class="go-to-calendar x xac xjc p2">
    <a href="<?= page('calendrier')->url() ?>" class="arrow-button ghost rounded">→</a>
  </div>
</div>
