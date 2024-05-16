<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Models\BookTable as Books;
use Models\AuthorTable as Authors;

// отношение ManyToMany (если у книги несколько авторов)
// выборка книг со стороны автора
$author = Authors::getByPrimary(2, [
	'select' => [
		'*',
		'BOOKS'
	]
])->fetchObject();

foreach ($author->getBooks() as $book){
	echo $book->getName().'<br/>';
}

// выборка авторов со сороны книги
// Одна книга - несколько авторов
$book = Books::getByPrimary(2, [
	'select' => [
		'*',
		'AUTHORS'
	]
])->fetchObject();

foreach ($book->getAuthors() as $author){
	echo ' книга: '.$book->getName().' автор: '.$author->getName().'<br/>';
}




require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>