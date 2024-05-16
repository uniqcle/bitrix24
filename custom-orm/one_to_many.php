<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Models\BookTable as Books;
use Models\PublisherTable as Publishers;
//////////////////////////////////////
// отношение OneToMany
//////////////////////////////////////

// Одна книга много издателей
// получем коллекцию книг и издателей
$collection = Books::getList([
	'select' => [
		'id',
		'name',
		'publish_date',
		'publisher_id',
		'PUBLISHER'
	]
])->fetchCollection();

foreach ($collection as $key => $book) {
	debug('название '.$book->getName().
		' дата выхода:' .$book->getPublishDate().
		' издатель:'.$book->getPublisher()->getName()
	);
}

// Один издатель и много книг по нему
// Один издателя и книги по нему
$publisher = Publishers::getByPrimary(1, [
	'select' => [
		'*',
		'BOOKS'
	]
])->fetchObject();

foreach ($publisher->getBooks() as $book){
	echo $book->getName();
}








require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>