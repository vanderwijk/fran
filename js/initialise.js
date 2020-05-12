jQuery(document).ready(function($) {

	// Open external links in new window
	$(function() {
		$('a[rel~=external]').attr('target', '_blank');
	});

	// Open menu toggle on click
	$('#menu-toggle').on('click', function() {
		$('body').toggleClass('show-navigation');
	});

	// Scroll to top link
	$('#scroll-up').click(function() {
		$('html, body').animate( { scrollTop: 0 }, 1000 );
	});

});


// Look for .hamburger
var hamburger = document.querySelector(".hamburger");
var body = document.querySelector("body");
// On click
hamburger.addEventListener("click", function() {
	// Toggle class "is-active"
	hamburger.classList.toggle("is-active");
	body.classList.toggle("show-navigation");
	// Do something else, like open/close menu
});


// Headroom
var headroomHeight = document.getElementById('header').clientHeight;
var headroom = new Headroom( document.getElementById('header'), {
	"offset": headroomHeight,
	"tolerance": 5
});
headroom.init();

// Calculate padding on element below headroom to allow for flexible height
document.getElementById('main').style.padding = headroomHeight + "px 0 0 0";