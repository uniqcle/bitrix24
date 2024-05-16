<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

// также добавили пространства имен
use Bitrix\Main\ORM\Fields\Validator\Base,
	Bitrix\Main\ORM\Fields\Validators\RegExpValidator,
	Bitrix\Main\ORM\Fields\Relations\Reference,
	Bitrix\Main\ORM\Fields\Relations\OneToMany,
	Bitrix\Main\ORM\Fields\Relations\ManyToMany,
	Bitrix\Main\Entity\Query\Join;

use Models\WikiprofileTable as Wikiprofile;
use Models\PublisherTable as Publisher;
use Models\AuthorTable as Author;

/**
 * Class BookTable
 * @package Models
 **/

class BookTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'books';
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
					'validation' => [__CLASS__, 'validateName'],
					'title' => Loc::getMessage('_ENTITY_NAME_FIELD'),
				]
			),
			new TextField(
				'text',
				[
					'title' => Loc::getMessage('_ENTITY_TEXT_FIELD'),
				]
			),
			new DateField(
				'publish_date',
				[
					'title' => Loc::getMessage('_ENTITY_PUBLISH_DATE_FIELD'),
				]
			),
			new StringField(
				'ISBN',
				[
					'validation' => [__CLASS__, 'validateIsbn'],
					'title' => Loc::getMessage('_ENTITY_ISBN_FIELD'),
				]
			),
			new IntegerField(
				'author_id',
				[
					'title' => Loc::getMessage('_ENTITY_AUTHOR_ID_FIELD'),
				]
			),
			new IntegerField(
				'publisher_id',
				[
					'title' => Loc::getMessage('_ENTITY_PUBLISHER_ID_FIELD'),
				]
			),
			new IntegerField(
				'wikiprofile_id',
				[
					'title' => Loc::getMessage('_ENTITY_WIKIPROFILE_ID_FIELD'),
				]
			),
// один к одному
(new Reference('WIKIPROFILE',
	Wikiprofile::class,
	 Join::on('this.wikiprofile_id', 'ref.id')))
	->configureJoinType('inner'),

// один ко многим. Одна книга, много издателей
(new Reference('PUBLISHER',
	Publisher::class,
	 Join::on('this.publisher_id', 'ref.id')))
	->configureJoinType('inner'),

// один ко многим
(new ManyToMany('AUTHORS', Author::class))
	->configureTableName('book_author')

	->configureLocalPrimary('id', 'book_id')
	->configureLocalReference('BOOKS')

	->configureRemotePrimary('id', 'author_id')
	->configureRemoteReference('AUTHORS'),
		];
	}

	/**
	 * Returns validators for name field.
	 *
	 * @return array
	 */
	public static function validateName()
	{
		return [
			new LengthValidator(3, 50),
		];
	}


	/**
	 * Returns validators for ISBN field.
	 *
	 * @return array
	 */
	public static function validateIsbn()
	{
		return
			array(function($value) {
				$clean = str_replace('-', '', $value);
				if (preg_match('/[\d-]{13,}/', $clean))
				{
					return true;
				}
				else
				{
					return 'Код ISBN должен содержать 13 цифр.';
				}
			});
	}
}