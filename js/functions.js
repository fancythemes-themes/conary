/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		} ).append( $( '<span />', {
			'class': 'screen-reader-text',
			text: screenReaderText.expand
		} ) );

		container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '#menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.conary', function() {
			$( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );

			// jscs:disable
			$( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable

			if ( $('.search-toggle').hasClass('toggled-on') ) {
				$('.search-toggle').removeClass('toggled-on');
			}
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.conary', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.conary', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.conary' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.conary', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.conary blur.conary', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	function onResizeARIA() {
		if ( window.innerWidth < 910 ) {
			if ( menuToggle.hasClass( 'toggled-on' ) ) {
				menuToggle.attr( 'aria-expanded', 'true' );
			} else {
				menuToggle.attr( 'aria-expanded', 'false' );
			}

			if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
				siteNavigation.attr( 'aria-expanded', 'true' );
				socialNavigation.attr( 'aria-expanded', 'true' );
			} else {
				siteNavigation.attr( 'aria-expanded', 'false' );
				socialNavigation.attr( 'aria-expanded', 'false' );
			}

			menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
		} else {
			menuToggle.removeAttr( 'aria-expanded' );
			siteNavigation.removeAttr( 'aria-expanded' );
			socialNavigation.removeAttr( 'aria-expanded' );
			menuToggle.removeAttr( 'aria-controls' );
		}
	}

	function initTabs() {
		$('.posts-tab .comment_count-tab-control').addClass('active-tab-control');
		$('.posts-tab .comment_count-tab').addClass('active-tab');

		$('.tab-control a').on('click.conary', function( e ) {

			e.preventDefault();

			if ( $(this).hasClass('active-tab-control') ) {
				return;
			}

			parentWidget = $(this).parents('.widget');
			$('.posts-tab .comment_count-tab-control', parentWidget).toggleClass('active-tab-control');
			$('.posts-tab .comment_count-tab', parentWidget).toggleClass('active-tab');
			$('.posts-tab .date-tab-control', parentWidget).toggleClass('active-tab-control');
			$('.posts-tab .date-tab', parentWidget).toggleClass('active-tab');

		});
	}

	$( document ).ready( function() {
		body = $( document.body );
		var lastScrollTop = 0;

		$( window )
			.on( 'load.conary', onResizeARIA )
			.on( 'scroll.conary', function() {
			});

		initTabs();

		$(".hentry").fitVids();
		
		$('.posts-slider').each( function(){
			var slider = $(this);
			var sliderOpts = slider.data('slider-options');
			console.log(sliderOpts);
			slider.flexslider( {
				selector: '.slides > article',
				animation: 'slide',
				controlNav: false,
				prevText: sliderOpts.prevText,
				nextText: sliderOpts.nextText,
				minItems: 1,
				maxItems: sliderOpts.maxItems,
				itemMargin: sliderOpts.itemMargin,
				itemWidth: sliderOpts.itemWidth,
				slideshow: sliderOpts.slideshow,
				slideshowSpeed: sliderOpts.slideshow_time
			});
		} );

		$('.search-toggle').on( 'click', function() {
			$(this).toggleClass('toggled-on');
			if ( $(this).hasClass('toggled-on') ) {
				$('.site-search .search-field').focus();
			}

			if ( siteHeaderMenu.hasClass('toggled-on')) {
				siteHeaderMenu.add( siteHeaderMenu ).toggleClass( 'toggled-on' );
			}
		} );

		$('.single .site-main .format-video .post-thumbnail, .single .site-main .format-gallery .post-thumbnail').remove();
		$('.single .site-main .format-video .entry-content p').has('.fluid-width-video-wrapper').first().insertBefore('.single .site-main .format-video .entry-content');
		$('.single .site-main .format-gallery .entry-content .tiled-gallery').first().insertBefore('.single .site-main .format-gallery .entry-content');

	} );
} )( jQuery );
