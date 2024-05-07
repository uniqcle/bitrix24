<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");

use Bitrix\Main\UI\Extension;
use \Models\Lists\DoctorsPropertyValuesTable as DoctorsTable;
use \Bitrix\Main\ObjectPropertyException,
	\Bitrix\Main\ArgumentException,
	\Bitrix\Main\SystemException;

Extension::load('ui.bootstrap4');

function getDoctors(): array {
    try{
        $arSelect = ['ID', 'IBLOCK_ID',
                    'NAME',
                     'SPECIALIST',
                     'PROCEDURE_ID.ELEMENT'
            ];
	    $iblockId = 23;
	    $iblock = \Bitrix\Iblock\Iblock::wakeUp($iblockId);
	    $doctors = $iblock->getEntityDataClass()::getList(array(
		    'select' => $arSelect,
		    'filter' =>  ["ACTIVE" => "Y"],
		    'order' => array("ID" => 'ASC'),
		    //'offset' => $offset,
		    'limit' => 20,
		    'count_total' => true,
	    ))->fetchCollection();

	    $arResult = [];

	    foreach($doctors as $doctor){
		    $arResult[$doctor->getId()]['ID'] = $doctor->getId();
	        $arResult[$doctor->getId()]['NAME'] = $doctor->getName();
		    $arResult[$doctor->getId()]['SPECIALIST'] = $doctor->getSpecialist()->getValue();

	        foreach($doctor->getProcedureId()->getAll() as $procedure):
                 $arResult[$doctor->getId()]['PROCEDURE'][] = $procedure->getElement()->getName();
             endforeach;
        }

	    return $arResult;

    } catch ( ObjectPropertyException | ArgumentException | SystemException $e){
	    $errorMsg = $e -> getMessage();
	    debug($errorMsg);
    }
}

$doctors = getDoctors();

?>

<div>
    <div class="row">
        <div class="col-md-10">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus alias cum, cumque dolorem doloremque eum expedita, facere harum libero magnam maiores nisi non pariatur quibusdam rem tenetur. Nemo, possimus?
        </div>
        <div class="col-md-2">
            <a href="add_form.php" class="btn btn-primary">Добавить врача</a>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Профессия</th>
                <th scope="col">Процедура</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($doctors as $doctor): ?>
            <tr>
                <th scope="row"><?=$doctor['ID'];?></th>
                <td>
                    <a href="/doctors/item.php?item=<?=$doctor['ID'];?>">
                        <?=$doctor['NAME'];?>
                    </a>
                </td>
                <td><?=$doctor['SPECIALIST'];?></td>
                <td>
                    <?php foreach($doctor['PROCEDURE'] as $procedure): ?>
                        <?=$procedure;?>,
                    <?php endforeach; ?>
                </td>

            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>













<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>

