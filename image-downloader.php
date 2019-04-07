<?php 
/**
* Filippo Finke
*/ 

class ImageDownloader {

	public static function download($query, $dir)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/search?q='.urlencode($query).'&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjm8YX6mL7hAhWswqYKHVMvBkkQ_AUIDigB&biw=1440&bih=766');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		$headers = array();
		$headers[] = 'Authority: www.google.com';
		$headers[] = 'Cache-Control: max-age=0';
		$headers[] = 'Upgrade-Insecure-Requests: 1';
		$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
		$headers[] = 'Dnt: 1';
		$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
		$headers[] = 'Referer: https://www.google.com/';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		curl_close ($ch);
		preg_match_all('/<div class="rg_meta notranslate">(.*?)<\/div>/', $result, $matches);
		foreach($matches[1] as $match)
		{
			$data = json_decode($match, true);
			$link = $data["ou"];
			$name = explode("/", $link);
			file_put_contents($dir.'/'.end($name), file_get_contents($link));
			echo "[Info] Saved $link".PHP_EOL;
		}
		
	}
}

/* Example */
// ImageDownloader::download("supermoto","downloads");
?>