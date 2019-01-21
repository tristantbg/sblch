<?php

page::$methods['currentTitle'] = function($page) {
	$template = $page->intendedTemplate();
	if (in_array($template, ['home'])) {
		$currentTitle = 'Bienvenue';
	} else if(in_array($template, ['event', 'season'])) {
		$currentTitle = 'La Saison';
	} else if(in_array($template, ['index', 'events', 'events_category'])) {
		$currentTitle = 'À l’affiche';
	}
	 else {
		$currentTitle = $page->title()->excerpt(20);
	}
	return $currentTitle;
};

page::$methods['formattedDate'] = function($page, $withYear = true) {
	$date = '';
	$events = $page->children()->visible()->sortBy('date');

	if ($events->count() == 0) {
		$date = 'Aucune date référencée';
	} else if ($events->count() == 1) {
    if ($withYear) {
      $date = '→ '.ucfirst(utf8_encode(strftime('%d %b %Y', $events->first()->date())));
    } else {
		  $date = '→ '.ucfirst(utf8_encode(strftime('%A %d %b', $events->first()->date())));
    }
		$date .= ' à ';
		$date .= utf8_encode(strftime('%Hh%M', $events->first()->date()));
	} else {
		$date = 'du&nbsp;'.utf8_encode(strftime('%d %b', $events->first()->date()));
		$date .= '&nbsp;&nbsp;&#9604;&nbsp;&nbsp;';
		if ($withYear) {
			$date .= 'au&nbsp;'.utf8_encode(strftime('%d %b %Y', $events->last()->date()));
		} else {
			$date .= 'au&nbsp;'.utf8_encode(strftime('%d %b', $events->last()->date()));
		}
	}
	return $date;
};

page::$methods['futureRepresentations'] = function($page) {
	$representions = $page->children()->visible()->filter(function($child) {
		return $child->date() > time();
        });

	return $representions;
};

page::$methods['futureEvents'] = function($page) {
	$events = $page->children()->visible()->filter(function($child) {
		return $child->futureRepresentations()->count() > 0;
        });

	return $events;
};

page::$methods['isFinished'] = function($page) {

	return $page->futureRepresentations()->count() == 0;
};

page::$methods['isThisYear'] = function($page) {
	return $page->children()->visible()->filter(function($p) {
		return $p->date() >= strtotime(site()->seasonStart()) && $p->date() <= strtotime(site()->seasonEnd());
	})->count() > 0;
};

page::$methods['previousEvent'] = function($page) {
	$events = site()->index()->filterBy('intendedTemplate', 'event')->visible()->sortBy('date');

	$previous = $events->filter(function($child) use($page) {
		return $child->date() < $page->date();
	})->last();

	return $previous;
};

page::$methods['nextEvent'] = function($page) {
	$events = site()->index()->filterBy('intendedTemplate', 'event')->visible()->sortBy('date');

	$next = $events->filter(function($child) use($page) {
		return $child->date() > $page->date();
	})->first();

	return $next;
};

function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}

kirby()->hook('panel.page.*', function($page, $oldPage = null) {
  if ($page->intendedTemplate() == 'event') {
	$first = $page->children()->visible()->sortBy('date')->first();
	if($first) $page->update(['date' => $first->date('Y-m-d H:i')]);
  }
});

kirby()->routes(array(
    array(
        'pattern' => 'calendrier/(:num)/(:num)',
        'action'  => function($month, $year) {

            $data = array(
				'month' => $month,
				'year' => $year,
			);

			return array('calendrier', $data);
        }
    ),
    // array(
    //     'pattern' => 'index',
    //     'action'  => function() {
    //       tpl::load(kirby()->roots()->templates() . DS . 'events.php', array('' => ,'events' => site()->index()->filterBy('intendedTemplate', 'event')->visible()), false );
    //     }
    // ),
));
