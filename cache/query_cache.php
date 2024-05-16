<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Data\Cache;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

// Query Cache
Loader::includeModule('iblock');

$arElements = \Bitrix\Iblock\ElementTable::getList([
	'select' => ['ID', 'NAME'],
	'filter' => ['IBLOCK_ID' => 23, 'ACTIVE' => 'Y'],
	'limit' => 5,
	'cache' => [
		'ttl' => 3600,
		'cache_joins' => true
	]
])->fetchAll();

debug($arElements);

//\Bitrix\Iblock\ElementTable::getEntity()->cleanCache();

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>