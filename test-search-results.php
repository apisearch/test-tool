#!/usr/bin/env php
<?php

function pad($string, $len = 63, $type = STR_PAD_RIGHT) {
	return str_pad($string, strlen($string) - mb_strlen($string, 'UTF-8') + $len, ' ', $type);
}

function shorten($string) {
	if (mb_strlen($string) >= 61) {
		return mb_substr($string, 0, 59). "...";
	}

	return $string;
}

function search($query) {
	//$endpoint = 'https://apisearch.ludekvesely.cz/api/v1/search/AVokY5XSWN8ka9g8mJUe/';
	$endpoint = 'http://localhost:8080/api/v1/search/AVofhwGxbRvDfPc_IThJ/';

	$url = $endpoint . urlencode($query);

	$timeStart = microtime(true);
	$raw = file_get_contents($url);
	$miliseconds = number_format((microtime(true) - $timeStart) * 1000, 0, ',', ' ');
	$products = json_decode($raw, true)['products'] ?? [];

	echo "+-----------------------------------------------------------------+\n";
	echo "| query: \033[94m" . pad("'" . $query . "'", 47) . "\033[0m " . pad($miliseconds . ' ms', 8, STR_PAD_LEFT) . " |\n";
	echo "+-----------------------------------------------------------------+\n";

	if (count($products)) {
		foreach(array_slice($products, 0, 4) as $product) {
			echo "| " . pad(shorten($product['name'])) . " |\n";
		}
	} else {
		echo "| --- not found ---                                               |\n";
	}

	echo "+-----------------------------------------------------------------+\n";
	echo "\n";
}

search('Matrace Sofia');
search('matrace');
search('matrací');
search('matra');
search('matrace ma');
search('matrXce');
search('polička šedá');
search('lednička');

