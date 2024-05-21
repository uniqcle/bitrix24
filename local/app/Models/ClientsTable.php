<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class ListsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME string(50) optional
 * <li> UF_LASTNAME string(50) optional
 * <li> UF_PHONE string(50) optional
 * <li> UF_JOBPOSITION string(50) optional
 * <li> UF_SCORE string(50) optional
 * </ul>
 *
 * @package Bitrix\Client
 **/

class ClientsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'u_client_lists';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			new IntegerField(
				'ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => 'ID',
				]
			),
			new StringField(
				'UF_NAME',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => "Имя",
				]
			),
			new StringField(
				'UF_LASTNAME',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => "Фамилия",
				]
			),
			new StringField(
				'UF_PHONE',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => "Телефон",
				]
			),
			new StringField(
				'UF_JOBPOSITION',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => "Профессия",
				]
			),
			new StringField(
				'UF_SCORE',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => "Лояльность",
				]
			),
		];
	}
}