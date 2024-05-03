<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity\Query;

Loader::includeModule("highloadblock");

// Получение id highload-блока
$dbHL = HL\HighloadBlockTable::getList(['filter' => ['NAME' => 'MusicAlbum']]);
if ($arItem = $dbHL->Fetch()) {
	//ID highloadblock блока, к которому будет делать запросы.
	$hlBlockId = $arItem['ID'];
}

// initialize
//определяем объект hl-блока, наша таблица hl блока
$hlBlockObject = HL\HighloadBlockTable::getById($hlBlockId)->fetch();
//сгенерируме сущность hl, которая позволит использовать класс для работы с hl
$entity = HL\HighloadBlockTable::compileEntity($hlBlockObject);

$arRandItems = [];
$arFilter = [];

$q = new Query($entity);
$q->setSelect(array('*'));
$q->setFilter($arFilter);
$q->setLimit(5);
$q->registerRuntimeField(
	'RAND', array('data_type' => 'float', 'expression' => array('RAND()'))
);
$q->addOrder("RAND", "ASC");
$result = $q->exec();

while ($arItem = $result->Fetch()) {
	$arRandItems[] = $arItem;
}

debug($arRandItems);


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>