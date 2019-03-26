<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css", true);
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<body class="nl">

<div class="layout">
	<div class="layout__row layout__row_services">
		<div id="TMpanel">
			<div class="container">
				<div class="bmenu">
					<a href="https://habr.com?utm_source=tm_habrahabr&utm_medium=tm_top_panel&utm_campaign=tm_promo" class="current">Хабр</a>
					<a href="https://habr.com/flows/geektimes/">Geektimes</a>
					<a href="https://toster.ru?utm_source=tm_habrahabr&utm_medium=tm_top_panel&utm_campaign=tm_promo">Тостер</a>
					<a href="https://moikrug.ru?utm_source=tm_habrahabr&utm_medium=tm_top_panel&utm_campaign=tm_promo">Мой круг</a>
					<a href="https://freelansim.ru?utm_source=tm_habrahabr&utm_medium=tm_top_panel&utm_campaign=tm_promo">Фрилансим</a>
				</div>
				<div class="bmenu_inner" style="display:inline-block!important;visibility:visible!important;">
					<span class="bmenu__label">Мегапосты:</span>
					<span class="bmenu slink"></span>
				</div>
			</div>
		</div>

	</div>

	<div class="layout__row layout__row_navbar">
		<div class="layout__cell">
			<div class="main-navbar">
				<div class="main-navbar__section main-navbar__section_left">
    <span class="logo-wrapper">
      <a href="https://habr.com/ru/" class="logo" title="">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg icon-svg_logo-habrahabr" width="71" height="26" viewBox="0 0 92 32"><path d="M6.827 12.278c1.273-1.735 3.304-2.848 5.595-2.848l.521.019-.023-.001c4.272 0 7.587 2.988 7.587 7.941v14.047h-6.827v-11.636c0-2.529-1.31-3.931-3.381-3.931-1.9 0-3.473 1.31-3.473 4.062v11.505h-6.827v-31.45h6.827zM46.611 31.437h-6.552v-2.319c-1.357 1.764-3.468 2.89-5.843 2.89l-.332-.007.016.001c-5.713 0-9.946-4.98-9.946-11.296s4.233-11.256 9.972-11.256l.288-.006c2.378 0 4.491 1.131 5.832 2.884l.013.018v-2.306h6.552zm-15.725-10.72c0 2.533 2.053 4.586 4.586 4.586s4.586-2.053 4.586-4.586c0-2.533-2.053-4.586-4.586-4.586s-4.586 2.053-4.586 4.586zM73.959 20.704c0 6.316-4.246 11.296-9.959 11.296l-.342.008c-2.354 0-4.446-1.116-5.778-2.848l-.013-.017v2.293h-6.552v-31.45h6.814v12.095c1.343-1.61 3.351-2.628 5.596-2.628l.329.007-.016-.001c5.674-.013 9.92 4.94 9.92 11.243zm-16.157 0c0 2.533 2.053 4.586 4.586 4.586s4.586-2.053 4.586-4.586c0-2.533-2.053-4.586-4.586-4.586s-4.586 2.053-4.586 4.586zM92.318 9.776l-.59 6.801c-1.019-.342-2.193-.547-3.412-.563h-.008c-.15-.023-.323-.036-.498-.036-1.911 0-3.459 1.549-3.459 3.459 0 .151.01.3.029.447l-.002-.017v11.571h-6.84v-21.399h6.552v2.464c1.124-1.85 3.128-3.068 5.417-3.068l.448.016-.02-.001h.022c.842 0 1.655.12 2.425.343l-.061-.015z"/></svg>
      </a>

    </span>
					<ul class="nav-links" id="navbar-links">
						<li class="nav-links__item">
							<a href="https://habr.com/ru/" class="nav-links__item-link ">Публикации</a>
						</li>
						<li class="nav-links__item">
							<a href="https://habr.com/ru/users/" class="nav-links__item-link ">Пользователи</a>
						</li>
						<li class="nav-links__item">
							<a href="https://habr.com/ru/hubs/" class="nav-links__item-link ">Хабы</a>
						</li>
						<li class="nav-links__item">
							<a href="https://habr.com/ru/companies/" class="nav-links__item-link ">Компании</a>
						</li>
						<li class="nav-links__item">
							<a href="https://habr.com/ru/sandbox/" class="nav-links__item-link ">Песочница</a>
						</li>
					</ul>

					<form action="https://habr.com/ru/search/#h" method="get" class="search-form" id="search-form">
						<button type="button" class="btn btn_navbar_search icon-svg_search" id="search-form-btn" title="Поиск по сайту">
							<svg class="icon-svg" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true" version="1.1" role="img"><path d="M21.416 13.21c0 4.6-3.65 8.34-8.14 8.34S5.11 17.81 5.11 13.21c0-4.632 3.65-8.373 8.167-8.373 4.488 0 8.14 3.772 8.14 8.372zm1.945 7.083c1.407-2.055 2.155-4.57 2.155-7.084C25.515 6.277 20.04.665 13.277.665S1.04 6.278 1.04 13.21c0 6.93 5.475 12.542 12.237 12.542 2.454 0 4.907-.797 6.942-2.208l7.6 7.79 3.14-3.22-7.6-7.82z"/></svg>
						</button>
						<label class="search-form__field-wrapper">
							<input type="text" name="q" class="search-form__field" id="search-form-field" placeholder="Поиск" tabindex="-1"/>
							<button type="button" class="btn btn_search-close" id="search-form-clear" title="Закрыть">
								<svg class="icon-svg icon-svg_navbar-close-search" width="31" height="32" viewBox="0 0 31 32" aria-hidden="true" version="1.1" role="img"><path d="M26.67 0L15.217 11.448 3.77 0 0 3.77l11.447 11.45L0 26.666l3.77 3.77L15.218 18.99l11.45 11.448 3.772-3.77-11.448-11.45L30.44 3.772z"/></svg>

							</button>
						</label>
					</form>

				</div>

				<div class="main-navbar__section main-navbar__section_right">
					<button type="button" class="btn btn_medium btn_navbar_lang js-show_lang_settings">
						<svg class="icon-svg" width="18" height="18">
							<use xlink:href="https://habr.com/images/1553247084/common-svg-sprite.svg#globus" />
						</svg>
					</button>
					<a href="https://habr.com/ru/auth/login/" id="login" class="btn btn_medium btn_navbar_login">Войти</a>
					<a href="https://habr.com/ru/auth/register/" class="btn btn_medium btn_navbar_registration">Регистрация</a>


				</div>
			</div>

		</div>
	</div>

	<div class="layout__row layout__row_body">
		<div class="layout__cell layout__cell_body">



			<div class="page-header page-header_full" id="hub_260">
				<div class="page-header_wrapper">
					<div class="media-obj media-obj_page-header">
						<a href="https://habr.com/ru/hub/php/" class="media-obj__image">
							<img src="//habrastorage.org/getpro/habr/hub/98a/7a8/831/98a7a88319d5644cdc627b5e04b47d0f.png" width="48" height="48" class="media-obj__image-pic"/>
						</a>

						<div class="media-obj__body media-obj__body_page-header media-obj__body_page-header_hub">
							<div class="page-header__stats">
								<div class="page-header__stats-value">140,00</div>
								<div class="page-header__stats-label">Рейтинг</div>
							</div>
						</div>
					</div>

				</div>

				<div class="page-header__info">
					<h1 class="page-header__info-title">PHP</h1>
					<span class="n-profiled_hub" title="Профильный хаб"></span>
					<h2 class="page-header__info-desc">
						Скриптовый язык общего назначения
					</h2>
				</div>
			</div>

			<div class="column-wrapper column-wrapper_tabs js-sticky-wrapper">
				<div class="content_left js-content_left">
					<div class="tabs">
						<div class="tabs__level tabs-level_top tabs-menu">
							<a href="https://habr.com/ru/hub/php/" class="tabs-menu__item tabs-menu__item_link" rel="nofollow"  >
								<h3 class="tabs-menu__item-text tabs-menu__item-text_active">
									Все подряд


								</h3>
							</a>
							<a href="https://habr.com/ru/hub/php/top/" class="tabs-menu__item tabs-menu__item_link" rel="nofollow"  >
								<h3 class="tabs-menu__item-text ">
									Лучшие


								</h3>
							</a>
							<a href="https://habr.com/ru/hub/php/authors/" class="tabs-menu__item tabs-menu__item_link" rel="nofollow"  >
								<h3 class="tabs-menu__item-text ">
									Авторы


								</h3>
							</a>
						</div>
					</div>

					<div class="posts_list">
						<ul class="content-list shortcuts_items">
