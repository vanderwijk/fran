jQuery(document).ready(function($) {

	// Open external links in new window
	$(function() {
		$('a[rel~=external]').attr('target', '_blank');
	});

	// Scroll to top link
	$('#scroll-up').click(function() {
		$('html, body').animate( { scrollTop: 0 }, 1000 );
	});

});

var body = document.querySelector('body');
var main = document.getElementById('main');
var header = document.querySelector('.header');
var hamburger = document.querySelector('.hamburger');

// Open responsive navigation with hamburger
hamburger.addEventListener('click', function() {
	hamburger.classList.toggle('is-active');
	body.classList.toggle('show-navigation');
});

// Headroom
var headroomHeight = header.clientHeight;
var headroom = new Headroom( header, {
	'offset': headroomHeight,
	'tolerance': 5
});
headroom.init();

// Calculate padding on element below headroom to allow for flexible height
main.style.padding = headroomHeight + 'px 0 0 0';