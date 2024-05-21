<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Валюты");
?><?$APPLICATION->IncludeComponent(
	"otus:currency.views", 
	".default.php", 
	array(
		"CUR_LIST" => "978",
		"COMPONENT_TEMPLATE" => ".default.php"
	),
	false
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>