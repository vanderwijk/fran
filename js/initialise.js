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


// Open responsive navigation with hamburger
var hamburger = document.querySelector('.hamburger');
var body = document.querySelector('body');
hamburger.addEventListener('click', function() {
	hamburger.classList.toggle('is-active');
	body.classList.toggle('show-navigation');
});

// Headroom
var headroomHeight = document.querySelector('.header').clientHeight;
var headroom = new Headroom( document.querySelector('.header'), {
	'offset': headroomHeight,
	'tolerance': 5
});
headroom.init();

// Calculate padding on element below headroom to allow for flexible height
document.getElementById('main').style.padding = headroomHeight + 'px 0 0 0';