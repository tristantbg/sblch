<?php if (in_array($page->parent()->intendedTemplate(), ['about', 'informations']) && !_bot_detected() && !r::ajax()): ?>
	<script>
		url = window.location.href.replace('/<?= $page->uid() ?>', '#<?= $page->uid() ?>');
		window.location = url;
	</script>
<?php endif ?>

<?php snippet('header') ?>

<div id="scroll-sections">

	<section id="<?= $page->uid() ?>" class="section">
		<div class="title mb4 uppercase"><h1><?= $page->title()->html() ?></h1></div>
		<div class="section-text">
			<div class="column">
				<?= $page->text()->kt() ?>
				<?php if ($page->downloads()->toStructure()->count() > 0): ?>
				<div class="event-downloads mt3">
					<?php foreach ($page->downloads()->toStructure() as $key => $download): ?>
						<div class="mb1">
							<a href="<?= $download->file()->toFile()->url() ?>" class="ghost button uppercase" target="_blank"><?= $download->title()->html() ?></a>
						</div>
					<?php endforeach ?>
				</div>
				<?php endif ?>
			</div>
			<div class="column">
				<?php if ($page->featured()->isNotEmpty()): ?>
				<div class="mb2"><?php snippet('responsive-image', ['field' => $page->featured(), 'maxWidth' => 2040]) ?></div>
				<?php endif ?>
				<?php if ($page->medias()->toStructure()->count() > 0): ?>
				<div class="page-medias">
					<?php foreach ($page->medias()->toStructure() as $key => $media): ?>
						<div class="mb2">
							<?php snippet('responsive-image', ['field' => $media, 'maxWidth' => 2040]) ?>
						</div>
					<?php endforeach ?>
				</div>
				<?php endif ?>
			</div>
		</div>
	</section>

</div>

<?php snippet('footer') ?>