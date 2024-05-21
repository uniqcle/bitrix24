<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arCurrentValues */
use Bitrix\Currency\CurrencyTable;

if (!CModule::IncludeModule("iblock"))
	return;

//// Получаем список всех валют
///  При выборке зависает
//$currencyList = CurrencyTable::getList(array(
//	'select' => array('CURRENCY', 'NUMCODE'),
//	//'filter' => array('CURRENCY' => 'EUR'),
//	'order' => ['CURRENCY' => 'ASC']
//))->fetchAll();
//
//$arCurrencyList = [];
//foreach($currencyList as $currency) {
//	//debug($currency);
//	$arCurrencyList[$currency['NUMCODE']] = $currency['CURRENCY'];
//}

$arCurrencyList = [
	933 => 'BYN',
	978 => 'EUR',
	643 => 'RUB',
	980 => 'UAH',
	840 => 'USD',
];




$arComponentParameters = array(
	"GROUPS"     => array(
		"LIST" => array(
			"NAME" => GetMessage("GRID_PARAMETERS"),
			"SORT" => "300"
		)
	),
	"PARAMETERS" => array(
		"CUR_LIST" => array(
			"PARENT" => "LIST",
			"NAME" => "Список валют",
			"TYPE" => "LIST",
			"DEFAULT" => "RUB",
			"VALUES" => $arCurrencyList,
			"ADDITIONAL_VALUES" => "Y",
		),
	)
);