<?php>

function add_cache($tweet){
	
	$twitterapi_url = "https://api.twitter.com/1/statuses/oembed.json?id=";

	$twitterapi_url = $twitterapi_url . $tweet;
	
	$curl = curl_init($twitterapi_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($curl);
	curl_close($curl);
	
	$json_content = json_decode($response, true);
	
	$html = $json_content['html'];
	$qInsert_cache = "INSERT INTO `twitter` (`tweetid`, `html`) VALUES (" . $tweet . ",'" . addslashes($html) ."')";
	$rInsert_cache = mysql_query($qInsert_cache);

	if (!$rInsert_cache) {
	    die('Could not query:' . mysql_error());
	}
	
	// send html back to fuction
	return $html;

} // end add_cache



function check_cache($tweet){
	
	$qCheck_cache = "SELECT * from twitter where tweetid =" . $tweet;
	$rCheck_cache = mysql_query($qCheck_cache);
	
	if (mysql_num_rows($rCheck_cache) == 0) {
		// not in cache - add and return html
		
		$html = add_cache($tweet);
		
	} else {
		// in cache - fetch from db
		$cached_tweet = mysql_fetch_assoc($rCheck_cache);
		$html = stripslashes($cached_tweet["html"]);
	}
		
return $html;
	
} // end check_cache

?>