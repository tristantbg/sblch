<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'K2-PERSONAL-8df69012805173a0bd725c5661bbee6e');
c::set('imagekit.license', 'IMGKT1-8df69012805173a0bd725c5661bbee6e');

/*

---------------------------------------
Variables
---------------------------------------

*/


c::set('distribution.divider', '=');


/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('debug', true);
c::set('ssl', true);
c::set('locale', 'fr_FR');
// c::set('panel.stylesheet', 'assets/css/panel.css');
c::set('autobuster', true);
c::set('cache', false);
c::set('cache.driver', 'memcached');
c::set('plugin.embed.video.lazyload', true);
c::set('plugin.embed.video.lazyload.btn', 'assets/images/play.png');

c::set('imagekit.widget.discover', false);
c::set('imagekit.complain', false);
c::set('imagekit.widget.step', 1);

c::set('plugin.updateid', array(
  // Auto-update related ID on each event page
	array(
		'pages'  => 'home',
		'fields' => 'featured'
	),
	array(
		'pages'  => 'la-saison',
		'fields' => 'archive'
	),
	array(
		'pages'  => function () { return site()->find('calendrier')->grandChildren(); },
		'fields' => 'related'
	)
));

c::set('kirbytext.image.figure', false);
c::set('textarea.buttons', array(
  "bold",
  "link",
  "page",
  "email"
));
c::set('simplemde.buttons', array(
  "bold",
  "link",
  "page",
  "email"
));
c::set('simplemde.replaceTextarea', false);
//Typo
c::set('typography', true);
c::set('typography.ordinal.suffix', false);
c::set('typography.fractions', false);
c::set('typography.dashes.spacing', false);
c::set('typography.hyphenation', false);
//c::set('typography.hyphenation.language', 'fr');
//c::set('typography.hyphenation.minlength', 5);
c::set('typography.hyphenation.headings', false);
c::set('typography.hyphenation.allcaps', false);
c::set('typography.hyphenation.titlecase', false);
//Settings
c::set('sitemap.exclude', array('error'));
c::set('sitemap.important', array('contact'));
c::set('thumb.quality', 90);
// c::set('thumbs.driver', 'im');
c::set('routes', array(
	// array(
	// 	'pattern' => 'info/(:any)',
	// 	'action'  => function($uri,$uid) {
	// 		$page = site()->homePage();
	// 		go($page);
	// 	}
	// 	),
	array(
		'pattern' => 'robots.txt',
		'action' => function () {
			return new Response('User-agent: *
				Disallow: /content/*.txt$
				Disallow: /kirby/
				Disallow: /site/
				Disallow: /*.md$
				Sitemap: ' . u('sitemap.xml'), 'txt');
		}
		)
));
kirby()->hook(['panel.page.create', 'panel.page.sort', 'panel.page.hide', 'panel.page.delete'], function($page) {
  if($page->intendedTemplate() == 'representation') {
  	$page->parent()->update(array(
		'sortable'    => ''
	));
  }
});
s::$fingerprint = function() {
  return '';
};
