<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

use Models\BookTable as Books;

$res = Books::delete(15);
if(!$res->isSuccess()){
	debug($res->getErrorMessages());
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>