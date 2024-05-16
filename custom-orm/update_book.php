<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Bitrix\Main\Type;
use Models\BookTable as Books;

// обновление записи в таблицу books
$record = [
	'name'=>'Жизнь замечательного человека 2',
	'publish_date' => new Type\Date('1988-09-17', 'Y-m-d'),
	'ISBN' =>'1234567891223'
];
$res = Books::update(7, $record);

if(!$res->isSuccess()){
	debug($res->getErrorMessages());
}




require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>