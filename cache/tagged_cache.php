<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

// Tagged Cache

// время кеша
$cacheTime = 30*60;
// id кеша в зависимости от параметров
$cacheId = $_REQUEST['CACHE_ID'];
$cacheDir = '/';

$cache = Cache::createInstance(); // Служба кеширования
$taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами

// необходим одинаковый путь в $cache->initCache() и $taggedCache->startTagCache()
$cachePath = 'mycachepath';
$myTag = 'my_awesome_tag';

// Проверяем что кеш сущестует
if($cache->initCache($cacheTime, $cacheId, $cacheDir)){
	echo "TAG_{$myTag}_FROM_CACHE";
	$vars = $cache->getVars();

} elseif ($cache->startDataCache()){
	echo "TAG_{$myTag}_FROM_DB: ";

	// начинаем тегированное кеширование
	$taggedCache->startTagCache($cachePath);
	$vars = [
		'date' => date('r'),
		'rand' => rand(0, 999) // Если данные закешированы ,данные не будут меняться
	];

	// Добавляем теги
	$taggedCache->registerTag($myTag);
	$taggedCache->registerTag('b_iblock_5');
	$taggedCache->registerTag('b_iblock_5_17');

	// Если что-то пшло не так и решили кеш не записывать
	$cacheInvalid = false;
	if($cacheInvalid){
		$taggedCache->abortTagCache();
		$cache->abortDataCache();
	}

	// Записываем кеш
	$taggedCache->endTagCache();
	$cache->endDataCache($vars);
}

// Данные будут обновляться раз в час или при обновлении ИБ
debug($vars);

// сброс
//$taggedCache = Application::getInstance()->getTaggedCache(); // служба пометки кеша тегами
//$taggedCache->clearByTag($myTag);

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>