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
     	  
		$cacheId = __FILE__;
     	    
		$cache = Bitrix\Main\Data\Cache::createInstance();

		if ($cache->initCache($this->arParams["CACHE_TIME"], $cacheId, "test"))
		{
			$res = $cache->getVars();
			$this->arResult = $res;
		}
		elseif ($cache->startDataCache()) 
		{ 
			$this->arResult = array(); 	 
			$res = FilmsTable::GetList()->fetchAll(); 
			$this->arResult = $res; 
			if ($isInvalid) 
			{ 
				$cache->abortDataCache(); 
			} 
			$cache->endDataCache($res); 
		}
		$this->includeComponentTemplate();
    }
};