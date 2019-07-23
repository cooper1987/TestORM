<?
include_once(dirname(__DIR__).'/lib/main.php');

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\EventManager;
use \My\Test\Main;
Loc::loadMessages(__FILE__);
Class my_test extends CModule
{
	var $MODULE_ID = 'my.test';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';
	
	function __construct()
	{
		$arModuleVersion = array();
		include(__DIR__."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = Loc::getMessage("my.test_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("my.test_MODULE_DESC");
		
		$this->PARTNER_NAME = Loc::getMessage("my.test_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("my.test_PARTNER_URI");
	}
	
	
	function InstallFiles($arParams = array())
	{
		CopyDirFiles(Main::GetPatch()."/install/components/my", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/my", true, true);
		return true;
	}
	
	function InstallDB()
	{
	\Bitrix\Main\Application::getConnection()->queryExecute("CREATE TABLE IF NOT EXISTS `films_test`(
		`ID` int NOT NULL AUTO_INCREMENT,
		`NAME` varchar(255) NOT NULL,
		`DATE_INSERT` datetime NOT NULL,
		PRIMARY KEY(`ID`))"
		);
	}
	
	function InstallEvents()
	{
		EventManager::getInstance()->registerEventHandler(Main::MODULE_ID, '\My\Test\Films::OnBeforeAdd', Main::MODULE_ID, '\My\Test\Event', 'event');
		return true;
	}
	
	function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/components/my");
		return true;
	}
	
	function UnInstallDB()
	{
		\Bitrix\Main\Application::getConnection()->queryExecute("DROP TABLE IF EXISTS films_test");
	}
	
	function UnInstallEvents()
	{
		EventManager::getInstance()->unRegisterEventHandler(Main::MODULE_ID, '\My\Test\Films::OnBeforeAdd', Main::MODULE_ID, '\My\Test\Event', 'event');
		return true;
	}
	
	function DoInstall()
	{
		global $APPLICATION;
		if(Main::isVersionD7())
		{
			$this->InstallFiles();
			$this->InstallDB();
			$this->InstallEvents();
			RegisterModule(Main::MODULE_ID);
		}
		else
		{
			$APPLICATION->ThrowException(Loc::getMessage("my.test_INSTALL_ERROR_VERSION"));
		}
		$APPLICATION->IncludeAdminFile(Loc::getMessage("my.test_INSTALL_TITLE"), Main::GetPatch()."/install/step.php");
	}
	
	function DoUninstall()
	{
	UnRegisterModule(Main::MODULE_ID);
	$this->UnInstallEvents();
	$this->UnInstallDB();
	$this->UnInstallFiles();
	}
}
?>