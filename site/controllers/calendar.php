<?php

return function ($site, $pages, $page, $data) {

	$events = site()->index()->filterBy('intendedTemplate', 'representation')->visible();

	if(isset($data['month'])) {
		$month = $data['month'];
	} else {
		$month = date('m');
	}
	
	if(isset($data['year'])) {
		$year = $data['year'];
	} else {
		$year = date('Y');
	}

	$time = strtotime('01-'.$month.'-'.$year);

	if(isset($data['year']) && isset($data['month'])) {
		$prevPage = date('/m/Y', strtotime('-1 month', $time));
		$nextPage = date('/m/Y', strtotime('+1 month', $time));
		$month1 = strtotime('first day of this month', $time);
		$month2 = strtotime('first day of next month', $time);
	} else {
		// $nextPage = date('/m/Y', strtotime('first day of September +1 month'));
		// $prevPage = date('/m/Y', strtotime('first day of August'));
		// $month1 = strtotime('first day of September 2018');
		// $month2 = strtotime('first day of October 2018');

		$month1 = strtotime('first day of this month');
		$month2 = strtotime('first day of next month');
		$nextPage = date('/m/Y', strtotime('+1 month'));
		$prevPage = date('/m/Y', strtotime('-1 month'));
	}

	return array(
		'events' => $events,
		'month1' => $month1,
		'month2' => $month2,
		'nextPage' => $nextPage,
		'prevPage' => $prevPage,
	);

}

?>
