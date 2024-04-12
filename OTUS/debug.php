<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Application,
    Bitrix\Main\Diag\Debug;

$request = Application::getInstance()->getContext()->getRequest();
$requestPage = $request->getRequestedPage();

Debug::writeToFile($requestPage, 'Запрошенная страница: ', LOG_FILENAME);

?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>