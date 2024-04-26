<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle('Вывод связанных полей');

use Models\Lists\CarsPropertyValuesTable as CarsTable;

//// вывод данных по списку записей из инфоблока Автомобили
//$cars = CarsTable::getList([
//	'select'=>[
//		'ID'=>'IBLOCK_ELEMENT_ID',
//		'NAME'=>'ELEMENT.NAME',
//		'MANUFACTURER'=>'MANUFACTURER_ID'
//	]
//])->fetchAll();
//debug($cars);
//
//
//// добавление данных записей в инфоблок Автомобили
//$dbResult = CarsTable::add([
//	'NAME'=>'Toyota Corolla',
//	'MANUFACTURER_ID'=>44,
//	'CITY_ID'=>40,
//	'MODEL'=>'Corolla',
//	'ENGINE_VOLUME'=>'4',
//	'PRODUCTION_DATE'=>date('d.m.Y H:i:s'),
//]);
//var_dump($dbResult);


$cars = CarsTable::query()
	->setSelect([
		'*',
		'NAME' => 'ELEMENT.NAME',
		'MARKA_NAME' => 'CUSTOM_PROP_MARKA.ELEMENT.NAME',
		'CITY_NAME' => 'CUSTOM_PROP_CITY.ELEMENT.NAME'
	])
	->setOrder(['NAME' => 'desc'])
	->registerRuntimeField(
		null,
		new \Bitrix\Main\Entity\ReferenceField(
			'CUSTOM_PROP_MARKA',
			\Models\Lists\CarManufacturerPropertyValuesTable::getEntity(),
			['=this.MANUFACTURER_ID' => 'ref.IBLOCK_ELEMENT_ID']
		)
	)
	->registerRuntimeField(
		null,
		new \Bitrix\Main\Entity\ReferenceField(
			'CUSTOM_PROP_CITY',
			\Models\Lists\CarCityPropertyValuesTable::getEntity(),
			['=this.CITY_ID' => 'ref.IBLOCK_ELEMENT_ID']
		)
	)
	->fetchAll();

//debug($cars);


// D7

// SELECT
$arSelect = array("ID", "NAME", "PREVIEW_TEXT", "ACTIVE_FROM","PREVIEW_PICTURE");

// FILTER
$arFilter = array(
	"IBLOCK_ID" => 22, // Автомобили
	"ACTIVE" => "Y",
);

// запрос к API D7 для получения списка элементов инфоблока
$dbItems = \Bitrix\Iblock\ElementTable::getList(array(
	'select' => $arSelect,
	'filter' =>  $arFilter,
	'order' => array("ACTIVE_FROM" => 'DESC'),
	//'offset' => $offset,
	'limit' => 10,
	'count_total' => true,
));

// ELEMENTS LIST
while ($arItem = $dbItems->fetch()){
	debug($arItem);
}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

