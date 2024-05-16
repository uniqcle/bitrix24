<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

use Bitrix\Main\ORM\Fields\Relations\Reference,
	Bitrix\Main\ORM\Fields\Relations\OneToMany,
	Bitrix\Main\ORM\Fields\Relations\ManyToMany,
	Bitrix\Main\Entity\Query\Join;

use Models\BookTable as Books;

/**
 * Class PublisherTable
 * @package Models
 **/

class PublisherTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'publishers';
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
				'id',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('_ENTITY_ID_FIELD'),
				]
			),
			new StringField(
				'name',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => Loc::getMessage('_ENTITY_NAME_FIELD'),
				]
			),
// Один издатель много книг
(new OneToMany('BOOKS',
	Books::class,
	'PUBLISHER')
)->configureJoinType('inner')
		];
	}
}