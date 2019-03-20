<footer>
	<a href="<?= $site->newsletter() ?>" class="newsletter text"><div class="ghost button uppercase">Recevoir la newsletter</div></a>
	<?php snippet('socials') ?>
	<!-- <div class="credits">
		<div class="mt1 text uppercase"><?= date('Y').' © '.$site->title()->html() ?></div>
	</div> -->
	<div class="footer-buttons">
		<!-- <a class="ghost rounded" href="<?= $site->ticketing() ?>">
			<svg class="invert dn" md="db"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#billet_footer" /></svg>
      <svg class="invert" md="dn"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#billet" /></svg>
		</a> -->
		<a class="ghost rounded" href="#" event-target="top">
			<svg class="invert"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#arrow_up" /></svg>
		</a>
	</div>
</footer>
<footer style="padding-top: 0">
	<a href="https://scenesblanches.com" id="footer-group">
		<div class="uppercase">Un site du groupe Scènes Blanches</div>
	</a>
</footer>
