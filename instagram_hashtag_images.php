<?php 
function scrape_insta_hash($tag) {
	$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/'); // instagrame tag url
	$shards = explode('window._sharedData = ', $insta_source);
	$insta_json = explode(';</script>', $shards[1]); 
	$insta_array = json_decode($insta_json[0], TRUE);
	return $insta_array; // this return a lot things print it and see what else you need
}
$tag = 'pakistan'; // tag for which ou want images 
$results_array = scrape_insta_hash($tag);
$limit = 7; // provide the limit thats important because one page only give some images then load more have to be clicked
$image_array= array(); // array to store images.
	for ($i=0; $i < $limit; $i++) { 
		$latest_array = $results_array['entry_data']['TagPage'][0]['tag']['media']['nodes'][$i];
	 	$image_data  = '<img src="'.$latest_array['thumbnail_src'].'">'; // thumbnail and same sizes 
	 	//$image_data  = '<img src="'.$latest_array['display_src'].'">'; actual image and different sizes 
		array_push($image_array, $image_data);
	}
	foreach ($image_array as $image) {
		echo $image;// this will echo the images wrap it in div or ul li what ever html structure 
	}
	// for getting all images have to loop function for more pages 
	// for confirmation  you are getting correct images view 
	//https://www.instagram.com/explore/tags/your-tag-name/
?>
