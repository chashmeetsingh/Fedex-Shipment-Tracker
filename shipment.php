<?php

	$provider=$_GET["provider"];

	$num=$_GET["num"];

	function curlget($url){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_URL, $url);

		$results = curl_exec($ch);

		curl_close($ch);

		return $results;
	}

	$packtBook = array();

	function returnXpathObject($item){

		$xmlPageDom = new DomDocument();

		@$xmlPageDom->loadHTML($item);

		$xmlPageXPath = new DOMXPath($xmlPageDom);

		return $xmlPageXPath;

	}

	$packtPage = curlGet('http://trackingshipment.net/'.$provider.'/'.$num);

	$packtPageXPath = returnXpathObject($packtPage);

	$title = $packtPageXPath->query('//article[@class="output-info"]/h3');

	$summary = $packtPageXPath->query('//article[@class="output-info"]/p');

	if($title->length > 0){

		$packtBook['title'] = trim($title->item(0)->nodeValue);
		
	}

	if($summary->length > 0){
		
		$parts = preg_split('/\t+/', $summary->item(0)->nodeValue);

		$packtBook['summary'] = $parts[0];

		$packtBook['activity'] = $parts[1];

		$packtBook['location'] = $parts[2];

		$packtBook['details'] = $parts[3];

	}

	if($summary->length > 0){
		$leng = $summary->length;
		for ($i = 2; $i < $summary->length; $i++) { 

			$breakIt = $summary->item($i)->nodeValue;
			
			$parts = preg_split('/\t+/', $breakIt);

			$packtBook['date'][$i-1] = $parts[0];

			$packtBook['info'][$i-1] = $parts[1];

			$packtBook['place'][$i-1] = $parts[2];

		}

	}

	echo $packtBook['title']."<br>";
	echo($packtBook['summary']."<br>");
	echo($packtBook['activity']."<br>");
	echo($packtBook['location']."<br>");
	echo($packtBook['details']."<br>");

	for ($i = 2; $i < $leng; $i++) { 

			
			echo $packtBook['date'][$i-1],'&#09;',$packtBook['info'][$i-1],'&#09;',$packtBook['place'][$i-1]."<br>";

		}

?>	