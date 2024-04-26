<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");
?>

<?php
use Bitrix\Main\Application;

$value = Application::getInstance()->getContext()->getRequest()->getQuery("item");
debug($value);

// получение связанных моделей через registerRuntimeField
$doctor = \Models\Lists\DoctorsPropertyValuesTable::query()
	->setSelect([
		'*',
		'NAME' => 'ELEMENT.NAME',  // делаем запрос к общей таблице элементов, затем получаем название элемента
		'PROCEDURE_' => 'PROCEDURE',
	])
	->setFilter(['IBLOCK_ELEMENT_ID' => $value])
	->setOrder(['NAME' => 'desc'])
	->registerRuntimeField( // registerRuntimeField - это метод регистрирующий новое поле на время выполнения запроса
		null,
		new \Bitrix\Main\Entity\ReferenceField( // ReferenceField - это виртуальное поле, связывает модели
			'PROCEDURE',
			\Models\Lists\DoctorsProceduresPropertyValuesTable::getEntity(),
			['=this.PROCEDURE_ID' => 'ref.IBLOCK_ELEMENT_ID']
		)
	)
	->fetch();

debug($doctor);


?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>