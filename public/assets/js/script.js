/*
Author       : Dreamguys
Template Name: Dreamschat - Bootstrap Chat Template
Version      : 1.0
*/

(function($) {
    "use strict";

    var $slimScrolls = $('.slimscroll');

    // Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height();
		$slimScrolls.height(wHeight);
		$('.left-sidebar .slimScrollDiv, .sidebar-menu .slimScrollDiv, .sidebar-menu .slimScrollDiv').height(wHeight);
		$('.right-sidebar .slimScrollDiv').height(wHeight - 30);
		$('.chat .slimScrollDiv').height(wHeight - 70);
		$('.chat.settings-main .slimScrollDiv').height(wHeight);
		$('.right-sidebar.video-right-sidebar .slimScrollDiv').height(wHeight - 90);
		$(window).resize(function() {
			var rHeight = $(window).height();
			$slimScrolls.height(rHeight);
			$('.left-sidebar .slimScrollDiv, .sidebar-menu .slimScrollDiv, .sidebar-menu .slimScrollDiv').height(rHeight);
			$('.right-sidebar .slimScrollDiv').height(wHeight - 30);
			$('.chat .slimScrollDiv').height(rHeight - 70);
			$('.chat.settings-main .slimScrollDiv').height(wHeight);
			$('.right-sidebar.video-right-sidebar .slimScrollDiv').height(wHeight - 90);
		});
	}

	$("#search-contact").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#chatsidebar ul li").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$(".left_sides").on('click', function () {
		if ($(window).width() <= 991) {
			$('.sidebar-group').removeClass('hide-left-sidebar');
			$('.sidebar-menu').removeClass('d-none');
		}
	});
	$(".user-list li a").on('click', function () {
		if ($(window).width() <= 767) {
			$('.left-sidebar').addClass('hide-left-sidebar');
				$('.sidebar-menu').addClass('d-none');
		}
	});
		

	jQuery(window).on('load resize', function () {

		// Variable Declarations

		var right_sidebar = $('.right-sidebar').width();
		var left_sidebar = $('.left-sidebar').width();
		var chat_bar = $('.chat').width();
		var win_width = $(window).width();

		$(".user-list-item:not(body.status-page .user-list-item, body.voice-call-page .user-list-item)").on('click', function () {
			if ($(window).width() < 992) {
				$('.left-sidebar').addClass('hide-left-sidebar');
				$('.chat').addClass('show-chatbar');
			}
			
		});
				
		$(".group-left-setting").on('click', function () {
			$('.right_side_group').addClass('show-right-sidebar');
			$('.right_side_group').removeClass('hide-right-sidebar');
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.chat-options ').addClass('chat-small');
		});
		$(".remove-group-message").on('click', function () {
			$('.right_side_group').addClass('hide-right-sidebar');
			$('.right_side_group').removeClass('show-right-sidebar');
			$('.chat-options ').removeClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});

		$(".star-message-left").on('click', function () {
			$('.right_side_star').addClass('show-right-sidebar');
			$('.right_side_star').removeClass('hide-right-sidebar');
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
			$('.chat-options ').addClass('chat-small');
		});
		$(".remove-star-message").on('click', function () {
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			$('.chat-options ').removeClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});

		$(".message-info-left").on('click', function () {
			$('.right_sidebar_info').addClass('show-right-sidebar');
			$('.right_sidebar_info').removeClass('hide-right-sidebar');
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			$('.right_side_group').addClass('hide-right-sidebar');
			$('.right_side_group').removeClass('show-right-sidebar');
			$('.chat-options ').addClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat:not(.right_sidebar_info .chat)").css('margin-left', - chat_bar);
			}
			if ($(window).width() < 992) {
				$('.chat:not(.right_sidebar_info .chat)').addClass('hide-chatbar');
			}
		});
		$(".remove-message-info").on('click', function () {
			$('.right_sidebar_info').addClass('hide-right-sidebar');
			$('.right_sidebar_info').removeClass('show-right-sidebar');
			$('.chat-options ').removeClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});

		$(".dream_profile_menu").on('click', function () {
			$('.right-side-contact').addClass('show-right-sidebar');
			$('.right-side-contact').removeClass('hide-right-sidebar');
			$('.right_sidebar_info').addClass('hide-right-sidebar');
			$('.right_sidebar_info').removeClass('show-right-sidebar');
			$('.right_side_star').addClass('hide-right-sidebar');
			$('.right_side_star').removeClass('show-right-sidebar');
			$('.video-right-sidebar').addClass('show-right-sidebar');
			$('.video-right-sidebar').removeClass('hide-right-sidebar');
			$('.chat-options ').addClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat:not(.right-side-contact .chat)").css('margin-left', - chat_bar);
				$(".chat:not(.right_side_star .chat)").css('margin-left', - chat_bar);
				$('.left-sidebar').hide();
				$('.chat').css("margin-left", "0");

			}
			if ($(window).width() < 992) {
				$('.chat:not(.right-side-contact .chat)').addClass('hide-chatbar');
				$('.chat:not(.right_side_star .chat)').addClass('hide-chatbar');
			}
		});

		$(".close_profile").on('click', function () {
			$('.right-side-contact').addClass('hide-right-sidebar');
			$('.right-side-contact').removeClass('show-right-sidebar');
			$('.video-right-sidebar').addClass('hide-right-sidebar');
			$('.video-right-sidebar').removeClass('show-right-sidebar');
			$('.chat-options ').removeClass('chat-small');
			if ( $(window).width() > 991 && $(window).width() < 1201) {
				$(".chat").css('margin-left', 0);
			}
			if ($(window).width() < 992) {
				$('.chat').removeClass('hide-chatbar');
			}
		});
		$(".nav-tabs a").on('click', function () {
			$(this).tab('show');
		});

		$(".chat-header .left_side i, .page-header .left_side i").on('click', function () {
			$('.left-sidebar').removeClass('hide-left-sidebar');
			$('.chat').removeClass('show-chatbar');
			$('.sidebar-menu').removeClass('d-none');
		});
			
	});

	// Emoj Add

	if($('.emoj-action').length > 0) {
		$(".emoj-action").on('click', function () {
			$('.emoj-group-list').toggle();
		});
	}
	if($('.emoj-action-foot').length > 0) {
		$(".emoj-action-foot").on('click', function () {
			$('.emoj-group-list-foot').toggle();
		});
	}
	
	// Password

	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	// New-Password

	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-passwords', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".pass-inputs");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	// Confirm-Password
	if($('.toggle-password').length > 0) {
		$(document).on('click', '.conform-toggle-password', function() {
			$(this).toggleClass("fa-solid fa-eye fa-solid fa-eye-slash");
			var input = $(".conform-pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	// Rightside Accordian

	$('.accordion-col .accordion-title').on('click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass('active');
	});
	
	
	$('.status-show').on('click', function () {
		$('.solo-sidebar').addClass('d-none');
		$('.status-solo-sidebar').removeClass('d-none');

	});

	// Custom Modal
	$('*[data-target="#status-modal"]').on('click', function () {
		$('body').addClass('custom-model-open');
	});
	$('.custom-status-close').on('click', function () {
		$('body').removeClass('custom-model-open');
	});
	
	// Tooltip

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl)
	})

	//Top Online Contacts

	if($('.top-online-contacts .swiper-container').length > 0 ){
		var swiper = new Swiper('.top-online-contacts .swiper-container', {
	      	slidesPerView: 5,
	      	spaceBetween: 15,
	    });
	}

	// Datetimepicker Date
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
		});
	}

	//New Group

	$('#next-parti').on('click', function () {
		$('.parti-group').addClass('show-participant');
		$('.parti-group').removeClass('hash-participant');
		$('.new-group-add').addClass('hash-group');
		$('.new-group-add').removeClass('show-group-add');
	});
	$('#previous-group').on('click', function () {
		$('.parti-group').addClass('hash-participant');
		$('.parti-group').removeClass('show-participant');
		$('.new-group-add').addClass('show-group-add');
		$('.new-group-add').removeClass('hash-group ');
	});

	// Chat Search Visible

	$('.chat-search-btn').on('click', function () {
		$('.chat-search').addClass('visible-chat');
	});
	$('.close-btn-chat').on('click', function () {
		$('.chat-search').removeClass('visible-chat');
	});
	$(".chat-search .form-control").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(".chat .chat-body .messages .chats").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	// Chat Search Visible

	$('.user-chat-search-btn').on('click', function () {
		$('.user-chat-search').addClass('visible-chat');
	});
	$('.user-close-btn-chat').on('click', function () {
		$('.user-chat-search').removeClass('visible-chat');
	});

	// Otp Verfication

	$('.digit-group').find('input').each(function() {
	$(this).attr('maxlength', 1);
		$(this).on('keyup', function(e) {
			var parent = $($(this).parent());

			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + $(this).data('previous'));
				
				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + $(this).data('next'));
				
				if(next.length) {
					$(next).select();
				} else {
					if(parent.data('autosubmit')) {
						parent.submit();
					}
				}
			}
		});
	});

	$('.digit-group input').on('keyup', function(){
	    var self = $(this);
	    if ( self.val() != '' ) {
	        self.addClass('active');
	    } else {
	        self.removeClass('active');
	    }
	});
	
	// Custom Country Code Selector

	if($('#phone').length > 0) {
		var input = document.querySelector("#phone");
			window.intlTelInput(input, {
			  utilsScript: "assets/plugins/intltelinput/js/utils.js",
		}); 
	}

	// Select 2

	if ($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}

	// Mute Audio
	
	if($('.mute-bt').length > 0) {
		$(".mute-bt").on('click', function(){
			if($(this).hasClass("stop")) {
				$(this).removeClass("stop");
				$(".mute-bt i").removeClass("feather-mic-off");
				$(".mute-bt i").addClass("feather-mic");
				$(this).attr("data-bs-original-title","Mute Audio");
				$(".join-video.user-active .more-icon").removeClass("mic-view");
				
				$(".action-info.vid-view li .mute-mic i").removeClass("feather-mic-off");
				$(".action-info.vid-view li .mute-mic i").addClass("feather-mic");
			}
			else{
				$(this).addClass("stop");
				$(".mute-bt i").removeClass("feather-mic");
				$(".mute-bt i").addClass("feather-mic-off");
				$(this).attr("data-bs-original-title","Unmute Audio");				
				$(".join-video.user-active .more-icon").addClass("mic-view");
				
				$(".add-list .user-active .action-info").addClass("vid-view");
				$(".action-info.vid-view li .mute-mic i").removeClass("feather-mic");
				$(".action-info.vid-view li .mute-mic i").addClass("feather-mic-off");
			}
		});
	}

	// Theme Image

	$('.wall-img').on('click', function(){
		$('.wall-img').removeClass('active');
		$(this).addClass('active');
	});

	// Mute Video
	
	if($('.mute-video').length > 0) {
		$(".mute-video").on('click', function(){
			if($(this).hasClass("stop")) {
				$(this).removeClass("stop");
				$(".mute-video i").removeClass("feather-video-off");
				$(".mute-video i").addClass("feather-video");
				$(".join-call .join-video").removeClass("video-hide");
				$(".video-avatar").removeClass("active");
				$(this).attr("data-bs-original-title","Stop Camera");
				$(".meeting .join-video.user-active").removeClass("video-hide");
				
				$(".join-video.user-active .more-icon").removeClass("vid-view");				
				$(".action-info.vid-view li .mute-vid i").removeClass("feather-video-off");
				$(".action-info.vid-view li .mute-vid i").addClass("feather-video");
			}
			else{
				$(this).addClass("stop");
				$(".mute-video i").removeClass("feather-video");
				$(".mute-video i").addClass("feather-video-off");
				$(".join-call .join-video").addClass("video-hide");
				$(".video-avatar").addClass("active");
				$(this).attr("data-bs-original-title","Start Camera");
				$(".meeting .join-video.user-active").addClass("video-hide");
				
				$(".add-list .user-active .action-info").addClass("vid-view");
				$(".action-info.vid-view li .mute-vid i").removeClass("feather-video");
				$(".action-info.vid-view li .mute-vid i").addClass("feather-video-off");
			}
		});
	}

	if($('.main-wrapper').length > 0) {
        document.getElementsByClassName("main-wrapper")[0].style.visibility = "visible";
    }

	// Dark Mode
	if($('#dark-mode-toggle').length > 0) {
		document.getElementById('dark-mode-toggle').onclick=function() {
			document.body.classList.add('darkmode');
			this.classList.remove('active');
			document.getElementById('light-mode-toggle').classList.add('active');
			localStorage.setItem('darkMode', 'enabled');
			
		}
	}
	if($('#light-mode-toggle').length > 0) {
		document.getElementById('light-mode-toggle').onclick=function() {
			document.body.classList.remove('darkmode');
			this.classList.remove('active');
			document.getElementById('dark-mode-toggle').classList.add('active');
			localStorage.setItem('darkMode', null);
		}
	}
	if($('.bottom-menus').length > 0) {
		document.addEventListener("DOMContentLoaded", function(event) {
			let darkMode = localStorage.getItem('darkMode'); 
			if (darkMode == 'enabled') {
				document.body.classList.add('darkmode');
				document.getElementById('dark-mode-toggle').classList.remove('active');
				document.getElementById('light-mode-toggle').classList.add('active');
				localStorage.setItem('darkMode', 'enabled');
			} else {  
				document.body.classList.remove('darkmode');
				document.getElementById('light-mode-toggle').classList.remove('active');
				document.getElementById('dark-mode-toggle').classList.add('active');
				localStorage.setItem('darkMode', null);
			}
		});
	}

	if($('.chat-page-group').length > 0) {
		var clickStar = document.querySelector('.click-star');
		var msgStar = document.querySelector('.msg-star');
		var starMsg = document.querySelector('.star-msg');
	
		clickStar.onclick = function(){
			if(msgStar.classList.value.includes("d-none")){
				msgStar.classList.add("d-inline"); 	 
				msgStar.classList.remove("d-none");
				starMsg.innerHTML= "Unstar Message"
			}else{
				msgStar.classList.remove("d-inline"); 	 
				msgStar.classList.add("d-none");
				starMsg.innerHTML= "Star Message"
			}
			
		}
		var clickStarOne = document.querySelector('.click-star-one');
		var msgStarOne = document.querySelector('.msg-star-one');
		var starMsgOne = document.querySelector('.star-msg-one');
	
		clickStarOne.onclick = function(){
			if(msgStarOne.classList.value.includes("d-none")){
				msgStarOne.classList.add("d-inline"); 	 
				msgStarOne.classList.remove("d-none");
				starMsgOne.innerHTML= "Unstar Message"
			}else{
				msgStarOne.classList.remove("d-inline"); 	 
				msgStarOne.classList.add("d-none");
				starMsgOne.innerHTML= "Star Message"
			}
			
		}
		var clickStarThree = document.querySelector('.click-star-three');
		var msgStarThree = document.querySelector('.msg-star-three');
		var starMsgThree = document.querySelector('.star-msg-three');
	
		clickStarThree.onclick = function(){
			if(msgStarThree.classList.value.includes("d-none")){
				msgStarThree.classList.add("d-inline"); 	 
				msgStarThree.classList.remove("d-none");
				starMsgThree.innerHTML= "Unstar Message"
			}else{
				msgStarThree.classList.remove("d-inline"); 	 
				msgStarThree.classList.add("d-none");
				starMsgThree.innerHTML= "Star Message"
			}
			
		}
		var clickStarFour = document.querySelector('.click-star-four');
		var msgStarFour = document.querySelector('.msg-star-four');
		var starMsgFour = document.querySelector('.star-msg-four');
	
		clickStarFour.onclick = function(){
			if(msgStarFour.classList.value.includes("d-none")){
				msgStarFour.classList.add("d-inline"); 	 
				msgStarFour.classList.remove("d-none");
				starMsgFour.innerHTML= "Unstar Message"
			}else{
				msgStarFour.classList.remove("d-inline"); 	 
				msgStarFour.classList.add("d-none");
				starMsgFour.innerHTML= "Star Message"
			}
			
		}
		var clickStarFive = document.querySelector('.click-star-five');
		var msgStarFive = document.querySelector('.msg-star-five');
		var starMsgFive = document.querySelector('.star-msg-five');
	
		clickStarFive.onclick = function(){
			if(msgStarFive.classList.value.includes("d-none")){
				msgStarFive.classList.add("d-inline"); 	 
				msgStarFive.classList.remove("d-none");
				starMsgFive.innerHTML= "Unstar Message"
			}else{
				msgStarFive.classList.remove("d-inline"); 	 
				msgStarFive.classList.add("d-none");
				starMsgFive.innerHTML= "Star Message"
			}
			
		}
	
		var replyButton = document.querySelectorAll('.reply-button');
		var replyContent = document.querySelector('.reply-content');
		var replyDiv = document.querySelector('.reply-div');
		document.querySelector('.close-replay').onclick = function(){
			replyDiv.classList.remove("d-flex");
			replyDiv.classList.add("d-none"); 
		}
		replyButton.forEach(function(button) {
			button.addEventListener('click', handleButtonClick);
		});
		function handleButtonClick(event) {
			replyDiv.classList.add("d-flex");
			replyDiv.classList.remove("d-none");
			replyContent.innerHTML = "Thank you for your support";
		}
	}
	

 })(jQuery);

if($('#volume').length > 0 ){
	$("#volume").slider({
	  	min: 0,
	  	max: 100,
	  	orientation: "vertical",
	  	value: 0,
			range: "min",
	  	slide: function(event, ui) {
	    	setVolume(ui.value / 100);
	  	}
		});
		
		var myMedia = document.createElement('audio');
		$('#player').append(myMedia);
		myMedia.id = "myMedia";
		
		function playAudio(fileName, myVolume) {
				myMedia.src = fileName;
				myMedia.setAttribute('loop', 'loop');
	    	setVolume(myVolume);
	    	myMedia.play();
		}
		
		function setVolume(myVolume) {
	    var myMedia = document.getElementById('myMedia');
	    myMedia.volume = myVolume;
	}
}
