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

//update
$arItem['ID'] = 5;
$objResult = $strEntityDataClass::update($arItem['ID'], ['UF_YEAR' => 2025]);

$ID = $objResult->getID();
$bSuccess = $objResult -> isSuccess();

if($bSuccess){
	echo "HighloadBlock Element {$ID} was updated!";
} else {
	$arErrors = $objResult->getErrorMessages();
	foreach($arErrors as $err):
		echo "Error " . $err . "<br>";
	endforeach;
}


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>