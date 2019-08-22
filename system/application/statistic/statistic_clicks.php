<?php
	$sql_select = 
	"
		SELECT
			@row := 0;
			
		SELECT
			@row := @row + 1 AS 'row', tmp.*
		FROM (
			SELECT
				s.fk_statistic_url, su.url, SUM(s.click) AS clicks
			FROM
				statistic AS s
			LEFT JOIN
				statistic_url AS su ON su.id = s.fk_statistic_url
			WHERE
				IF(|HOST| = 0, 1, s.fk_statistic_host = |HOST|)
			GROUP BY
				su.url
			ORDER BY
				clicks |ORDER|
			LIMIT
				|LIMIT|
		) AS tmp
	";
	$faSql->load($sql_select);
	$faSql->set(array(
		'HOST' => $authorizationData['host_id'],
		'ORDER' => $statistic_order,
		'LIMIT' => $statistic_limit,
	));
	$faSql->run();

	if ($faSql->num_rows>0)
	{
		$records = $faSql->to_assoc();
		$tableRows = array();
		foreach($records as $key => $value)
		{
			$link_url = 'http://' . DOMAIN . US . 'links' . "?link={$value['fk_statistic_url']}";
			$link_title = htmlspecialchars(substr($value['url'], 0, 60));
			$tableRows[$key]['N'] = $value['row'];
		$tableRows[$key]['link'] = "<a class=\"_blank\" title=\"{$value['url']}\" href=\"{$link_url}\">{$link_title}</a>";
			$tableRows[$key]['clicks'] = $value['clicks'];
		};
		$most_visited = fill_table($tableRows);
	} else {
		$most_visited = false;
	};
		
	return $most_visited;
?>