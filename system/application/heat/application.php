<?php
	$authorizationData = $faAuthorize->get_login();
	
	$get = array();
	
	if (isset($_GET['link']) == true)
	{
		$get_link = $_GET['link'];
		$get['link'] = $get_link;
	};
	
	if (isset($_GET['page'])==true)
	{
		$get_page = $_GET['page'];
	} else {
		$get_page = 1;
	};
	$get['page'] = '|PAGE|';

	if (count($get) > 0)
	{
		foreach($get as $key => $value)
		{
			$get_tmp[] = "{$key}={$value}";
		};
		$page_url = '?' . implode('&amp;', $get_tmp);
	} else {
		$page_url = '';
	};
	
	/* date */
	// if (is_array($url_methods))
	// {
		// $list_link_url = US . implode(US, $url_methods);
	// } else {
	// };
	$list_link_url = '';
	/* date */
	
	if (isset($_GET['link']) == true)
	{
		// $application_content = require_once PATH_APPLICATION . APPLICATION . DS . 'link' . EXT_PHP;
	} else {
		// $application_content = require_once PATH_APPLICATION . APPLICATION . DS . 'links' . EXT_PHP;
	};

	$application_content = require_once PATH_APPLICATION . APPLICATION . DS . 'heat' . EXT_PHP;

	$template = basename(__FILE__, EXT_PHP);
	$template = $faTemplate->get('application' . DS . APPLICATION . DS . $template);
	$application_result = $faTemplate->set($template, array(
		'|APPLICATION_CONTENT|' => $application_content,
	));

	return $application_result;
?>