<?php
namespace My\Test;

use Bitrix\Main\Entity;
use Bitrix\Main\Entity\DatetimeField;

class FilmsTable extends Entity\DataManager
{
	public static function getTableName()
   {
		return 'films_test';
   }

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true
			)),
			new Entity\StringField('NAME'),
			new Entity\DatetimeField('DATE_INSERT', array(
				'default_value' => new \Bitrix\Main\Type\DateTime(),
			)),
		);
	}
}