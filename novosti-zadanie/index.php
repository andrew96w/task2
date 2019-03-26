<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список новостей");
?><?$APPLICATION->IncludeComponent(
	"custom:news.list3", 
	"news", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "news",
		"DETAIL_URL" => "element.php?ELEMENT_ID=#ELEMENT_ID#",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"NEWS_COUNT" => "20",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SORT_BY1" => "PROPERTY_RANK_NEWS2",
		"SORT_ORDER1" => "DESC"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>