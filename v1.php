<?php
$id = $_GET['id'];

// Define your API link and proxy base URL.
$apiLink = 'https://animegers-main-gogoanime-api.onrender.com';
$proxyBaseUrl = 'https://animegers-anime-proxy.onrender.com/m3u8-proxy';

// Fetch the JSON data from your API.
$json = file_get_contents("$apiLink/vidcdn/watch/$id");
$jsonData = json_decode($json, true);

// Extract the video URL from the JSON response.
$videoFile = $jsonData['sources'][0]['file'];

// Construct the proxied video URL with properly encoded headers.
$headers = urlencode('{"referer": "https://s3embtaku.pro"}');
$proxiedVideoUrl = "$proxyBaseUrl?url=$videoFile&headers=$headers";

// Define your webName and webUrl here or get them from your configuration.
$webName = 'Animegers! >> Anime Player';
$webUrl = 'https://www.animegers.com';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $webName ?></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/playerjs.js" type="text/javascript"></script>
    <style type="text/css">
        body {background-color: #000;}
    </style>
</head>
<body>
<div id="player"></div>

<script type="text/javascript">
    // Pass the properly escaped proxied video URL to the player.
    var player = new Playerjs({
        id: "player",
        file: "<?= $proxiedVideoUrl ?>",
        hls: 1
    });
</script>

</body>
</html>
