"use strict";

var intromodalnav = $("#intromodalnavcontainer");
var leftmodalarrow = $("#intromodalarrowleft");
var rightmodalarrow = $("#intromodalarrowright");
var search = $("#searchtext");
var searchclose = $("#searchclose");
var adcontainer = $(".adcontainer");
var adarrow = $(".triangle-right");
var iasm = $(".imageadssolomodal");
var adimages = $('.imageadssolo');
var searchon = false;
var rotation = 0;
var rotationdir = true;
var navmove = false;
var time = 200;
var deltext = $('#response').text();

(function(){
	console.log(deltext);
	function rotateAds(rotation, rotationdir)
	{
		var rotation1;
		var rotation2;
		if (rotationdir == true)
		{	
			$(".intromodalcircle").each(function (index){
				if (index == rotation)
				{
					$(this).animate({
						"opacity":"1"
					},400);
				}
				else
				{
					$(this).stop(true,false);
					$(this).animate({
						"opacity":".6"
					},400);
				}
			});
			$(".modaladscontainer").each(function (index, rotation1){
				if (index == rotation)
				{
					$(this).css({
						"visibility":"visible",
						"right":"100%"
					}).animate({
						"right":"0px"
					},2000);
					$(this).children().css({
						"opacity":'0'
					}).animate({
						"opacity":'1'
					},2000);
				}
				else
				{
					$(this).css({
						"visibility":"hidden"
					});
				}
			});
		}
		else
		{
			$(".intromodalcircle").each(function (index){
				if (index == rotation)
				{
					$(this).animate({
						"opacity":"1"
					},400);
				}
				else
				{
					$(this).stop(true,false);
					$(this).animate({
						"opacity":".6"
					},400);
				}
			});
			$(".modaladscontainer").each(function (index, rotation1){
				if (index == rotation)
				{
					$(this).css({
						"visibility":"visible",
						"left":"100%"
					}).animate({
						"left":"0px"
					},2000);
					$(this).children().css({
						"opacity":'0'
					}).animate({
						"opacity":'1'
					},2000);
				}
				else
				{
					$(this).css({
						"visibility":"hidden"
					});
				}
			});
		}
		
	}
	intromodalnav.animate({
		opacity: "1",
		bottom: "150px"
	},1500, "linear");

	leftmodalarrow.click(function(){
		rotation += -1;
		rotationdir = true;
		if (rotation < 0)
		{
			rotation = 2;
		}
		$(this).stop(true,true);
		$(this).animate({
			"left":"-=20px"
		},300).animate({
			"left":"+=20px"
		},300);
		rotateAds(rotation, rotationdir);
	});
	rightmodalarrow.click(function(){
		rotationdir = false;
		rotation += 1;
		if (rotation > 2)
		{
			rotation = 0;
		}
		$(this).stop(true,true);
		$(this).animate({
			"right":"-=20px"
		},300).animate({
			"right":"+=20px"
		},300);
		rotateAds(rotation, rotationdir);
	});
	/* Various intervals */
	var clickInterval = setInterval(function () {
		var neverreach = true;
	    if (neverreach == true)
	    {
	    	allowclick();
	    }
	}, 100);
	var scrollInterval = setInterval(function(){
		var neverreach = true;
		if (neverreach == true)
		{
			lazyanimate();
		}
	}, 500);
	/* Functions for the view ads page */
	adcontainer.hover(
		function(){
			$(this).children(".triangle-right").animate({
				"left":"0px",
				"opacity":"1"
			},300)
		},
		function(){
			adarrow.animate({
				"left":"-66px",
				"opacity":"0"
			},300)
		}
	);
	adcontainer.each(function (index){
		var that = $(this);
		var cooltime = setTimeout(function (){
			that.animate({
				"opacity":"1"
			},400);
			console.log(that);
		}, time);
		time += 200;
	});
	/* Functions for clicking and UI */
	function lazyanimate(){
		var scroll = $(window).scrollTop();

		if ($("#maincontent").length > 0)
		{
		var barrier = $("#maincontent").offset();
		console.log(barrier.top);
			if (scroll > barrier.top)
			{
				navmove = true;
				navanimate(navmove);
			}
			else
			{
				navmove = false;
				navanimate(navmove);
			}
		}
		else
		{
			var barrier = 300;
			if (scroll > barrier)
			{
				navmove = true;
				navanimate(navmove);
			}
			else
			{
				navmove = false;
				navanimate(navmove);
			}
		}
	};
	function navanimate(move)
	{
		if (move == true)
		{
			$("#navright").stop(true,true);
			$("#navright").animate({
				"top":"-60px"
			},400);
		}
		else if (move == false)
		{
		$("#navright").stop(true,true);
		$("#navright").animate({
			"top":"0px"
		},400);
		}
	}
	function allowclick()
	{
		$("#searchtext").on('click',function(){
			if (searchon == false)
			{
				searchon = true;
				console.log(searchon);
				$("#searchtext").animate({
					"top":"-100px"
				},1000);
				var add = setTimeout(function (){
					$("#searchtext").remove();
					$("#search").append("<form action='/ads.show.php' id='searchcontainer'><div id='searchclose'>X</div><input id='searchfield' type='text' name='item'><input type='image' src='img/site/search-icon.png' style='width:30px;height:30px;' alt='Submit Form' /></form>");
					$("#searchcontainer").css({
						"right":"-280px"
					}).animate({
						"right":"0px"
					}, 1300);
				},1000);
			}
		});
		$("#searchclose").on('click',function(){
			if (searchon == true)
			{
				searchon = false;
				console.log("Alright Closing");
				console.log(searchon);
				$("#searchcontainer").animate({
					"right":"-280px"
				}, 1300);
				var add = setTimeout(function (){
					$("#searchcontainer").remove();
					$("#search").append('<p id="searchtext" class="toplinkcenter">Search</p>');
					$("#searchtext").css({
						"top":"-100px"
					}).animate({
						"top":"0px"
					}, 1000);
				},1300);
			}
		});
	}
	/* Functions for clicking the images on a single ad page with multiple images */
	iasm.click( function(){
		var thisindex = $(this).index();
		console.log(thisindex);
		iasm.each( function (index){
			if (thisindex == index)
			{
				$(this).addClass('imageadssoloborder');
				$(this).animate({
					"opacity":"1"
				},200);
			}
			else
			{
				$(this).removeClass('imageadssoloborder');
				$(this).animate({
					"opacity":".6"
				},200);
			}
		});
		adimages.each(function (index){
			if (thisindex == index)
			{
				$(this).animate({
					"opacity":"1"
				},200);
				$(this).addClass('imageadsdisplayed');
				$(this).removeClass('imageadshidden');
			}
			else
			{
				$(this).animate({
					"opacity":"0"
				},200);
				$(this).removeClass('imageadsdisplayed');
				$(this).addClass('imageadshidden');
			}
		});
	});
	iasm.each( function (index){
		if ($(this).hasClass('imageadssoloborder'))
		{
			$(this).animate({
				"opacity":"1"
			},200);
		}
	});
	/* Yes, this is incredibly messy! All of it is! But it just werks!*/
	/*The Delete function in all its glory. */
	$('#deletead').click(function (){
		$("#bottomlinkcontainer").append('<div id="yesbye" class="bottomlinks"><a href=/ads.delete.php?itemid='+deltext+'&delete=yes>Yes</a></div><div id="nobye" class="bottomlinks">No</div>');
	});
	lazyanimate();
})();