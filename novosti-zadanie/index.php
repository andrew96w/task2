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
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "news",
		"DETAIL_URL" => "element.php?ELEMENT_ID=#ELEMENT_ID#",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TEMPLATE" => "newtemp",
		"DISPLAY_PICTURE" => "Y",
		"NEWS_COUNT" => "5",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SORT_BY1" => "PROPERTY_RANK_NEWS",
		"SORT_ORDER1" => "DESC",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"SORT_BY" => "PROPERTY_RANK_NEWS",
		"SORT_ORDER" => "DESC",
		"IBLOCKS_ID" => "Новости",
		"IBLOCK_CODE" => "news"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>