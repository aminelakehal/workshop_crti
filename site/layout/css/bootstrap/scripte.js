


function hideMessages() {
	const errorMessages = document.querySelectorAll('#error-message');
	const successMessage = document.getElementById('success-message');

	errorMessages.forEach((message) => {
		setTimeout(() => {
			message.style.display = 'none';
		}, 2000); 
	});

	if (successMessage) {
		setTimeout(() => {
			successMessage.style.display = 'none';
		}, 2000); 
	}
}

window.onload = hideMessages;


 // ---------Responsive-navbar-active-animation-----------
 function test(){
	var tabsNewAnim = $('#navbarSupportedContent');
	var activeItemNewAnim = tabsNewAnim.find('.active');
	var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
	var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
	var itemPosNewAnim = activeItemNewAnim.position();
	$(".hori-selector").css({
		"top": itemPosNewAnim.top + "px",
		"left": itemPosNewAnim.left + "px",
		"height": activeWidthNewAnimHeight + "px",
		"width": activeWidthNewAnimWidth + "px"
	});

	$("#navbarSupportedContent").on("click", "li", function(){
		$('#navbarSupportedContent ul li').removeClass("active");
		$(this).addClass('active');
		var activeWidthNewAnimHeight = $(this).innerHeight();
		var activeWidthNewAnimWidth = $(this).innerWidth();
		var itemPosNewAnim = $(this).position();
		$(".hori-selector").css({
			"top": itemPosNewAnim.top + "px",
			"left": itemPosNewAnim.left + "px",
			"height": activeWidthNewAnimHeight + "px",
			"width": activeWidthNewAnimWidth + "px"
		});
	});
}

$(document).ready(function(){
	setTimeout(test, 0);
});

$(window).on('resize', function(){
	setTimeout(test, 500);
});

$(".navbar-toggler").click(function(){
	$(".navbar-collapse").slideToggle(300);
	setTimeout(test, 0);
});

// --------------add active class-on another-page move----------
$(document).ready(function(){
	var path = window.location.pathname.split("/").pop();

	if (path == '') {
		path = 'index.html';
	}

	var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
	target.parent().addClass('active');
});


// ======================== bubbles =============================

const bubblesContainer = document.querySelector('.bubbles');
for (let i = 0; i < 128; i++) {
	const bubble = document.createElement('div');
	bubble.classList.add('bubble');
	bubble.style.setProperty('--size', `${2 + Math.random() * 4}rem`);
	bubble.style.setProperty('--distance', `${6 + Math.random() * 4}rem`);
	bubble.style.setProperty('--position', `${-5 + Math.random() * 110}%`);
	bubble.style.setProperty('--time', `${2 + Math.random() * 2}s`);
	bubble.style.setProperty('--delay', `${-1 * (2 + Math.random() * 2)}s`);

	bubblesContainer.appendChild(bubble);
}

