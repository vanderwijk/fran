jQuery(document).ready(function($) {

	// Open external links in new window
	$(function() { $('a[rel~=external]').attr('target', '_blank'); });

	// Make videos responsive
	//$('.entry-content').fitVids();

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

	// Use arrow keys to navigate
	$(document).keydown(function(event) {
		var url = false;
		if (event.which == 37) {
			url = $( '.post-navigation a[rel="prev"]' ).attr( 'href' );
		}
		if (event.which == 39) {
			url = $( '.post-navigation a[rel="next"]' ).attr( 'href' );
		}
		if (url) {
			window.location = url;
		}
	});

	$(document).keydown(function(event) {
		var url = false;
		if (event.which == 37) {
			url = $( '.post-navigation .prev a' ).attr( 'href' );
		}
		if (event.which == 39) {
			url = $( '.post-navigation .next a' ).attr( 'href' );
		}
		if (url) {
			window.location = url;
		}
	});

});