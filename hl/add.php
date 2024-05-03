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

//add
$arElementFields = array(
        'UF_AUTHOR' => [1],
        'UF_TITLE' => 'lorem ipsum',
        'UF_YEAR' => 2024
);

$objResult = $strEntityDataClass::add($arElementFields);
$ID = $objResult->getID();
$bSuccess = $objResult -> isSuccess();

if($bSuccess){
	echo "HighloadBlock Element {$ID} added!";
} else {
	$arErrors = $objResult->getErrorMessages();
	foreach($arErrors as $err):
		echo "Error " . $err . "<br>";
	endforeach;
}

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>