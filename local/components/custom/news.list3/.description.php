<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
    "NAME" => GetMessage("T_IBLOCK_DESC_LIST"),
    "DESCRIPTION" => GetMessage("T_IBLOCK_DESC_LIST_DESC"),
    "ICON" => "/images/news_list.gif",
    "SORT" => 20,
    "CACHE_PATH" => "Y",
    "PATH" => [
        "ID" => "content_task",
        "CHILD" => [
            "ID" => "news_task",
            "NAME" => GetMessage("T_IBLOCK_DESC_NEWS"),
            "SORT" => 10,
        ],
    ],
];
