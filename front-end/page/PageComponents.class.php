<?php

	namespace Page;

	/**
	 * Class PageComponents
	 * @package Page
	 */
	class PageComponents {


		/**
		 * @var bool whether the page is index or not
		 */
		public static $isIndex = false;


		/**
		 * @var string page's title
		 */
		public static $title;


		/**
		 * @var string page's description
		 */
		public static $description;


		/**
		 * @var string page's keywords
		 */
		public static $keywords;


		/**
		 * @var string page's robots
		 */
		public static $robots = 'index,follow';


		/**
		 * @var string additional head contents
		 */
		public static $headContents = '';


		/**
		 * @var array list of CSS files to be loaded on this file
		 */
		public static $cssFiles = [];


		/**
		 * @var array list of javascript files to be loaded on this page
		 */
		public static $jsFiles = [];


		/**
		 * @var bool whether categories browser is open by default
		 */
		public static $isCategoriesBrowserOpen = false;


		/**
		 * @var bool whether footer should have top margin or not
		 */
		public static $hasFooterMargin = true;


		/**
		 * @var null|array logged in user's data
		 */
		public static $loggedInUserData = null;


		/**
		 * @var bool whether to show categories browser or not
		 */
		public static $showCategoriesBrowser = true;


		/**
		 * Initializes the page and sets its properties
		 *
		 * @param string $title
		 * @param string $description
		 * @param string $keywords
		 */
		public static function initPage(string $title, string $description, string $keywords = '') : void {
			self::$title = $title;
			self::$description = $description;
			self::$keywords = $keywords;
		}


		/**
		 * Sets page as index
		 */
		public static function setAsIndex() : void {
			self::$isIndex = true;
		}


		/**
		 * @param string $url
		 */
		public static function addCss(string $url) : void {
			self::$cssFiles[] = $url;
		}


		/**
		 * @param string $url
		 */
		public static function addJs(string $url) : void {
			self::$jsFiles[] = $url;
		}


		/**
		 * Renders head contents
		 */
		public static function renderHead() : void {
			include ROOT . 'page/include/head.php';
		}


		/**
		 * Renders header contents
		 */
		public static function renderHeader() : void {
			include ROOT . 'page/include/header.php';
		}


		/**
		 * Renders footer contents
		 */
		public static function renderFooter() : void {
			include ROOT . 'page/include/footer.php';
		}


		/**
		 * Renders a checkbox
		 *
		 * @param string $name
		 * @param string $text
		 * @param string $value
		 * @param bool $isRequired
		 * @param bool $isChecked
		 * @param bool $large
		 */
		public static function renderCheckbox(string $name, string $text, string $value = '1', bool $isRequired = false, bool $isChecked = false, bool $large = false) : void {
			echo
				'<label class="ch' . ($large ? ' lrg' : '') . '">
					<input type="checkbox" name="' . $name . '" value="' . $value . '" ' . ($isRequired ? 'required="required"' : '') . ($isChecked ? ' checked="checked"' : '') . '><span class="box"><i class="far fa-check"></i></span><span class="text">' . $text . '</span>
				</label>';
		}


		/**
		 * Renders a radiobox
		 *
		 * @param string $name
		 * @param string $text
		 * @param string $value
		 * @param bool $isRequired
		 * @param bool $isChecked
		 * @param bool $large
		 */
		public static function renderRadiobox(string $name, string $text, string $value = '1', bool $isRequired = false, bool $isChecked = false, bool $large = false) : void {
			echo
				'<label class="ch' . ($large ? ' lrg' : '') . ' radio">
					<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($isRequired ? 'required="required"' : '') . ($isChecked ? ' checked="checked"' : '') . '><span class="box"><i class="fas fa-circle"></i></span><span class="text">' . $text . '</span>
				</label>';
		}


		/**
		 * Renders an input
		 *
		 * @param string $name
		 * @param string $placeholder
		 * @param string|null $icon
		 * @param string $errorMessage
		 * @param string $classes
		 * @param string $type
		 * @param string $attrs
		 * @param string|null $labelText
		 * @param string|null $afterText
		 * @param string|null $belowText
		 */
		public static function renderInput(string $name, string $placeholder, ?string $icon, string $errorMessage, string $classes = '', string $type = 'text', string $attrs = '', ?string $labelText = null, ?string $afterText = null, ?string $belowText = null) : void {
			if(empty($icon)) $classes .= ' no-ico';

			switch($type) {

				case 'textarea':
					{
						$input = '<textarea name="' . $name . '" placeholder="' . $placeholder . '" ' . $attrs . '></textarea>';
						break;
					}

				default:
					{
						$input = '<input type="' . (in_array($type, ['phone']) ? 'text' : $type) . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $attrs . '>';
					}
			}

			//Phone element, prepend dropdown
			if($type === 'phone') {
				$input = '
					<div class="phone-prefix-select">
						<select class="select" name="phone_prefix"' . (strpos($attrs, 'required') !== false ? ' required="required"' : '') . '>
							<option value="386" selected>+386</option>
							<option value="385">+385</option>
						</select>
					</div>' . $input;
			}

			echo '<div class="input input-type-' . $type . ' ' . $classes . '">' . (!empty($labelText) ? ('<strong>' . $labelText . '</strong>') : '') . '
					<div class="input-inner">
						' . $input . '
						<div class="input-decor">
							<i class="decor ' . $icon . '"></i>
							<i class="error-ico fas fa-exclamation-circle"></i>
							' . (!empty($belowText) ? ('<p class="below-msg">' . $belowText . '</p>') : '') . '
							<p class="error-msg">' . $errorMessage . '</p>
							' . (!empty($afterText) ? ('<span class="after-text">' . $afterText . '</span>') : '') . '
						</div>
					</div>
				</div>';
		}


		/**
		 * Renders breadcrumbs
		 *
		 * @param array $breadcrumbs
		 */
		public static function renderBreadcrumbs(array $breadcrumbs) : void {

			//Do not render empty breadcrumbs
			if(count($breadcrumbs) === 0) return;

			echo '<div class="breadcrumbs"><ul>';

			foreach($breadcrumbs as $breadcrumb) {
				if(isset($breadcrumb[0]) && isset($breadcrumb[1])) {
					echo '<li><a href="' . $breadcrumb[1] . '">' . $breadcrumb[0] . '</a><i class="far fa-chevron-right">	</i></li>';
				}
			}

			echo '</ul></div>';
		}


		/**
		 * Renders captcha
		 */
		public static function renderCaptcha() : void {
			echo '<div class="g-recaptcha" data-sitekey="' . RECAPTCHA_API_KEY . '" data-callback="captchaFormCb"></div><input type="hidden" name="captcha" required="required"/>';
		}


		/**
		 * @return bool
		 */
		public static function isUserLoggedIn() : bool {
			return self::$loggedInUserData !== null;
		}


		/**
		 * @return bool
		 */
		public static function isCompanyLoggedIn() : bool {
			return self::$loggedInUserData['is_company'] ?? false;
		}
	}
