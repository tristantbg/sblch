<?php

return function ($site, $pages, $page) {

	$archives = new Collection();

	foreach ($page->archive()->toStructure() as $key => $item) {
		if($e = $item->event()->toPage()) $archives->data[] = $e;
	}

	return array(
		'categories' => site()->index()->filterBy('intendedTemplate', 'in', ['events', 'events_category'])->visible()->filter(function($p) {
			return $p->children()->visible()->filterBy('isThisYear', true)->count() > 0;
		}),
		'events' => site()->index()->filterBy('intendedTemplate', 'event')->visible()->filterBy('isThisYear', true)->sortBy('date'),
		'archives' => $archives->sortBy('date')
	);
}

?>
