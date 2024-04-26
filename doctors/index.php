<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Врачи");

use Bitrix\Main\UI\Extension;
use \Models\Lists\DoctorsPropertyValuesTable as DoctorsTable;

Extension::load('ui.bootstrap4');

$doctors = DoctorsTable::query()
    ->setSelect([
            '*',
            'NAME' => 'ELEMENT.NAME',
            'PROFESSION' => 'SPECIALIST',
            'PROCEDURE' => 'CUSTOM_PROP_PROCEDURE.ELEMENT.NAME',
            'PRICE' => 'CUSTOM_PROP_PROCEDURE.PRICE'
    ])
    ->setOrder(['NAME' => 'desc'])
    ->registerRuntimeField(
            null,
            new \Bitrix\Main\Entity\ReferenceField(
                    'CUSTOM_PROP_PROCEDURE',
                    \Models\Lists\DoctorsProceduresPropertyValuesTable::getEntity(),
                    ['=this.PROCEDURE_ID' => 'ref.IBLOCK_ELEMENT_ID']
            )
    )
    ->fetchAll();

//debug($doctors);

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
                <th scope="col">Цена</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($doctors as $doctor): ?>
            <tr>
                <th scope="row"><?=$doctor['IBLOCK_ELEMENT_ID'];?></th>
                <td>
                    <a href="/doctors/item.php?item=<?=$doctor['IBLOCK_ELEMENT_ID'];?>">
                        <?=$doctor['NAME'];?>
                    </a>
                </td>
                <td><?=$doctor['PROFESSION'];?></td>
                <td><?=$doctor['PROCEDURE'];?></td>
                <td><?=$doctor['PRICE'];?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>













<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>

