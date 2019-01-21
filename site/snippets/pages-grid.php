<div class="pages-grid <?php e(!isset($white) || isset($white) && $white, 'white') ?>">
  <?php if (isset($title)): ?>
    <div class="pages-grid--title uppercase title light"><?= $title ?></div>
  <?php endif ?>
  <div class="pages-grid--items">
    <?php foreach ($items as $key => $item): ?>
      <div class="pages-grid--item text-center">
        <a href="<?= $item->url() ?>" class="db p1 pt0">
          <div class="item-image rounded">
            <?php if ($item->featured()->isNotEmpty()): ?>
            <?php snippet('responsive-image', ['field' => $item->featured(), 'ratio' => 1/1, 'preload' => true, 'maxWidth' => 980]) ?>
            <?php else: ?>
            <?php snippet('responsive-image', ['field' => $site->placeholder(), 'ratio' => 1/1, 'preload' => true, 'maxWidth' => 980]) ?>
            <?php endif ?>
          </div>
          <div class="item-category uppercase mb1 mt2"><?= $item->parent()->title()->html() ?></div>
          <div class="item-title uppercase bold mb1"><?= $item->title()->html() ?></div>
          <div class="item-date mb1"><?= $item->formattedDate() ?></div>
          <div class="item-distribution mb1">
            <?php foreach ($item->distribution()->toStructure()->limit(4) as $key => $d): ?>
              <div><?= $d->title()->upper().c::get('distribution.divider').$d->text()->ktRaw() ?></div>
            <?php endforeach ?>
          </div>
        </a>
        <div class="item-cta x xjc">
          <a href="<?= $item->url() ?>" class="button ghost uppercase">En savoir +</a>
          <?php if ($item->ticketing()->isNotEmpty()): ?>
          <a href="<?= $item->ticketing() ?>" class="button ghost uppercase">Réservez</a>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
