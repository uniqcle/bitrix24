<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Models\BookTable as Books;
use Models\WikiprofileTable as Wikiprofiles;

// отношение OneToOne
// выборка википрофиля со сороны книги
$book = Books::getByPrimary(3, [
	'select' => [
		'*',
		'WIKIPROFILE'
	]
])->fetchObject();

debug($book->getWikiprofile()->getWikiprofileRu());


/// Аналогично и из таблицы Wiki
$wikiprofile = Wikiprofiles::getByPrimary(3, [
	'select' => [
		'*',
		'BOOK'
	]
]) ->fetchObject();

debug($wikiprofile->getWikiprofileRu());
debug($wikiprofile->getBook()->getName());
debug($wikiprofile->getBook()->getPublishDate()->format("Y-m-d"));




require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>