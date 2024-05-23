<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>

<?php

\Bitrix\Main\Loader::includeModule('ui');
$linkButton = new \Bitrix\UI\Buttons\Button([
	"link" => "/excel/?template=excel",
	"text" => "Выгрузить в Excel"
]);
\Bitrix\UI\Toolbar\Facade\Toolbar::addButton($linkButton);





?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>