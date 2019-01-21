<?php snippet('header') ?>

<div id="sections-navigation">
	<div class="active"><a class="subtitle uppercase" href="#acces">Accès</a></div>
	<?php foreach ($page->children()->visible() as $key => $section): ?>
		<div><a class="subtitle uppercase" href="#<?= $section->uid() ?>"><?= $section->title()->html() ?></a></div>
	<?php endforeach ?>
</div>

<div id="scroll-sections">

	<section id="acces" class="section">
		<div class="section-text x xas" md="db">
			<div id="map" class="column"><?= $page->text2()->kt() ?></div>
      <?php if ($page->text()->isNotEmpty()): ?>
      <div class="column">
        <div class="title mb4 uppercase"><h2 class="title">Accès</h2></div>
        <?= $page->text()->kt() ?>
      </div>
      <?php endif ?>
		</div>
	</section>

	<?php foreach ($page->children()->visible() as $key => $section): ?>
		<section id="<?= $section->uid() ?>" class="section">
			<div class="title mb4 uppercase"><h2 class="title"><?= $section->title()->html() ?></h2></div>
			<div class="section-text">
				<?php if ($section->featured()->isNotEmpty()): ?>
					<div class="column"><?php snippet('responsive-image', ['field' => $section->featured(), 'maxWidth' => 2040]) ?></div>
					<div class="column"><?= $section->text()->kt() ?></div>
				<?php else: ?>
					<?= $section->text()->kt() ?>
				<?php endif ?>
			</div>
		</section>
	<?php endforeach ?>

</div>

<?php snippet('footer') ?>
