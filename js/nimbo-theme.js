/**
 * Theme name: Nimbo
 * nimbo-theme.js v1.1.0
 */

/**
 * Table of Contents:
 *
 * 1.0 - Sticky header
 * 2.0 - Dropdown search form
 * 3.0 - Dropdown menu for mobile devices
 * 4.0 - Superfish menu (jQuery menu plugin by Joel Birch)
 * 5.0 - Main menu (menu type = hidden menu)
 * 6.0 - Color switch
 * 7.0 - Gallery post format: Slider (owlCarousel)
 * 8.0 - Masonry layout
 * 9.0 - Popup windows (magnificPopup)
 * 10.0 - "Back to top" button
 * 11.0 - Cookie: set cookie, get cookie, and delete cookie
 * 12.0 - Other functions
 */

( function( $ ) {
	'use strict';
	$( document ).ready( function() {

		// variables
		var	$body = $( 'body' ),
			currentPopupContainer = '', // variable for storing a name of a current open pop-up container (mobile-menu or search);
			cookieSiteStyle = 'nimbo_site_style'; // cookie name; this cookie is used to store the site style value: light style or dark style (file values: 'light' or 'dark').

		// theme data: string -> boolean
		nimboData.isMobile = 'true' === nimboData.isMobile;
		nimboData.isSingular = 'true' === nimboData.isSingular;
		nimboData.isAdminBarShowing = 'true' === nimboData.isAdminBarShowing;


		/**
		 * 1.0 - Sticky header
		 * ----------------------------------------------------
		 */

		// function: add animation for the sticky header (header type 1 - one row)
		function animateStickyHeader() {

			var	$headerContainer = $( '#bwp-header' ),
				scrollTopOffset = 15,
				animationClass = 'bwp-animate-header';

			// scrolling the page
			$( window ).on( 'scroll', function() {
				if ( $( window ).scrollTop() > scrollTopOffset ) {
					$headerContainer.addClass( animationClass );
				} else {
					$headerContainer.removeClass( animationClass );
				}
			} );

		}

		// header type 1 - one row
		if ( 'header-one-row' === nimboData.headerType && 'on' === nimboData.stickyHeader && ! nimboData.isMobile ) {
			// add animation for the sticky header
			animateStickyHeader();
		}

		// function: enable sticky navigation for the second header type (header type 2 - two rows)
		function enableStickyNavigation() {

			var	$navContainer = $( '#bwp-header .bwp-header-nav-row' ),
				navHeight = $navContainer.height(),
				navTopOffset = $navContainer.offset().top,
				enableStickyNavClass = 'bwp-enable-sticky-nav';

			if ( nimboData.isAdminBarShowing ) {
				navTopOffset = navTopOffset - 32;
				enableStickyNavClass = 'bwp-enable-sticky-nav-32';
			}

			// scrolling the page
			$( window ).on( 'scroll', function() {
				if ( $( window ).scrollTop() > navTopOffset ) {
					$navContainer.addClass( enableStickyNavClass );
					$body.css( 'padding-top', navHeight );
				} else {
					$navContainer.removeClass( enableStickyNavClass );
					$body.css( 'padding-top', 0 );
				}
			} );

		}

		// header type 2 - two rows
		if ( 'header-two-rows' === nimboData.headerType && 'on' === nimboData.stickyHeader && ! nimboData.isMobile ) {
			// enable sticky navigation
			enableStickyNavigation();
		}


		/**
		 * 2.0 - Dropdown search form
		 * ----------------------------------------------------
		 */

		// variables
		var	$searchButton = $( '#bwp-show-dropdown-search' ),
			$searchButtonIcon = $( '#bwp-show-dropdown-search i' ),
			$searchContainer = $( '#bwp-dropdown-search' ),
			$searchField = $( '#bwp-dropdown-search .bwp-search-field' );

		// function: show/hide dropdown search form
		function showHideDropdownSearchForm() {

			// search button: click
			$searchButton.on( 'click', function( e ) {
				e.preventDefault();

				// if the search container is hidden
				if ( $searchContainer.hasClass( 'bwp-hidden' ) ) {
					// check and hide current open popup container
					checkAndHideCurrentPopup();
					// show form
					showDropdownSearchForm();
				} else {
					// hide form
					hideDropdownSearchForm();
				}
			} );

		}

		// function: show dropdown search form
		function showDropdownSearchForm() {

			// search button: add "bwp-active" class
			$searchButton.addClass( 'bwp-active' );

			// add "close" icon
			$searchButtonIcon.hide().attr( 'class', 'fas fa-times' ).fadeIn( 200 );

			// show container with search form
			$searchContainer.css( 'display', 'block' );
			if ( $searchContainer.hasClass( 'bwpSlideDownOut' ) ) {
				$searchContainer.removeClass( 'bwpSlideDownOut' );
			}
			$searchContainer.removeClass( 'bwp-hidden' ).addClass( 'bwpSlideUpIn' );

			// search field: add focus
			if ( $( window ).width() > 768 ) {
				$searchField.focus();
			}

			// current open container is search
			currentPopupContainer = 'search';

		}

		// function: hide dropdown search form
		function hideDropdownSearchForm() {

			// search button: remove "bwp-active" class
			$searchButton.removeClass( 'bwp-active' );

			// add "search" icon
			$searchButtonIcon.hide().attr( 'class', 'fas fa-search' ).fadeIn( 200 );

			// hide container with search form
			$searchContainer.removeClass( 'bwpSlideUpIn' ).addClass( 'bwpSlideDownOut bwp-hidden' );
			setTimeout( function() {
				$searchContainer.css( 'display', 'none' );
			}, 150 );

			// delete "currentPopupContainer" variable value
			currentPopupContainer = '';

		}

		// show/hide dropdown search form
		if ( 'show' === nimboData.dropdownSearch ) {
			showHideDropdownSearchForm();
		}


		/**
		 * 3.0 - Dropdown menu for mobile devices
		 * ----------------------------------------------------
		 */

		// variables
		var	$mobileMenuButton = $( '#bwp-show-sm-main-menu' ),
			$mobileMenuContainer = $( '#bwp-sm-main-menu' );

		// function: show/hide dropdown menu for mobile devices
		function showHideDropdownMobileMenu() {

			// menu button: click
			$mobileMenuButton.on( 'click', function( e ) {
				e.preventDefault();

				// if the menu container is hidden
				if ( $mobileMenuContainer.hasClass( 'bwp-hidden' ) ) {
					// check and hide current open popup container
					checkAndHideCurrentPopup();
					// show menu
					showDropdownMobileMenu();
				} else {
					// hide menu
					hideDropdownMobileMenu();
				}
			} );

		}

		// function: show dropdown menu for mobile devices
		function showDropdownMobileMenu() {

			// menu button: add "bwp-active" class
			$mobileMenuButton.addClass( 'bwp-active' );

			// show menu
			$mobileMenuContainer.css( 'display', 'block' );
			if ( $mobileMenuContainer.hasClass( 'bwpSlideDownOut' ) ) {
				$mobileMenuContainer.removeClass( 'bwpSlideDownOut' );
			}
			$mobileMenuContainer.removeClass( 'bwp-hidden' ).addClass( 'bwpSlideUpIn' );

			// current open container is mobile menu
			currentPopupContainer = 'mobile-menu';

		}

		// function: hide dropdown menu for mobile devices
		function hideDropdownMobileMenu() {

			// menu button: remove "bwp-active" class
			$mobileMenuButton.removeClass( 'bwp-active' );

			// hide menu
			$mobileMenuContainer.removeClass( 'bwpSlideUpIn' ).addClass( 'bwpSlideDownOut bwp-hidden' );
			setTimeout( function() {
				$mobileMenuContainer.css( 'display', 'none' );
			}, 150 );

			// delete "currentPopupContainer" variable value
			currentPopupContainer = '';

		}

		// show/hide dropdown menu for mobile devices
		showHideDropdownMobileMenu();


		/**
		 * 4.0 - Superfish menu (jQuery menu plugin by Joel Birch)
		 * ----------------------------------------------------
		 */

		// initialize superfish
		$( 'ul.sf-menu' ).superfish( {
			delay: 400,
			animation: {
				opacity: 'show',
				marginTop: '0',
			},
			animationOut: {
				opacity: 'hide',
				marginTop: '10',
			},
			speed: 'fast',
		} );


		/**
		 * 5.0 - Main menu (menu type = hidden menu)
		 * ----------------------------------------------------
		 */

		// function: show/hide main menu
		function showHideMainMenu() {

			var	$menuButton = $( '#bwp-show-main-menu' ),
				$menuContainer = $( '#bwp-main-menu' );

			// menu button: click
			$menuButton.on( 'click', function( e ) {
				e.preventDefault();

				// if the menu container is hidden
				if ( $menuContainer.hasClass( 'bwp-hidden' ) ) {

					// menu button: add "bwp-active" class
					$menuButton.addClass( 'bwp-active' );

					// show menu
					$menuContainer.css( 'display', 'block' );
					if ( $menuContainer.hasClass( 'bwpSlideRightOut' ) ) {
						$menuContainer.removeClass( 'bwpSlideRightOut' );
					}
					$menuContainer.removeClass( 'bwp-hidden' ).addClass( 'bwpSlideLeftIn' );

				} else {

					// menu button: remove "bwp-active" class
					$menuButton.removeClass( 'bwp-active' );

					// hide menu
					$menuContainer.removeClass( 'bwpSlideLeftIn' ).addClass( 'bwpSlideRightOut bwp-hidden' );
					setTimeout( function() {
						$menuContainer.css( 'display', 'none' );
					}, 150 );

				}
			} );

		}

		// show/hide main menu
		if ( 'hidden-menu' === nimboData.menuType ) {
			showHideMainMenu();
		}


		/**
		 * 6.0 - Color switch
		 * ----------------------------------------------------
		 */

		// function: change theme color (light or dark scheme)
		function changeThemeColor() {

			var	$switchButton = $( '#bwp-color-switch' ),
				$switchButtonIcon = $( '#bwp-color-switch i' ),
				darkStyleClass = 'bwp-dark-style';

			if ( 'image' === nimboData.logoType ) {
				var	$customLogo = $( '#bwp-custom-logo' ),
					$customLogoLink = $( '#bwp-custom-logo .custom-logo-link' ),
					logoUrl = $customLogo.data( 'logoUrl' ), // logo for light theme style
					darkLogoUrl = $customLogo.data( 'darkLogoUrl' ), // logo for dark theme style
					logoAlt = $customLogo.data( 'logoAlt' );
			}

			// switch button (moon icon): click
			$switchButton.on( 'click', function( e ) {
				e.preventDefault();

				// add or remove dark style class
				if ( $body.hasClass( darkStyleClass ) ) {

					// switch to light style
					// 1 - change icon
					$switchButtonIcon.hide().attr( 'class', 'far fa-moon' ).fadeIn( 200 );

					// 2 - remove darkStyleClass
					$body.removeClass( darkStyleClass );

					// 3 - change logo (image)
					if ( 'image' === nimboData.logoType ) {
						if ( 'none' !== darkLogoUrl ) {
							$customLogoLink.html( '<img src="' + logoUrl + '" class="custom-logo" alt="' + logoAlt + '" itemprop="logo">' );
						}
					}

					// 4 - set cookie (save the user's choice in the cookie)
					if ( 'on' === nimboData.colorSwitchCookies ) {
						setCookie( cookieSiteStyle, 'light' ); // light color scheme
					}

				} else {

					// switch to dark style
					// 1 - change icon
					if ( 'moon' === nimboData.darkColorSwitchIconType ) {
						$switchButtonIcon.hide().attr( 'class', 'fas fa-moon' ).fadeIn( 200 );
					} else {
						$switchButtonIcon.hide().attr( 'class', 'fas fa-sun' ).fadeIn( 200 );
					}

					// 2 - add darkStyleClass
					$body.addClass( darkStyleClass );

					// 3 - change logo (image)
					if ( 'image' === nimboData.logoType ) {
						if ( 'none' !== darkLogoUrl ) {
							$customLogoLink.html( '<img src="' + darkLogoUrl + '" class="custom-logo" alt="' + logoAlt + '" itemprop="logo">' );
						}
					}

					// 4 - set cookie (save the user's choice in the cookie)
					if ( 'on' === nimboData.colorSwitchCookies ) {
						setCookie( cookieSiteStyle, 'dark' ); // dark color scheme
					}

				}
			} );

		}

		// if the color switch is on
		if ( 'on' === nimboData.colorSwitch ) {
			// change theme color
			changeThemeColor();
		} else {
			// delete cookie
			if ( getCookie( cookieSiteStyle ) ) {
				deleteCookie( cookieSiteStyle );
			}
		}

		// delete theme style cookie if they are off
		if ( 'off' === nimboData.colorSwitchCookies ) {
			if ( getCookie( cookieSiteStyle ) ) {
				deleteCookie( cookieSiteStyle );
			}
		}


		/**
		 * 7.0 - Gallery post format: Slider (owlCarousel)
		 * ----------------------------------------------------
		 */

		// function: initialize owlCarousel for gallery post format
		function initGalleryFormatSlider() {

			var	$slider = $( '.bwp-post-slider' ),
				$masonryGrid = $( '#bwp-masonry' );

			// function: update masonry layout
			var	updateMasonryLayout = function() {
				$masonryGrid.masonry();
			};

			// initialize owlCarousel
			$slider.owlCarousel( {
				items: 1,
				loop: false,
				nav: true,
				rewind: true,
				navText: [ '<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>' ],
				dots: false,
				autoplay: false,
				autoplayTimeout: 10000,
				autoplayHoverPause: true,
				autoplaySpeed: 300,
				navSpeed: 300,
				dragEndSpeed: 300,
				onResized: function() {
					if ( ! nimboData.isSingular ) {
						updateMasonryLayout();
					}
				},
			} );

		}

		// initialize owlCarousel for gallery post format
		initGalleryFormatSlider();


		/**
		 * 8.0 - Masonry layout
		 * ----------------------------------------------------
		 */

		// function: initialize masonry layout
		function initMasonryBlogLayout() {

			var $grid = $( '#bwp-masonry' ).imagesLoaded( function() {

				// init Masonry after all images have loaded
				$grid.masonry( {
					// set itemSelector
					itemSelector: '.bwp-masonry-item',
					// set columnWidth
					columnWidth: nimboData.masonryColumnWidth,
				} );

				// update masonry layout
				setTimeout( function() {
					$grid.masonry( 'layout' );
				}, 1000 );

			} );

		}

		// initialize masonry layout
		if ( ! nimboData.isSingular ) {
			initMasonryBlogLayout();
		}


		/**
		 * 9.0 - Popup windows (magnificPopup)
		 * ----------------------------------------------------
		 */

		// popup window type: image
		function initPopupImage() {

			$( '.bwp-popup-image' ).magnificPopup( {
				type: 'image',
				closeOnContentClick: true,
				closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				removalDelay: 200,
				mainClass: 'bwp-popup-zoom-in',
				callbacks: {
					beforeOpen: function() {
						this.container.data( 'scrollTop', parseInt( $( window ).scrollTop() ) );
					},
					afterClose: function() {
						$( 'html, body' ).scrollTop( this.container.data( 'scrollTop' ) );
					},
				},
			} );

		}

		// popup window type: gallery
		function initPopupGallery() {

			$( '.bwp-popup-gallery' ).each( function() {
				$( this ).magnificPopup( {
					delegate: 'a.bwp-popup-gallery-item',
					type: 'image',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						arrowMarkup: '<button title="%title%" type="button" class="bwp-mfp-arrow bwp-mfp-arrow-%dir%"></button>',
						tPrev: 'Previous',
						tNext: 'Next',
						tCounter: '%curr% of %total%',
					},
					closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
					fixedContentPos: true,
					fixedBgPos: true,
					overflowY: 'auto',
					removalDelay: 200,
					mainClass: 'bwp-popup-zoom-in',
					callbacks: {
						beforeOpen: function() {
							this.container.data( 'scrollTop', parseInt( $( window ).scrollTop() ) );
						},
						afterClose: function() {
							$( 'html, body' ).scrollTop( this.container.data( 'scrollTop' ) );
						},
					},
				} );
			} );

		}

		// popup window type: video and audio (inline)
		function initPopupIframe() {

			$( '.bwp-popup-video, .bwp-popup-audio' ).magnificPopup( {
				type: 'inline',
				closeMarkup: '<button title="%title%" type="button" class="mfp-close bwp-mfp-close-button"></button>',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				midClick: true,
				preloader: false,
				removalDelay: 200,
				mainClass: 'bwp-popup-zoom-in',
				callbacks: {
					beforeOpen: function() {
						this.container.data( 'scrollTop', parseInt( $( window ).scrollTop() ) );
					},
					afterClose: function() {
						$( 'html, body' ).scrollTop( this.container.data( 'scrollTop' ) );
					},
				},
			} );

		}

		initPopupImage();
		initPopupGallery();
		initPopupIframe();


		/**
		 * 10.0 - "Back to top" button
		 * ----------------------------------------------------
		 */

		// function: show/hide "back to top" button, click on the button
		function backToTopButton() {

			var	$scrollTopBtn = $( '<a rel="nofollow" href="#" id="bwp-scroll-top"><i class="fas fa-caret-up"></i></a>' ).appendTo( 'body' ),
				visibleClass = 'bwp-visible';

			// first hide the button
			if ( $scrollTopBtn.hasClass( visibleClass ) ) {
				$scrollTopBtn.removeClass( visibleClass );
			}

			// show/hide button when scrolling
			$( window ).on( 'scroll', function() {
				if ( $( window ).scrollTop() > 800 ) {
					$scrollTopBtn.addClass( visibleClass );
				} else {
					$scrollTopBtn.removeClass( visibleClass );
				}
			} );

			// click on the button
			$scrollTopBtn.on( 'click', function( e ) {
				e.preventDefault();
				$( 'html:not(:animated), body:not(:animated)' ).animate( { scrollTop: 0 }, 300 );
			} );

		}

		// show/hide "back to top" button
		if ( ! nimboData.isMobile && 'show' === nimboData.toTopButton ) {
			backToTopButton();
		}


		/**
		 * 11.0 - Cookie: set cookie, get cookie, and delete cookie
		 * ----------------------------------------------------
		 */

		// function: set cookie
		function setCookie( name, value ) {

			// cookie value
			value = encodeURIComponent( value );

			// expiration date (+60 days)
			var date = new Date;
			date.setDate( date.getDate() + 60 );

			// set cookie
			document.cookie = name + '=' + value + '; path=/; expires=' + date.toUTCString();

		}

		// function: get cookie
		function getCookie( name ) {

			var matches = document.cookie.match( new RegExp(
				"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			) );

			return matches ? decodeURIComponent( matches[1] ) : undefined;

		}

		// function: delete cookie
		function deleteCookie( name ) {

			// set the date in the past
			var date = new Date;
			date.setDate( date.getDate() - 1 );

			// delete cookie
			document.cookie = name + '=; path=/; expires=' + date.toUTCString();

		}


		/**
		 * 12.0 - Other functions
		 * ----------------------------------------------------
		 */

		// function: check and hide current open popup container
		function checkAndHideCurrentPopup() {

			switch ( currentPopupContainer ) {
				case 'search':
					// current open container: search... hide it
					hideDropdownSearchForm();
					break;
				case 'mobile-menu':
					// current open container: mobile menu... hide it
					hideDropdownMobileMenu();
					break;
			}

		}

	} );
} )( jQuery );
