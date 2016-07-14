<?php

/*

Twitter JSON to Atom proxy for Twitter API 1.1

Original version by yimingliu ( https://gist.github.com/yimingliu/4735445 )

Display user_timeline instead of home_timeline

*/



date_default_timezone_set('America/Los_Angeles');

ini_set('display_errors', 0);



$user_screen_name = 'rajivranjankr';

$user_full_name = 'rajivranjankr';





// Twitter App Settings (https://dev.twitter.com/apps):

// FILL THESE IN



$settings = array(

'consumer_key' => '8BAXoEzESRmAR4tOPfDdU1TVR',

'consumer_secret' => 'SaLGwxIBqp76E5GewZTUooB7gKQ5XVI0xyoV9lsJJuKgrvkCmZ',

'access_token' => '220983508-kRlSy80H4BaDjKn0uvX1PO8ParrmBgrqkIHXaNOV',

'access_token_secret' => '1WKCnRhO6kdSgzl6jWJAfsxSpAwZP6NqSDrnaxs3ZnLTG'

);





// API: https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline



$api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';



$api_params = array(

'count' => 1,

'contributor_details' => 'false',

);



// OAuth:



function oauth_encode($data){

if(is_array($data)){

return array_map('oauth_encode', $data);

} else if(is_scalar($data)) {

return str_ireplace(array('+', '%7E'), array(' ', '~'), rawurlencode($data));

} else {

return '';

}

}



// OAuth base settings



$oauth_params = array(

'oauth_consumer_key' => $settings['consumer_key'],

'oauth_nonce' => md5(microtime() . mt_rand()),

'oauth_signature_method' => 'HMAC-SHA1',

'oauth_timestamp' => time(),

'oauth_token' => $settings['access_token'],

'oauth_version' => '1.0',

);



// Sign OAuth params



$sign_params = array_merge($oauth_params, $api_params);



uksort($sign_params, 'strcmp');



foreach ($sign_params as $k => $v) {

$sparam[] = oauth_encode($k) . '=' . oauth_encode($v);

}

$sparams = implode('&', $sparam);



$base_string = 'GET&' . oauth_encode($api_url) . '&' . oauth_encode($sparams);



$signing_key = oauth_encode($settings['consumer_secret']) . '&' . oauth_encode($settings['access_token_secret']);



$oauth_params['oauth_signature'] = oauth_encode(base64_encode(hash_hmac('sha1', $base_string, $signing_key, TRUE)));





// Set Authorization header:



uksort($oauth_params, 'strcmp');



foreach ($oauth_params as $k => $v) {

$hparam[] = $k . '="' . $v . '"';

}



$hparams = implode(', ', $hparam);



$headers = array();

$headers['Expect'] = '';

$headers['Authorization'] = 'OAuth ' . $hparams;



foreach ($headers as $k => $v) {

$curlheaders[] = trim($k . ': ' . $v);

}



// Format params:



foreach ($api_params as $k => $v) {

$rparam[] = $k . '=' . $v;

}

$rparams = implode('&', $rparam);

// echo "curl --get '" . $api_url . "' --data '" . $rparams . "' --header 'Authorization: OAuth " . $hparams . "' --verbose" . PHP_EOL;

// GET:


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url . '?' . $rparams);

curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheaders);

curl_setopt($ch, CURLOPT_HEADER, false);

curl_setopt($ch, CURLINFO_HEADER_OUT, true);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_TIMEOUT, 10 );



$response = curl_exec($ch);

$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$info = curl_getinfo($ch);

$error = curl_error($ch);

$errno = curl_errno($ch);

curl_close($ch);



if($code != 200){



http_response_code($code);

echo 'Error' . PHP_EOL;

echo $code . PHP_EOL;

print_r($response);

print_r($info);





} else {



$all = json_decode($response, true);



$updated = date(DATE_ATOM, strtotime($all[0]['created_at']));





?>

<?php //echo $updated?>



<?php



foreach($all as $row){


$id = $row['id_str'];

$text = $row['text'];

$title = htmlspecialchars($text);

$entry = $title;



if(isset($row['entities']) and isset($row['entities']['urls']))

{

// expand t.co URLs

$urls = $row['entities']['urls'];

foreach($urls as $url)

{

$url_orig = $url['url'];

$url_expanded = $url['expanded_url'];

$url_expanded_tagged = "<a href='$url_expanded'>$url_expanded</a>";

$title = str_replace($url_orig, $url_expanded, $title);

$entry = str_replace($url_orig, $url_expanded_tagged, $entry);

}

}

$name = htmlspecialchars($row['user']['name']);

$screen_name = $row['user']['screen_name'];

$url = $row['user']['url'];

$profile_image_url = $row['user']['profile_image_url'];

$source = htmlspecialchars($row['source']);

$created = date(DATE_ATOM, strtotime($row['created_at']));





?>



<?php //echo $title?>

<?php //echo $entry?>

<?php

}

?>

<?php

}
?>