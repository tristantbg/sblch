<div class="socials">
	<?php foreach ($site->socials()->toStructure() as $key => $s): ?>
		<a href="<?= $s->url() ?>" class="ghost rounded"><?= $s->title()->html() ?></a>
	<?php endforeach ?>
</div>