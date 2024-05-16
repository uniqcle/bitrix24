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

$obCacheD7 = Cache::createInstance();
//$obCacheD7->clean($cacheId);
// если кеш есть, и он еще не истек, то
if($obCacheD7->initCache($cacheTime, $cacheId, $cacheDir)){
	echo 'FROM CACHE D7';
	// получаем закешированные переменные
	$arResult = $obCacheD7->GetVars();
} elseif ($obCacheD7->startDataCache()) {
	echo 'FROM DB';

	$arResult = [
		'REAL_MADRID'  ,
		'FC_BAYERN'
	];

	$obCacheD7->endDataCache($arResult);
}

debug($arResult);

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>