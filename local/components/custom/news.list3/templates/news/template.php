<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="news-list">
    <span><?= GetMessage("CT_SORT_TEXT") ?></span>
    <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_NEWS_ASC", array("sort"), false); ?>">
        <?= GetMessage("CT_SORT_ASC") ?>
    </a>
    <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_NEWS_DESC", array("sort"), false); ?>">
        <?= GetMessage("CT_SORT_DESC") ?>
    </a><br>

	<div class="tabs__level tabs__level_bottom">
		<ul class="toggle-menu ">
            <li class="toggle-menu__item">
                <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_NONE", array("sort"), false); ?>"
                   class="toggle-menu__item-link toggle-menu__item-link_active" rel="nofollow"
                   title="Все публикации в хронологическом порядке">
                    <?= GetMessage("CT_SORT_NONE") ?>
                </a>
            </li>
            <li class="toggle-menu__item">
                <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_THREE", array("sort"), false); ?>"
                   class="toggle-menu__item-link " rel="nofollow" title="Все публикации с рейтингом 10 и выше">
                    <?= GetMessage("CT_SORT_THREE") ?>
                </a>
            </li>
            <li class="toggle-menu__item">
                <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_FIVE", array("sort"), false); ?>"
                   class="toggle-menu__item-link " rel="nofollow" title="Все публикации с рейтингом 25 и выше">
                    <?= GetMessage("CT_SORT_FIVE") ?>
                </a>
            </li>
            <li class="toggle-menu__item">
                <a href="<?= $APPLICATION->GetCurPageParam("sort=RANK_TEN", array("sort"), false); ?>"
                   class="toggle-menu__item-link " rel="nofollow" title="Все публикации с рейтингом 50 и выше">
                    <?= GetMessage("CT_SORT_TEN") ?>
                </a>
            </li>
		</ul>
	</div>

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $arItem["RANK_NEWS2"] = CRatings::GetRatingVoteResult("THEMES", $arItem['ID']);
        $arItem["RANK_NEWS2"] = $arItem["RANK_NEWS2"]["TOTAL_POSITIVE_VOTES"];
        CIBlockElement::SetPropertyValuesEx($arItem["ID"], false, array("RANK_NEWS2" => $arItem["RANK_NEWS2"]));
        ?>
		<li class="content-list__item content-list__item_post shortcuts_item" id="post_445140">
		<article class="post post_preview">
			<header class="post__meta">
				<a href="#" class="post__user-info user-info" title="Автор публикации">
					<img src="#" width="24" height="24" class="user-info__image-pic user-info__image-pic_small">
					<span class="user-info__nickname user-info__nickname_small">pronskiy</span>
				</a>
				<span class="post__time">сегодня в 05:27</span>
			</header>

			<h2 class="post__title">
                <? if ($arItem["NAME"]): ?>
                    <a class="post__title_link" href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><b>
                            <? echo $arItem["NAME"] ?></b>
                    </a><br/>
                <? endif; ?>
			</h2>

			<div class="post__body post__body_crop ">
				<div class="post__text post__text-html js-mediator-article">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <div style="text-align:center;">
                            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                                <div class="div-item_img">
                                    <a class="link-img" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                        <img class="preview_picture" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                             alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                             title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                                    </a>
                                </div>
                            <? endif ?>
                        </div>
                    </a><br>
                    <? if ($arItem["PREVIEW_TEXT"]): ?>
                        <? echo $arItem["PREVIEW_TEXT"]; ?>
                    <? endif; ?>
				</div>
                <? if ($arItem["NAME"]): ?>
                    <a class="btn btn_x-large btn_outline_blue post__habracut-btn"
                       href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Читать дальше →</a>
                <? endif; ?>
			</div>

			<footer class="post__footer">
				<ul class="post-stats  js-user_" id="infopanel_post_445140">
					<li class="post-stats__item post-stats__item_voting-wjt">
						<div class="voting-wjt voting-wjt_post js-post-vote" data-id="445140" data-type="2">
							<button type="button" class="btn voting-wjt__button " data-action="plus" onclick="posts_vote(this);" title="Голосовать могут только зарегистрированные пользователи Голосовать могут только пользователи с полноправным аккаунтом" disabled><svg class="icon-svg_arrow-up" width="10" height="16"><use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#vote-arrow" /></svg></button>

							<span class="voting-wjt__counter voting-wjt__counter_positive  js-score" title="Общий рейтинг ">
								<? $APPLICATION->IncludeComponent("bitrix:rating.vote", "",
                                    Array(
                                        "ENTITY_TYPE_ID" => "THEMES",
                                        "ENTITY_ID" => $arItem['ID']
                                    ),
                                    null,
                                    array("HIDE_ICONS" => "Y")
                                ); ?>
							</span>

							<button type="button" class="btn voting-wjt__button " data-action="minus" onclick="posts_vote(this);" title="Голосовать могут только зарегистрированные пользователи Голосовать могут только пользователи с полноправным аккаунтом" disabled><svg class="icon-svg_arrow-down" width="10" height="16"><use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#vote-arrow" /></svg></button>
						</div>
					</li>

					<li class="post-stats__item post-stats__item_bookmark">
						<button type="button" class="btn bookmark-btn bookmark-btn_post " data-type="2" data-id="445140" data-action="add" title="Только зарегистрированные пользователи могут добавлять публикации в закладки" onclick="posts_add_to_favorite(this);" disabled>
							<span class="btn_inner"><svg class="icon-svg_bookmark" width="10" height="16"><use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#book" /></svg><span class="bookmark__counter js-favs_count" title="Количество пользователей, добавивших публикацию в закладки">8</span></span>
						</button>
					</li>

					<li class="post-stats__item post-stats__item_views">
						<div class="post-stats__views" title="Количество просмотров">
							<svg class="icon-svg_views-count" width="21" height="12"><use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#eye" /></svg><span class="post-stats__views-count">3k</span>
						</div>
					</li>

					<li class="post-stats__item post-stats__item_comments">
						<a href="https://habr.com/ru/post/445140/#comments" class="post-stats__comments-link" rel="nofollow">
							<svg class="icon-svg_post-comments" width="16" height="16"><use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#comment" /></svg><span class="post-stats__comments-count" title="Читать комментарии">9</span>
						</a>
					</li>
				</ul>
			</footer>
		</article>
	</li>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
</div>



