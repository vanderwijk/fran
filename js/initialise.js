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

});

// Headroom
var headroomHeight = document.getElementById('branding').clientHeight;
var headroom  = new Headroom( document.getElementById('branding'), {
	"offset": headroomHeight,
	"tolerance": 5
});
headroom.init();

// Calculate padding on element below headroom to allow for flexible height
document.getElementById("navigation").style.padding = headroomHeight + "px 0 0 0";