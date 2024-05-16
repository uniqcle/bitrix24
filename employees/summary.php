<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?>
<?php

use Models\SummaryListTable as SummaryList,
	\Bitrix\Iblock\Elements\ElementEmployeesTable as Employees,
	\Bitrix\Iblock\Elements\ElementDepartmentTable as Department;

// сводная ведомость
$list = SummaryList::getList([
	'select' => [
		'id',
		'employee_id',
		'salary',
		'department_id',
		'comment',
		'EMPLOYEE.*',
		'DEPARTMENT.*'
	],
	'cache' => array(
	      'ttl' => 3600,
	      'cache_joins' => true
	),
])->fetchCollection();

foreach ($list as $key => $employee) {

	$arItem['ID'] = $employee->getId();
	// ФИО
	$arItem['NAME'] = $employee->getEmployee()->getName();
	// Св-во дети
	$employeeProperty = Employees::getByPrimary($employee->getEmployee()->getId(), array(
		'select' => array('ID', 'NAME', 'MARRIAGE_' => 'MARRIAGE', 'CHILDREN_' => 'CHILDREN')
	))->fetch();
	$arItem['CHILDREN'] = round($employeeProperty['CHILDREN_VALUE']);
	// Зарплата
	$arItem['SALARY'] = $employee->getSalary();
	// Св-во Отдел, в каком отделе работает
	$departProperty = Department::getByPrimary($employee->getDepartmentId(), array(
		'select' => array('ID', 'NAME', 'DIRECTOR_' => 'DIRECTOR')
	))->fetch();
	$arItem['DEPARTMENT'] = $departProperty['NAME'];

	$arItem['COMMENT'] = $employee->getComment();

	$arResult[] = $arItem;
}

debug($arResult);

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>