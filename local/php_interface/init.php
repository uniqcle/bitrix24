<?php
// автолоадер проекта
include_once __DIR__ . '/../app/autoload.php';

function debug($arResult)
{
	echo '<pre>';
	print_r($arResult);
	echo '</pre>';
}