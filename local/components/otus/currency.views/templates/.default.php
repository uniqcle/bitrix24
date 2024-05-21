<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo 'Валюта: ' . $arResult['CURRENCY'] . '<br>';
echo 'Курс валюты: '. round($arResult['CURRENT_BASE_RATE']);