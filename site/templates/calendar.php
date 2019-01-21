<?php snippet('header') ?>

<div class="psr">
	<div id="previous-month"><a href="<?= $page->url().$prevPage ?>" class="arrow-button ghost rounded">←</a></div>
	<div id="next-month"><a href="<?= $page->url().$nextPage ?>" class="arrow-button ghost rounded">→</a></div>
	
	<?php snippet('month-events', ['month' => $month1]) ?>
	<?php snippet('month-events', ['month' => $month2]) ?>
</div>

<?php snippet('footer') ?>