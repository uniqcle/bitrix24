<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>


<?$APPLICATION->IncludeComponent(
	"otus:table.views", 
	"list", 
	array(
		"NUM_PAGE" => "20",
		"SHOW_CHECKBOXES" => "N",
		"COMPONENT_TEMPLATE" => "list"
	),
	false
);?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>