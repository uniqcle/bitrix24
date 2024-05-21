<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

use Bitrix\Main\ORM\Fields\Validators\RegExpValidator,
	Bitrix\Main\ORM\Fields\Relations\Reference,
	Bitrix\Main\ORM\Fields\Relations\OneToMany,
	Bitrix\Main\Entity\Query\Join;

/**
 * Class ClientsTable
 **/

class CustomTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'u_custom_table';
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
					'title' => Loc::getMessage('CLIENTS_ENTITY_ID_FIELD'),
				]
			),
			new StringField(
				'NAME',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => Loc::getMessage('CLIENTS_ENTITY_FIRST_NAME_FIELD'),
				]
			),
			new IntegerField(
				'AGE',
				[
					'title' => Loc::getMessage('CLIENTS_ENTITY_AGE_FIELD'),
				]
			),

		];
	}
}