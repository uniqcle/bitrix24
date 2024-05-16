<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Models\BookTable as Books;

// получем коллекцию книг
$collection = Books::getList([
	'select' => [
		'id',
		'name',
		'publish_date'
	]
])->fetchCollection();

foreach ($collection as $key => $book) {
	debug('название '.$book->getName(). ' дата выхода:' .$book->getPublishDate());
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>