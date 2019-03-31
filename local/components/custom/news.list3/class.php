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
    public $arUsers = array();

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
            $this->arParams["SORT_ORDER1"] = "ASC";
        }
        if ($_GET["sort"] == "RANK_NEWS_DESC") {
            $this->arParams["SORT_ORDER1"] = "DESC";
        }
        $this->arParams["SORT_BY1"] = trim($this->arParams["SORT_BY1"]);
        if (strlen($this->arParams["SORT_BY1"]) <= 0) {
            $this->arParams["SORT_BY1"] = "ACTIVE_FROM";
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
                    array("RANK_NEWS2" => $_GET["RANK_VALUE"] + 1));
                $ar_res["VALUE"][] = $_GET["USER_ID"];
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    array("RANK_USERS" => $ar_res["VALUE"]));
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
                    array("RANK_NEWS2" => $_GET["RANK_VALUE"] - 1));
                $ar_res["VALUE"][] = $_GET["USER_ID"];
                CIBlockElement::SetPropertyValuesEx($_GET["ITEM_ID"], false,
                    array("RANK_USERS" => $ar_res["VALUE"]));
            }
        }
    }

    private function getElements()
    {
        $arSelect = array();

        $iBlock = "1";
        $dbIblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => "news"));
        if ($arRes = $dbIblock->Fetch()) {
            $iBlock = $arRes["ID"];
        }

        $arSort = array(
            $this->arParams["SORT_BY1"] => $this->arParams["SORT_ORDER1"],
        );

        $arFilter = Array(
            "IBLOCK_TYPE" => "news",
            "IBLOCK_ID" => $iBlock,
            "ACTIVE" => "Y",
            ">=PROPERTY_RANK_NEWS2" => $this->arParams["SORT_VAR"],
        );
        $this->res = CIBlockElement::GetList($arSort, $arFilter, false,
            array("nPageSize" => $this->arParams["NEWS_COUNT"]), $arSelect);
        $this->res->SetUrlTemplates($this->arParams["DETAIL_URL"], "", $this->arParams["IBLOCK_URL"]);
    }

    private function onPrepareComponentResult()
    {
        $obParser = new CTextParser;
        while ($obElement = $this->res->GetNextElement()) {

            $arItem = $obElement->GetFields();

            if ($arItem["RANK_NEWS2"] == null) {
                $arItem["RANK_NEWS2"] = 0;
            }

            if ($this->arParams["PREVIEW_TRUNCATE_LEN"] > 0) {
                $arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"],
                    $this->arParams["PREVIEW_TRUNCATE_LEN"]);
            }

            $arItem["PREVIEW_PICTURE"] = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
            $arResult["ITEMS"][] = $arItem;
            $arResult["ELEMENTS"][] = $arItem["ID"];
        }

        $navComponentParameters = array();
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
            Loader::includeModule('iblock');
        } catch (Exception $e) {
        }
        $this->onPrepareComponentParams2();
        $this->raiting();
        $this->getElements();
        $this->arResult = array_merge($this->arResult, $this->onPrepareComponentResult());
        $this->includeComponentTemplate();
    }
}
