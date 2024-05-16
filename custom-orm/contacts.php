<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?php
$APPLICATION->SetTitle('Datamanager в Битрикс');

use Bitrix\Main\Type;

use Models\Lists\CarsPropertyValuesTable as CarsTable;
use Models\HospitalClientsTable as Clients;

use Models\BookTable as Books;
use Models\PublisherTable as Publishers;
use Models\AuthorTable as Authors;
use Models\WikiprofileTable as Wikiprofiles;

// кастомная таблица и стандартная сущность Битрикс
// получение данных из hospital_clients
// получаем контакты CRM привязанные к своей таблице
$collection = Clients::getList([
	'select' => [
		'id',
		'first_name',
		'contact_id',
		'CONTACT.*'
	],
	'limit'=>3
])->fetchCollection();

foreach ($collection as $key => $record) {
	debug($record->getId().' '.$record->getFirstName().' '.$record->getContactId());
	debug($record->getContact()->getPost());
	debug($record->getContact()->getCompanyId());
	debug($record->getContact()->getTypeId());
	//debug($record->getContact()->getLastActivityTime());
}






require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>