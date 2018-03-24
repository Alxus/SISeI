$(document).ready(function() {
  init();
	particlesLoad();
});

function init(){
   $('.parallax').parallax();

}

function particlesLoad(){
	if(isMobile()){
		particlesJS.load("particles-js" , "particlesMobile.json",function () {
			console.log("particlesMobile.json loaded...");
		});
		return;
	}
	particlesJS.load("particles-js" , "particles.json",function () {
		console.log("particles.json loaded...");
	});
	return;
}

function particlesReload(){
	$("#particles-js").empty();
	if($(window).width()>=1024){
		particlesJS.load("particles-js" , "particles.json",function () {
			console.log("particles.json loaded...");
		});
		return;
	}
	particlesJS.load("particles-js" , "particlesMobile.json",function () {
		console.log("particlesMobile.json loaded...");
	});
	return;
}

function isMobile() {
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};
	return isMobile.any();
}
