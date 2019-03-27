<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ClientID = 'navigation_' . $arResult['NavNum'];

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
?>
<div class="navigation">
    <?
    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
    if ($arResult["bDescPageNumbering"] === true)
    {
    // to show always first and last pages
    $arResult["nStartPage"] = $arResult["NavPageCount"];
    $arResult["nEndPage"] = 1;

    $sPrevHref = '';
    if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
        $bPrevDisabled = false;
        if ($arResult["bSavePage"]) {
            $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
        } else {
            if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)) {
                $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
            } else {
                $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
            }
        }
    } else {
        $bPrevDisabled = true;
    }

    $sNextHref = '';
    if ($arResult["NavPageNomer"] > 1) {
        $bNextDisabled = false;
        $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
    } else {
        $bNextDisabled = true;
    }
    ?>
    <div class="navigation-arrows arrows-pagination__item-link">
        <span class="arrow">&larr;</span><span class="ctrl"></span>&nbsp;<? if ($bPrevDisabled):?><span
            class="disabled">сюда</span><?
        else:?><a href="<?= $sPrevHref; ?>" id="<?= $ClientID ?>_previous_page">сюда</a><?endif; ?>
        &nbsp;<? if ($bNextDisabled):?><span class="disabled">туда</span><?
        else:?><a href="<?= $sNextHref; ?>" id="<?= $ClientID ?>_next_page">туда</a><?endif; ?>&nbsp;<span
            class="ctrl"></span><span class="arrow">&rarr;</span>
    </div>

    <div class="navigation-pages toggle-menu toggle-menu_pagination">
        <span class="navigation-title"></span>
        <?
        $bFirst = true;
        $bPoints = false;
        do {
            $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
            if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

                if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                    ?>
                    <span class="nav-current-page"><?= $NavRecordGroupPrint ?></span>
                    <?
                elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
                    ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
                    <?
                else:
                    ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
                    <?
                endif;
                $bFirst = false;
                $bPoints = true;
            } else {
                if ($bPoints) {
                    ?>...<?
                    $bPoints = false;
                }
            }
            $arResult["nStartPage"]--;
        } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);
        }
        else
        {
        // to show always first and last pages
        $arResult["nStartPage"] = 1;
        $arResult["nEndPage"] = $arResult["NavPageCount"];

        $sPrevHref = '';
        if ($arResult["NavPageNomer"] > 1) {
            $bPrevDisabled = false;

            if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2) {
                $sPrevHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] - 1);
            } else {
                $sPrevHref = $arResult["sUrlPath"] . $strNavQueryStringFull;
            }
        } else {
            $bPrevDisabled = true;
        }

        $sNextHref = '';
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
            $bNextDisabled = false;
            $sNextHref = $arResult["sUrlPath"] . '?' . $strNavQueryString . 'PAGEN_' . $arResult["NavNum"] . '=' . ($arResult["NavPageNomer"] + 1);
        } else {
            $bNextDisabled = true;
        }
        ?>
        <div class="navigation-arrows arrows-pagination__item-link">
            <span class="arrow">&larr;</span><span class="ctrl"></span>&nbsp;<? if ($bPrevDisabled):?><span
                class="disabled">сюда</span><?
            else:?><a href="<?= $sPrevHref; ?>" id="<?= $ClientID ?>_previous_page">сюда</a><?endif; ?>
            &nbsp;<? if ($bNextDisabled):?><span class="disabled">туда</span><?
            else:?><a href="<?= $sNextHref; ?>" id="<?= $ClientID ?>_next_page">туда</a><?endif; ?>&nbsp;<span
                class="ctrl"></span><span class="arrow">&rarr;</span>
        </div>

        <div class="navigation-pages toggle-menu toggle-menu_pagination">
            <span class="navigation-title"></span>
            <?
            $bFirst = true;
            $bPoints = false;
            do {
                if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"] - $arResult["nStartPage"] <= 1 || abs($arResult['nStartPage'] - $arResult["NavPageNomer"]) <= 2) {

                    if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                        ?>
                        <span
                            class="nav-current-page toggle-menu__item-link toggle-menu__item-link_pagination toggle-menu__item-link_active"><?= $arResult["nStartPage"] ?></span>
                        <?
                    elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
                        ?>
                        <a class="toggle-menu__item-link toggle-menu__item-link_pagination toggle-menu__item-link_active"
                           href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    else:
                        ?>
                        <a class="toggle-menu__item-link toggle-menu__item-link_pagination"
                           href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                        <?
                    endif;
                    $bFirst = false;
                    $bPoints = true;
                } else {
                    if ($bPoints) {
                        ?>...<?
                        $bPoints = false;
                    }
                }
                $arResult["nStartPage"]++;
            } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);
            }

            if ($arResult["bShowAll"]):
                if ($arResult["NavShowAll"]):
                    ?>
                    <a class="nav-page-pagen"
                       href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"></a>
                    <?
                else:
                    ?>
                    <a class="nav-page-all toggle-menu__item-link toggle-menu__item-link_pagination toggle-menu__item-link_bordered"
                       href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1">
			<span class="icon-svg icon-svg_arrow-last">
				<svg class="icon-svg" width="28" height="24" viewBox="0 0 28 24"><path d="M8.452 5.455l2.93 3.192c.89.969 1.335 1.361 2.225 1.909h-13.608v2.773h13.634c-.838.5-1.492 1.102-2.252 1.913l-2.93 3.192 2.276 1.964 7.588-8.452-7.588-8.452-2.276 1.961zM24.297 0h3.087v23.891h-3.087v-23.891z"/>
				</svg>
			</span>
                    </a>
                    <?
                endif;
            endif;
            ?>
        </div>
    </div>
    <? CJSCore::Init(); ?>
    <script type="text/javascript">
        BX.bind(document, "keydown", function (event) {

            event = event || window.event;
            if (!event.ctrlKey)
                return;

            var target = event.target || event.srcElement;
            if (target && target.nodeName && (target.nodeName.toUpperCase() == "INPUT" || target.nodeName.toUpperCase() == "TEXTAREA"))
                return;

            var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null));
            if (!key)
                return;

            var link = null;
            if (key == 39)
                link = BX('<?=$ClientID?>_next_page');
            else if (key == 37)
                link = BX('<?=$ClientID?>_previous_page');

            if (link && link.href)
                document.location = link.href;
        });
    </script>