<?php include $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"; ?>
<?php $APPLICATION->SetTitle("Тест"); ?>

<?php
$APPLICATION->IncludeComponent(
	"my:test.list", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);
?>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"; ?>