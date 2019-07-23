<?php
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Entity;
use \Bitrix\Main\Type;
use \My\Test\FilmsTable;


class TestList extends CBitrixComponent
{
	protected function checkModules()
	{
		if (!Main\Loader::includeModule('my.test'))
			throw new Main\LoaderException(Loc::getMessage('my.test_MODULE_NOT_INSTALLED'));
	}

	public function executeComponent()
	{
		$this -> checkModules();

		$titlesList = array("Матрица", "Назад в будущее", "Криминальное чтиво");
  	  
		$this->arResult["SUCCESS_RES"] = true;
  
		foreach($titlesList as $title) {
			$res = FilmsTable::add(array(
				'NAME' => $title,
			));
			if(!$res->isSuccess()) {
				$this->arResult["SUCCESS_RES"] = false;
			}
		}
		$this->includeComponentTemplate();
	}
}
?>