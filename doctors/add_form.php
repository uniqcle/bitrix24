<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");

if(!empty($_POST)){
	debug($_POST);
}


?>


    <form method="post" name="add_form" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($request["mid"])?>&lang=<?=$request["lang"]?>">
        <input type="text" name="name" value="">
        <input type="submit" name="Update" value="Добавить доктора">
        <input type="reset" name="reset" value="Сбросить">
    </form>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>