<?php
// Require the Facebook PHP SDK
require_once(dirname(__FILE__) . '/libs/facebook.php');

// Instantiate the Facebook API (you have to enter the ID and secret of your Facebook app)
$facebook = new Facebook(array('appId'  => '', 'secret' => ''));

// Array with graph objects to fetch likes for
$agencies =	array(array('name' => 'Nike',   'graphid' => '15087023444',     'likes' => 0),
                  array('name' => 'Reebok', 'graphid' => '20788456835',     'likes' => 0),
                  array('name' => 'Adidas', 'graphid' => '182162001806727', 'likes' => 0));

// Get the likes for each entry within the array of objects
foreach ($agencies as $key => $agency)
{
	// Call the graph
	$res = $facebook->api('/' . $agency['graphid'], 'GET');
	
	// Check for valid result
	if ($res && is_array($res) && $res['likes'])
	{
		// Update the array with like values
		$agencies[$key]['likes'] = $res['likes'];
	  
	}
	
}

// Write serialized array to cache file
@file_put_contents(dirname(__FILE__) . '/cache.txt', serialize($agencies), LOCK_EX);