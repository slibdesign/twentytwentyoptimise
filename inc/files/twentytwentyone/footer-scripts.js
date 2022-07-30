(function() {
	var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

		request = true;

	b[c] = b[c].replace( rcs, ' ' );
	// The customizer requires postMessage and CORS (if the site is cross domain).
	b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
}());

document.body.classList.remove("no-js");

if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
	document.body.classList.add( 'is-IE' );
}

/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);