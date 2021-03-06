<?php

return function ($site, $pages, $page) {

	return array(
		'categories' => site()->index()->filterBy('intendedTemplate', 'in', ['events', 'events_category'])->visible()->filter(function($p) {
			return $p->children()->visible()->filterBy('isFinished', false)->count() > 0;
		}),
		'events' => $page->children()->visible()->filterBy('isThisYear', true)->sortBy('date'),
	);
}

?>
