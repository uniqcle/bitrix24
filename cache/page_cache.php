<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
// FOR HTML CACHE

// время кеша
$cacheTime = 30*60;
// id кеша в зависимости от параметров
$cacheId = $_REQUEST['CACHE_ID'];
$cacheDir = '/';


// PageCache
$obCache = new CPageCache;
//$obCache->CleanDir();
if($obCache->StartDataCache($cacheTime, $cacheId, $cacheDir)){
	echo "<div style='background: red; width: 100px; height: 100px; '>Hello, HTML Cache!</div>";
	$obCache->EndDataCache();
}


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>