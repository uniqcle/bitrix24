<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Информация по врачу");

use Bitrix\Main\Application;
use \Models\Lists\DoctorsPropertyValuesTable as Doctors;
use \Models\Lists\DoctorsProceduresPropertyValuesTable as Procedures;

$doctorID = Application::getInstance()->getContext()->getRequest()->getQuery("item");

function getProceduresByDoctorsID(int $doctorID){
	// получение связанных моделей через registerRuntimeField
	$procedures = Doctors::query()
		->setSelect([
			'*',
 			'NAME' => 'PROCEDURE.ELEMENT.NAME',
			'PRICE' => 'PROCEDURE.PRICE',
//			'PROCEDURE.ELEMENT'
		])
		->setFilter(['IBLOCK_ELEMENT_ID' => $doctorID])
		->setOrder(['NAME' => 'desc'])
		->registerRuntimeField( // registerRuntimeField - это метод регистрирующий новое поле на время выполнения запроса
			null,
			new \Bitrix\Main\Entity\ReferenceField( // ReferenceField - это виртуальное поле, связывает модели
				'PROCEDURE',
				Procedures::getEntity(),
				['=this.PROCEDURE_ID' => 'ref.IBLOCK_ELEMENT_ID']
			)
		)
		->fetch();

	return $procedures;
}

if($doctorID)
	$procedures = getProceduresByDoctorsID($doctorID);

debug($procedures);

?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>