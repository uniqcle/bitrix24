<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Application,
	Bitrix\Main\Type\DateTime,
    Bitrix\Main\Diag\Debug;

$request = Application::getInstance()->getContext()->getRequest();
$requestPage = $request->getRequestedPage();

$currentDateTime = new DateTime();
$currentDateTimeString = $currentDateTime->toString();

Debug::writeToFile($requestPage, $currentDateTimeString. "\n Запрошенная страница ", LOG_FILENAME);

?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>