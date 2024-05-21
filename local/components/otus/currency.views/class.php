<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Context,
	Bitrix\Main\Application,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Engine\Contract\Controllerable,
	Bitrix\Iblock;
use Bitrix\Currency\CurrencyTable;


class CurrencyViewsComponent extends \CBitrixComponent
{
	protected $request;

	/**
	 * Подготовка параметров компонента
	 * @param $arParams
	 * @return mixed
	 */
	public function onPrepareComponentParams($arParams) {
		// тут пишем логику обработки параметров, дополнение к параметрам по умолчанию
		return $arParams;
	}

	/**
	 * Проверка наличия модулей требуемых для работы компонента
	 * @return bool
	 * @throws Exception
	 */
	private function checkModules()
	{
		if(!Loader::includeModule('currency')){
			throw new \Exception("Модуль валют не установлен");
		}
		return true;
	}

	private function getList()
	{
		//debug($this->arParams);

		// Получаем список всех валют
		return CurrencyTable::getList(array(
			'select' => array('CURRENCY', 'CURRENT_BASE_RATE'),
			'filter' => array('NUMCODE' => $this->arParams['CUR_LIST']),
			'order' => ['CURRENCY' => 'ASC']
		))->fetch();
	}


	public function executeComponent(){
		try{
			// $this->checkModules(); // проверяем подключение модулей

			// получаем параметры методов GET и POST, из обьекта request который позволяет получить данные о текущем запросе: метод и протокол, запрошенный URL, переданные параметры
			//$this->request = Application::getInstance()->getContext()->getRequest();

			$this->arResult = $this->getList();

			$this->IncludeComponentTemplate();

		} catch(\Bitrix\Main\SystemException $e){
			ShowError(($e->getMessage()));
		}
	}



}