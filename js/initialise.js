jQuery(document).ready(function($) {

	// Open external links in new window
	$(function() { $('a[rel~=external]').attr('target', '_blank'); });

	// Open menu toggle on click
	$( '#menu-toggle' ).on( 'click', function() {
		$( '#nav' ).toggleClass( 'toggled-on' );
	});

	// Scroll to top link
	$( '#scroll-up' ).click(function() {
		$( 'html, body' ).animate( { scrollTop: 0 }, 1000 );
	});

	// Headroom
	$( '#top').headroom({
		'offset': 205,
		'tolerance': 5,
	});

});