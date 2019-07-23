<?php include $_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"; ?>
<?php $APPLICATION->SetTitle("Тест"); ?>

<?php
$APPLICATION->IncludeComponent(
	"my:test.add", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
	),
	false
);
?>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"; ?>