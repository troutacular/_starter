( function() {
	
	// wrap the first word of the site title in a span to apply highlight color
		function uscSiteTitle() {
			
			var strTitle = document.getElementsByClassName('site-title')[0].innerHTML;
			
			var newStrTitle = strTitle.replace(/USC/g, '<span class="site-acronym">USC</span>');
			
			if ( strTitle != null ) {
				document.getElementsByClassName('site-title')[0].innerHTML = newStrTitle;
			}
		}
		  
		uscSiteTitle();
	// end

	// skip link focus fix
		var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
		    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
		    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;
	
		if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
			var eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
			window[ eventMethod ]( 'hashchange', function() {
				var element = document.getElementById( location.hash.substring( 1 ) );
	
				if ( element ) {
					if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
						element.tabIndex = -1;
	
					element.focus();
				}
			}, false );
		}
	// end
	
	// Navigation: handles toggling the navigation menu for small screens.
		var container, button, menu;
	
		container = document.getElementById( 'site-navigation' );
		if ( ! container )
			return;
	
		button = container.getElementsByClassName( 'menu-toggle' )[0];
		if ( 'undefined' === typeof button )
			return;
	
		menu = container.getElementsByClassName( 'nav-menu' )[0];
	
		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}
	
		if ( -1 === menu.className.indexOf( 'nav-menu' ) )
			menu.className += ' nav-menu';
	
		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'toggled' ) )
				container.className = container.className.replace( ' toggled', '' );
			else
				container.className += ' toggled';
		};
	// end
	
	
})();
