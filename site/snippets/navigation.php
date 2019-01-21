<div id="burger" event-target="menu">
	<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#burger" /></svg>
	<div class="uppercase text-center">Menu</div>
</div>

<div id="menu-desktop" class="menu">
	<div class="inner">
		<nav>
			<div class="close" event-target="menu">
				<svg><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#close" /></svg>
			</div>
			<?php if (page('index')): ?>
			<a href="<?= page('index')->url() ?>" class="medium uppercase text-center">À l'affiche</a>
			<?php endif ?>
			<?php foreach ($site->menu()->toStructure() as $key => $p): ?>
				<?php if ($p = page($p)): ?>
					<a href="<?= $p->url() ?>" class="medium uppercase text-center"><?= $p->title()->html() ?></a>
				<?php endif ?>
			<?php endforeach ?>
		</nav>
		<div class="menu-buttons">
			<?php if ($site->location()->isNotEmpty() && $location = $site->location()->toPage()): ?>	
			<a href="<?= $location->url() ?>">
				<div class="icon rounded">
					<svg class="invert"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#maison" /></svg>
				</div>
			</a>
			<?php endif ?>
		</div>
		<?php snippet('socials') ?>
	</div>
</div>