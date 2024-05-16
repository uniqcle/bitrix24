<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Application;

// ?CACHE_ID=7
// время кеша
$cacheTime = 30*60;
// id кеша в зависимости от параметров
$cacheId = $_REQUEST['CACHE_ID'];

$cacheDir = '/';

$obCache = new CPHPCache;
$obCache->CleanDir();
// если кеш есть, и он еще не истек, то
if($obCache->InitCache($cacheTime, $cacheId, $cacheDir)){
	echo 'FROM CACHE';
	// получаем закешированные переменные
	$arResult = $obCache->GetVars();
} else {
	echo 'FROM DB';

	$arResult = [
		'REAL_MADRID' => ['1', '2', '3'],
		'FC_BAYERN' => ['4', '5', '6']
	];

	// Например здесь может быть обработка

	// начнаем буферизацию вывода
	if($obCache->StartDataCache()){
		$obCache->EndDataCache(['RESULT' => $arResult]);
	}
}



debug($arResult);

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>