<?php

return function ($site, $pages, $page) {

	$related = new Collection();
	foreach ($page->related()->toStructure()->limit(4) as $key => $item) {
		$related->data[] = $item->page()->toPage();
	}

	return array(
		'representions' => $page->children()->visible()->sortBy('date', 'asc', 'time', 'asc'),
		'downloads' => $page->downloads()->toStructure(),
		'partners' => $page->partners()->toStructure(),
		'related' => $related,
	);
}

?>
