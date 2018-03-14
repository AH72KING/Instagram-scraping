<?php
function scrape_insta_user_images($username) {
	$insta_source = file_get_contents('https://www.instagram.com/'.$username.'/'); // instagram user url
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	$insta_array = json_decode($insta_json[0], TRUE);
	return $insta_array; // this return a lot things print it and see what else you need
}

$username = 'pakistan'; // user for which you want images 
$results_array = scrape_insta_user_images($username);
//echo '<pre>';
//print_r($results_array);
//echo '<pre>';
$limit = 56; // provide the limit thats important because one page only give some images.
$image_array= array(); // array to store images.
	for ($i=0; $i < $limit; $i++) { 	
		//new code to get images from json 	
		if(isset($results_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i])){
			$latest_array = $results_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'][$i]['node'];
		 	$image_data  = '<img src="'.$latest_array['thumbnail_src'].'">'; // thumbnail and same sizes 
		 	//$image_data  = '<img src="'.$latest_array['display_src'].'">'; actual image and different sizes 
			array_push($image_array, $image_data);
		}
	}
	foreach ($image_array as $image) {
		echo $image;// this will echo the images wrap it in div or ul li what ever html structure 
	}
	// for getting all images have to loop function for more pages 
	// for confirmation  you are getting correct images view 
	//https://www.instagram.com/username


  ?>
