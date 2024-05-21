<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?php

use Bitrix\Currency\CurrencyTable;

if (!CModule::IncludeModule("iblock"))
	return;


//// Получаем список всех валют
$currencyList = CurrencyTable::getList(array(
	'select' => array('CURRENCY', 'NUMCODE'),
	//'filter' => array('CURRENCY' => 'EUR'),
	'order' => ['CURRENCY' => 'ASC']
))->fetchAll();

$arCurrencyList = [];
//foreach($currencyList as $currency) {
//	//debug($currency);
//	$arCurrencyList[$currency['NUMCODE']] = $currency['CURRENCY'];
//}
//
//if(is_array($arCurrencyList)){
//	debug($arCurrencyList);
//}

$arCurrencyList = [
	933 => 'BYN',
	978 => 'EUR',
	643 => 'RUB',
	980 => 'UAH',
	840 => 'USD',
];

debug($arCurrencyList);




?>

<?$APPLICATION->IncludeComponent(
	"otus:currency.views",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>