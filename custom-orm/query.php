<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php
use Bitrix\Main\Entity\Query;
use Bitrix\Main\Type;
use Models\BookTable as Books;
use Models\HospitalClientsTable as Clients;

// объект query
// запрос к кастомной таблице BookTable
//$query = new Query(Books::getEntity()); // передаем объект сущности Books
//$query->setSelect([
//        'id', 'name', 'publish_date', 'text', 'ISBN'
//]);
//$query->setFilter([
//	'=id' => 1
//]);
//$result = $query->exec();
//
//while($row = $result->fetch()){
//	debug($row);  // возвращает массив
//}



// объект query
// связь OneToMany указано на стороне класса модели Books в поле PUBLISHER
// коллекция книг
$query = new Query(Books::getEntity());
$query->setSelect([
	'id', 'name', 'publish_date', 'publisher_id', 'PUBLISHER'
]);
$result = $query->exec();
$collection = $result->fetchCollection();

foreach($collection as $key => $book){
	debug($book->getName());
	debug($book->getPublishDate());
	debug($book->getPublisher()->getName());
}




// объект query
// получаем коллекцию
$query = new Query(Clients::getEntity());
$query->setSelect([
	'id', 'first_name', 'contact_id', 'CONTACT.*'
]);
$result = $query->exec();
$collection = $result -> fetchCollection();

foreach($collection as $key => $record){
	debug($record->getFirstName());
	debug($record->getContactId());
	debug($record->getContact()->getPost());
	debug($record->getContact()->getCompanyId());
}

// обратить внимание, есть связь в модели
// виртуальное поле CONTACT которое получает запись из таблицы контактов
// где ID равен значению contact_id таблицы hospital_clients
(new Reference('CONTACT', \Bitrix\CRM\ContactTable::class,
	Join::on('this.contact_id', 'ref.ID')))
	->configureJoinType('inner')




// Объект query
// Связь непосредственно в запросе.
$query = new Query(Books::getEntity());
$query->registerRuntimeField(
	'PUBLISHER',
	[
		// тип - сущность ElementTable
		'data_type' => 'Models\PublisherTable',
		'reference' => ['=this.publisher_id' => 'ref.id'],
		'join_type' => 'INNER'
	]
);

$query->setSelect([
	'id', 'name', 'publish_date', 'publisher_id', 'PUBLISHER.name'
]);

$result = $query -> exec();

while($row = $result -> fetch()){
	debug($row);
}


?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>