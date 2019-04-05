<?

use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Loader,
    Bitrix\Iblock,
    Bitrix\Main\Localization;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class NewsCustomComponent extends CBitrixComponent
{
    private $res;
    private $navComponentObject;
    private $iBlock;
    private $arImgId = [];
    private $arUsersId = [];
    private $arUsers = [];
    private $arImg = [];

    protected function checkRequiredModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new Main\SystemException(Localization\Loc::getMessage("MODULE_NOT_INSTALLED"));
        }
    }

    private function onPrepareComponentParams2()
    {
        if (!isset($this->arParams["CACHE_TIME"])) {
            $this->arParams["CACHE_TIME"] = 36000000;
        }
        if ($_GET["sort"] == "RANK_NEWS_ASC") {
            $this->arParams["SORT_ORDER"] = "ASC";
        }
        if ($_GET["sort"] == "RANK_NEWS_DESC") {
            $this->arParams["SORT_ORDER"] = "DESC";
        }
        $this->arParams["SORT_BY"] = trim($this->arParams["SORT_BY"]);
        if (strlen($this->arParams["SORT_BY"]) <= 0) {
            $this->arParams["SORT_BY"] = "ACTIVE_FROM";
        }
        switch ($_GET["sort"]) {
            case "RANK_THREE":
                $this->arParams["SORT_VAR"] = 3;
                break;
            case "RANK_FIVE":
                $this->arParams["SORT_VAR"] = 5;
                break;
            case "RANK_TEN":
                $this->arParams["SORT_VAR"] = 10;
                break;
            default:
                $this->arParams["SORT_VAR"] = 0;
                break;
        }
    }

    private function raiting()
    {
        if ($_GET["VOTE"] == "PLUS") {
            $flag = false;
            $res = CIBlockElement::GetByID($_GET["ITEM_ID"]);
            if ($obRes = $res->GetNextElement()) {
                $ar_res = $obRes->GetProperty("RANK_USERS");
            }
            foreach ($ar_res["VALUE"] as $item) {
                if ($_GET["USER_ID"] == $item) {
                    $flag = true;
                    break;
                }
            }
            if (!$flag) {
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    ["RANK_NEWS" => $_GET["RANK_VALUE"] + 1]);
                $ar_res["VALUE"][] = $_GET["USER_ID"];
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    ["RANK_USERS" => $ar_res["VALUE"]]);
            }
        }
        if ($_GET["VOTE"] == "MINUS") {
            $flag = false;
            $res = CIBlockElement::GetByID($_GET["ITEM_ID"]);
            if ($obRes = $res->GetNextElement()) {
                $ar_res = $obRes->GetProperty("RANK_USERS");
            }
            foreach ($ar_res["VALUE"] as $item) {
                if ($_GET["USER_ID"] == $item) {
                    $flag = true;
                    break;
                }
            }
            if (!$flag) {
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    ["RANK_NEWS" => $_GET["RANK_VALUE"] - 1]);
                $ar_res["VALUE"][] = $_GET["USER_ID"];
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    ["RANK_USERS" => $ar_res["VALUE"]]);
            }
        }
    }

    private function getElements()
    {
        $arSelect = [];
        $this->iBlock = [];

        $rsIblock = CIBlock::GetList(["SORT" => "ASC"], ["SITE_ID" => $_REQUEST["site"], "TYPE" => "news"]);
        while ($arRes = $rsIblock->Fetch()) {
            $this->iBlock[$arRes["CODE"]] = $arRes["ID"];
        }

        $arSort = [
            $this->arParams["SORT_BY"] => $this->arParams["SORT_ORDER"],
        ];

        $arFilter = [
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => $this->iBlock["news"],
            "ACTIVE" => "Y",
            ">=PROPERTY_RANK_NEWS" => $this->arParams["SORT_VAR"],
        ];
        $this->res = CIBlockElement::GetList($arSort, $arFilter, false,
            ["nPageSize" => $this->arParams["NEWS_COUNT"]], $arSelect);
        $this->res->SetUrlTemplates($this->arParams["DETAIL_URL"], "", $this->arParams["IBLOCK_URL"]);
    }

    private function getElementsForResult($string)
    {
        $res = CFile::GetList([], ["@ID" => $this->arImgId]);
        while ($res_arr = $res->GetNext()) {
            $this->arImg[$res_arr["ID"]] = "/upload/" . $res_arr["SUBDIR"] . "/" . $res_arr["FILE_NAME"];
        }
        $rsUsers = CUser::GetList(($by = "login"), ($order = "asc"), ["ID" => $string], ["ID", "LOGIN"]);
        while ($res_arr2 = $rsUsers->GetNext()) {
            $this->arUsers[$res_arr2["ID"]] = $res_arr2["LOGIN"];
        }
    }

    private function onPrepareComponentResult()
    {
        $obParser = new CTextParser;
        while ($obElement = $this->res->GetNextElement()) {

            $arItem = $obElement->GetFields();

            if ($arItem["RANK_NEWS"] == null) {
                $arItem["RANK_NEWS"] = 0;
            }
            if ($this->arParams["PREVIEW_TRUNCATE_LEN"] > 0) {
                $arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"],
                    $this->arParams["PREVIEW_TRUNCATE_LEN"]);
            }

            $this->arImgId[$arItem["ID"]] = $arItem["PREVIEW_PICTURE"];
            $this->arUsersId[$arItem["ID"]] = $arItem["CREATED_BY"];

            $arResult["ITEMS"][$arItem["ID"]] = $arItem;
            $arResult["ELEMENTS"][] = $arItem["ID"];
        }

        if ($arResult["ITEMS"]) {
            $string = "";
            foreach ($this->arUsersId as $value) {
                $string .= $value . " | ";
            }
            $this->getElementsForResult($string);
            foreach ($arResult["ITEMS"] as $item) {
                $arResult["ITEMS"][$item["ID"]]["CREATED_BY_LOGIN"] = $this->arUsers[$this->arUsersId[$item["ID"]]];
                $arResult["ITEMS"][$item["ID"]]["PREVIEW_PICTURE"] = $this->arImg[$this->arImgId[$item["ID"]]];
            }
        }

        $navComponentParameters = [];
        $arResult["SORT_VAR"] = $this->arParams["SORT_VAR"];
        $arResult["NAV_STRING"] = $this->res->GetPageNavStringEx(
            $this->navComponentObject,
            $this->arParams["PAGER_TITLE"],
            $this->arParams["PAGER_TEMPLATE"],
            $this->arParams["PAGER_SHOW_ALWAYS"],
            $this,
            $navComponentParameters
        );
        return $arResult;
    }

    public function executeComponent()
    {
        try {
            $this->checkRequiredModules();
        } catch (Exception $e) {
        }
        $this->onPrepareComponentParams2();
        $this->raiting();
        $this->getElements();
        $this->arResult = array_merge($this->arResult, $this->onPrepareComponentResult());
        $this->includeComponentTemplate();
    }
}
