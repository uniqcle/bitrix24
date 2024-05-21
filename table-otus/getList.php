<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Models\ClientsTable as Clients;

$limit = 1;
$page = 1;
$offset = $limit * ($page-1);

// 1. вариант
//$data = Clients::getList([
//	'select' => [
//		'ID',
//		'UF_NAME',
//		'UF_LASTNAME',
//		'UF_PHONE',
//		'UF_JOBPOSITION',
//		'UF_SCORE'
//	],
//	'order' => [
//		'ID' => 'ASC'
//	],
//	'limit' => $limit,
//	'offset' =>$offset
//
//])->fetchAll();
//
//foreach ($data as $key => $item) {
//	debug($item);
//}

// 2 вариант
$data = Clients::getList([
	'select' => [
		'ID',
		'UF_NAME',
		'UF_LASTNAME',
		'UF_PHONE',
		'UF_JOBPOSITION',
		'UF_SCORE'
	],
	'order' => [
		'ID' => 'ASC'
	],
	'limit' => $limit,
	'offset' =>$offset

]);

while ($item = $data->fetch()) {
	debug($item);
}



?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>