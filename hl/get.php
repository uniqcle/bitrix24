<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?php
use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;

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
//получаем название класса (в строковом виде)  для работы с hl
$strEntityDataClass = $entity->getDataClass();

//work
// получаем название таблицы
$entityTableName = $strEntityDataClass::getTableName();
debug($entityTableName);

// Выборка данных
$rsData = $strEntityDataClass::getList(array(
	"select" => array("*"),
	"order" => array("ID" => "ASC"),
	//"filter" => array("UF_TITLE"=>'A Historic Love',)  // Задаем параметры фильтра выборки
	"filter" => array("ID"=> [5, 1],)
));
$arItems = [];
while($arItem = $rsData->fetch()){
	$arItems[] = $arItem;
}

debug($arItems);






?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>