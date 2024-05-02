<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");

use Bitrix\Main\UI\Extension;
use \Models\Lists\DoctorsPropertyValuesTable as DoctorsTable;
use \Models\Lists\ProceduresPropertyValuesTable as Procedures;

Extension::load('ui.bootstrap4');

if(!empty($_POST['name'] && $_POST['procedure'])){

    $dbResult = DoctorsTable::add([
        'NAME'=>$_POST['name'],
        'SPECIALIST'=>$_POST['specialist'],
        'PROCEDURE_ID'=>$_POST['procedure'],
    ]);

    if($dbResult)
        echo ' <div class="alert alert-success" role="alert"> Успешно добавлен. </div>';
}

function getProcedures(){
	$dbResult = Procedures::query()
		->setSelect([
			'*',
            'NAME' => 'ELEMENT.NAME'
		])
		->exec();

	while ($row = $dbResult->fetch()) {
		$procedures[] = $row;
	}

	return $procedures;
}

$procedures = getProcedures();
?>


    <form method="post" name="add_form" action="<?=$APPLICATION->GetCurPage()?>">
        <div class="form-group">
            <label for="exampleInputEmail1">ФИО</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
        </div>

        <div class="form-group">
            <label for="specialist">Специальность</label>
            <input type="text" class="form-control" id="specialist" name="specialist" aria-describedby="specialistHelp">
        </div>

        <div class="form-group">
            <label for="procedure">Example select</label>
            <select class="form-control" id="procedure" name="procedure">
                <option>Выбрать услугу</option>
                <?php foreach($procedures as $proc): ?>
                <option value="<?=$proc['IBLOCK_ELEMENT_ID'];?>"><?=$proc['NAME'];?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <br>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Добавить</button>
            <input type="reset" class="btn btn-light" name="reset" value="Сбросить">
        </div>

    </form>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>