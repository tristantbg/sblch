<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->featured()->isNotEmpty() && $ogimage = $page->featured()->toFile()): ?>
		<?php $ogimage = $ogimage->width(1200) ?>
		<meta property="og:image" content="<?= $ogimage->url() ?>"/>
		<meta property="og:image:width" content="<?= $ogimage->width() ?>"/>
		<meta property="og:image:height" content="<?= $ogimage->height() ?>"/>
	<?php else: ?>
		<?php if($site->ogimage()->isNotEmpty() && $ogimage = $site->ogimage()->toFile()): ?>
			<?php $ogimage = $ogimage->width(1200) ?>
			<meta property="og:image" content="<?= $ogimage->url() ?>"/>
			<meta property="og:image:width" content="<?= $ogimage->width() ?>"/>
			<meta property="og:image:height" content="<?= $ogimage->height() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<link rel="shortcut icon" href="<?= url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?= url('assets/images/favicon.ico') ?>" type="image/x-icon">

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/build/vendor/modernizr-bundle.js');
	?>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>

<body page-type="<?= $page->intendedTemplate() ?>">

<div id="outdated">
	<div class="inner">
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser.
	<br>Please <a href="http://outdatedbrowser.com" target="_blank">upgrade your browser</a> to improve your experience.</p>
	</div>
</div>

<div id="loader"></div>

<div id="main">

	<header>
		<div id="main-logo">
			<a href="<?= $site->url() ?>">
			<svg id="desktop-logo"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#logo_sb_v" /></svg>
			<svg id="mobile-logo"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#logo_sb_cond" /></svg>
			</a>
		</div>
		<?php if ($page->isHomepage()): ?>
		<h1><?= $site->title()->html() ?></h1>
		<?php endif ?>
	</header>

	<?php snippet('navigation') ?>

	<div id="current-title" class="big-title uppercase" event-target="menu">
		<span><?= $page->currentTitle() ?></span>
		<svg class="mobile"><use xlink:href="<?= url('assets/images/svg-sprite.svg') ?>#logo_rb_cond2" /></svg>
	</div>

	<div id="container">

		<div id="page-content" 
		page-type="<?= $page->intendedTemplate() ?>"
		<?php if ($page->parent()->intendedTemplate() == 'events_category'): ?>
		style="background: <?= $page->parent()->color() ?>"
		<?php endif ?>
		>