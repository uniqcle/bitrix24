<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php

//$APPLICATION->IncludeComponent(
//	'bitrix:crm.interface.toolbar',
//	'title',
//	[
//		'TOOLBAR_ID' => 'CLIENT_VIEW',
//		'BUTTONS' => [
//			[
//				'TEXT' => 'test',
//				'TITLE' => 'test',
//				'LINK' => '/test/',
//				'ICON' => 'btn-export'
//			]
//		]
//	]
//);



\Bitrix\Main\Loader::includeModule('ui');
$linkButton = new \Bitrix\UI\Buttons\Button([
    "link" => "/test/",
    "text" => "Home"
]);
\Bitrix\UI\Toolbar\Facade\Toolbar::addButton($linkButton);



//либо можно сразу передавать массив. На основне него будет создан
\Bitrix\UI\Toolbar\Facade\Toolbar::addButton([
	"link" => "/test/",
	"text" => "Home",
]);




?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>