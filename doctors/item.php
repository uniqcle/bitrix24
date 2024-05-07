<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Application;
use \Bitrix\Main\ObjectPropertyException,
	\Bitrix\Main\ArgumentException,
	\Bitrix\Main\SystemException;
//use \Models\Lists\DoctorsPropertyValuesTable as Doctors;
//use \Models\Lists\DoctorsProceduresPropertyValuesTable as Procedures;

$doctorID = Application::getInstance()->getContext()->getRequest()->getQuery("item");

Extension::load('ui.bootstrap4');

function getDoctor(int $doctorID): array{
		$arSelect = ['ID', 'IBLOCK_ID',
		             'NAME',
		             'SPECIALIST',
		             'PROCEDURE_ID.ELEMENT'
		];
		$iblockId = 23;
		$iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
		$doctors = $iblock->getEntityDataClass()::getList(array(
			'select' => $arSelect,
			'filter' =>  ["ID" => $doctorID],
			'order' => array("ID" => 'ASC'),
			//'offset' => $offset,
			'limit' => 20,
			'count_total' => true,
		))->fetchCollection();

		$arResult = [];

		foreach($doctors as $doctor){
			$arResult['ID'] = $doctor->getId();
			$arResult['NAME'] = $doctor->getName();
			$arResult['SPECIALIST'] = $doctor->getSpecialist()->getValue();

			foreach($doctor->getProcedureId()->getAll() as $procedure):
				$arResult['PROCEDURE'][] = $procedure->getElement()->getId();
			endforeach;
		}
		return $arResult;
}

function getProcedures(array $doctor): array {
	$arResult = [];

	foreach($doctor['PROCEDURE'] as $procedureID){

		$arSelect = array("ID", 'IBLOCK_ID',
		                  "NAME", "PRICE"
		);

		$procedures = \Bitrix\Iblock\Elements\ElementProceduresTable::getList(array(
			'select' => $arSelect,
			'filter' =>  ["ID" => $procedureID],
			'order' => array("ACTIVE_FROM" => 'DESC'),
			//'offset' => $offset,
			'limit' => 10,
			'count_total' => true,
		))->fetchObject();

		$arResult[$procedures->getId()]  = $procedures->getName();
	}
	return $arResult;

}

$doctor = getDoctor($doctorID);
$procedures = getProcedures($doctor);
?>

<div class="container">
	<h1><?=$doctor['NAME'];?></h1>
	<h2><?=$doctor['SPECIALIST'];?></h2>

	<?php if($procedures):?>
		<ul>
			<?php foreach($procedures as $pr): ?>
			<li><?=$pr;?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>