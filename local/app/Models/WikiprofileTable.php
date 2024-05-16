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

use Models\BookTable as Book;

/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> wikiprofile_ru string(50) optional
 * <li> wikiprofile_en string(50) optional
 * <li> book_id int optional
 * </ul>
 *
 * @package Bitrix\
 **/

class WikiprofileTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'wikiprofiles';
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
				'wikiprofile_ru',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => Loc::getMessage('_ENTITY_WIKIPROFILE_RU_FIELD'),
				]
			),
			new StringField(
				'wikiprofile_en',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 50),
						];
					},
					'title' => Loc::getMessage('_ENTITY_WIKIPROFILE_EN_FIELD'),
				]
			),
			new IntegerField(
				'book_id',
				[
					'title' => Loc::getMessage('_ENTITY_BOOK_ID_FIELD'),
				]
			),

(new Reference('BOOK',
	Book::class,
	Join::on('this.book_id', 'ref.id'))
)->configureJoinType('inner')
		];
	}
}