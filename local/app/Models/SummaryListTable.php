<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

use \Bitrix\Iblock\Elements\ElementEmployeesTable as Employees,
	\Bitrix\Iblock\Elements\ElementDepartmentTable as Department;

use Bitrix\Main\ORM\Fields\Relations\Reference,
	Bitrix\Main\ORM\Fields\Relations\OneToMany,
	Bitrix\Main\Entity\Query\Join;

/**
 * Class ListTable
 *
 * @package Bitrix\List
 **/

class SummaryListTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'summary_list';
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
					'title' => Loc::getMessage('LIST_ENTITY_ID_FIELD'),
				]
			),
			new IntegerField(
				'employee_id',
				[
					'title' => Loc::getMessage('LIST_ENTITY_EMPLOYEE_ID_FIELD'),
				]
			),
			new IntegerField(
				'salary',
				[
					'title' => Loc::getMessage('LIST_ENTITY_SALARY_FIELD'),
				]
			),
			new IntegerField(
				'department_id',
				[
					'title' => Loc::getMessage('LIST_ENTITY_DEPARTMENT_ID_FIELD'),
				]
			),
			new StringField(
				'comment',
				[
					'validation' => function()
					{
						return[
							new LengthValidator(null, 250),
						];
					},
					'title' => Loc::getMessage('LIST_ENTITY_COMMENT_FIELD'),
				]
			),

			(new Reference('EMPLOYEE',
				Employees::class,
				Join::on('this.employee_id', 'ref.ID'))
			)->configureJoinType('inner'),

			(new Reference('DEPARTMENT',
				Department::class,
				Join::on('this.department_id', 'ref.ID'))
			)->configureJoinType('inner'),

		];
	}
}