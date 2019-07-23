<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?php
use \Bitrix\Main\Localization\Loc;
?>
<p><?php echo ($arResult["SUCCESS_RES"] ? (Loc::getMessage("my.test_ADD_SUCCESS")) : (Loc::getMessage("my.test_ADD_FAIL"))); ?></p>