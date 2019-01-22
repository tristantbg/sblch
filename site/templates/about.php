<?php snippet('header') ?>

<div id="sections-navigation">
	<div class="active"><a class="subtitle uppercase" href="#a-propos"><?= $page->title()->html() ?></a></div>
	<?php foreach ($page->children()->visible() as $key => $section): ?>
		<div><a class="subtitle uppercase" href="#<?= $section->uid() ?>"><?= $section->title()->html() ?></a></div>
	<?php endforeach ?>
</div>

<div id="scroll-sections">
	
	<section id="a-propos" class="section" 
	<?php if ($featured = $page->featured()->toFile()): ?>
	style="background-image: url('<?= $featured->width(2000)->url() ?>')"
	<?php endif ?>
	>
		<?php if ($page->videoEmbed()->isNotEmpty()): ?>
			<?= $page->videoEmbed()->embed() ?>
			<br>
		<?php endif ?>
		<div id="about-text">
			<div class="title mb4 uppercase"><h2 class="title"><?= $page->title()->html() ?></h2></div>
			<div class="section-text">
				<?php if ($page->text()->isNotEmpty()): ?>
				<div class="column"><?= $page->text()->kt() ?></div>
				<?php endif ?>
				<?php if ($page->text2()->isNotEmpty()): ?>
				<div class="column"><?= $page->text2()->kt() ?></div>
				<?php endif ?>
			</div>
		</div>
	</section>

	<?php foreach ($page->children()->visible() as $key => $section): ?>
		<section id="<?= $section->uid() ?>" class="section">
			<div class="title mb4 uppercase"><h2 class="title"><?= $section->title()->html() ?></h2></div>
			<div class="section-text">
				<?php if ($section->featured()->isNotEmpty()): ?>
				<div class="column"><?php snippet('responsive-image', ['field' => $section->featured(), 'maxWidth' => 2040]) ?></div>
				<?php endif ?>
				<div class="column"><?= $section->text()->kt() ?></div>
			</div>
		</section>
	<?php endforeach ?>

</div>

<?php snippet('footer') ?>