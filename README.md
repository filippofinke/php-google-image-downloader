# php-google-image-downloader
Simple script that allows you to download images from google

### How to
```
<?php
require 'image-downloader.php';

/** 
* Search for supermoto images and save them in the downloads folder.
*/
ImageDownloader::download("supermoto","downloads");
echo "Finished".PHP_EOL;

?>
```
