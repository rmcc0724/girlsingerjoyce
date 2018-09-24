$=jQuery.noConflict();

// inner variables
var song;
var tracker = $('.psap_tracker');
var volume = $('.psap_volume');
// initialization - first element in playlist
initAudio($('.psap_playlist li:first-child'));
// set volume
song.volume = 0.8;
// initialize the volume slider
volume.slider({
	range: 'min',
	min: 1,
	max: 100,
	value: 80,
	start: function(event,ui) {},
	slide: function(event, ui) {
		song.volume = ui.value / 100;
	},
	stop: function(event,ui) {},
});
// empty tracker slider
tracker.slider({
	range: 'min',
	min: 0, 
	max: 10,
	start: function(event,ui) {},
	slide: function(event, ui) {
		song.currentTime = ui.value;
	},
	stop: function(event,ui) {}
});

function initAudio(elem) {
	var url = elem.attr('audiourl');
	var title = elem.text();
	var cover = elem.attr('cover');
	var artist = elem.attr('artist');
	$('.psap_player .psap_title').text(title);
	$('.psap_player .psap_artist').text(artist);
	$('.psap_player .psap_cover').css('background-image','url(' + cover + ')');
	song = new Audio(url);
	// timeupdate event listener
	song.addEventListener('timeupdate',function (){
		var curtime = parseInt(song.currentTime, 10);
		tracker.slider('value', curtime);
	});
	$('.psap_playlist li').removeClass('active');
	elem.addClass('active');
}

function playAudio() {
	song.play();
	updateMaxSlider();
	$('.psap_play').addClass('psap_hidden');
	$('.psap_pause').addClass('psap_visible');
	window.updateTimer = setInterval(updateMaxSlider, 2000);
}

function updateMaxSlider() {
	if (song.duration == "Infinity")
	{
		tracker.slider("option", "max", 300);
	}else{
		tracker.slider("option", "max", song.duration);
		clearInterval(window.updateTimer);
	}		
}

function stopAudio() {
	song.pause();
	$('.psap_play').removeClass('psap_hidden');
	$('.psap_pause').removeClass('psap_visible');
}

// play click
$('.psap_play').click(function (e) {
	e.preventDefault();
	playAudio();
});

// pause click
$('.psap_pause').click(function (e) {
	e.preventDefault();
	stopAudio();
});

// forward click
$('.psap_fwd').click(function (e) {
	e.preventDefault();
	stopAudio();
	var next = $('.psap_playlist li.active').next();
	if (next.length == 0) {
		next = $('.psap_playlist li:first-child');
	}
	initAudio(next);
});

// rewind click
$('.psap_rew').click(function (e) {
	e.preventDefault();
	stopAudio();
	var prev = $('.psap_playlist li.active').prev();
	if (prev.length == 0) {
		prev = $('.psap_playlist li:last-child');
	}
	initAudio(prev);
});


// show playlist
$('.psap_pl').click(function (e) {
	e.preventDefault();
	$('.psap_playlist').fadeToggle(300);
});

// playlist elements - click
$('.psap_playlist li').click(function () {
	stopAudio();
	initAudio($(this));
});

