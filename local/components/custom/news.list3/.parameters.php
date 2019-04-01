<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arCurrentValues */

if (!CModule::IncludeModule("iblock")) {
    return;
}

$arSorts = ["ASC" => GetMessage("T_IBLOCK_DESC_ASC"), "DESC" => GetMessage("T_IBLOCK_DESC_DESC")];
$arSortFields = [
    "ID" => GetMessage("T_IBLOCK_DESC_FID"),
    "NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
    "ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
    "SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
    "PROPERTY_RANK_NEWS" => GetMessage("T_IBLOCK_DESC_RANK")
];

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "AJAX_MODE" => [],
        "NEWS_COUNT" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("T_IBLOCK_DESC_LIST_CONT"),
            "TYPE" => "STRING",
            "DEFAULT" => "20",
        ],
        "SORT_BY" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_DESC_IBORD1"),
            "TYPE" => "LIST",
            "DEFAULT" => "ACTIVE_FROM",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_DESC_IBBY1"),
            "TYPE" => "LIST",
            "DEFAULT" => "DESC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "DETAIL_URL" => CIBlockParameters::GetPathTemplateParam(
            "DETAIL",
            "DETAIL_URL",
            GetMessage("T_IBLOCK_DESC_DETAIL_PAGE_URL"),
            "",
            "URL_TEMPLATES"
        ),
        "PREVIEW_TRUNCATE_LEN" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("T_IBLOCK_DESC_PREVIEW_TRUNCATE_LEN"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "CACHE_TIME" => ["DEFAULT" => 36000000],
    ],
];
