$(function(){
	//全站下拉式選單
	$(document).on('mouseenter', '.header .leftNav .navLi', function(){
		$(".header .leftNav .navLi").removeClass("hoverIn");
		$(this).addClass("hoverIn");
		$(this).addClass("hover");
		if($(this).hasClass("about") == true){
			$(".headerDown .headerDownBlock.about").addClass("hover");
		}
		else if($(this).hasClass("brand") == true){
			$(".headerDown .headerDownBlock.brand").addClass("hover");
		}
	});
	$(document).on('mouseenter', '.headerDown .headerDownBlock', function(){
		$(this).addClass("hoverIn");
	});
	//全站下拉式選單
	$(document).on('mouseleave', '.header .leftNav .navLi', function(){
		setTimeout(function(){
			if($(".headerDown .headerDownBlock").hasClass("hoverIn") == false){
				$(".headerDown .headerDownBlock").removeClass("hover");
				$(".header .leftNav .navLi").removeClass("hover");
			}
			$(".headerDown .headerDownBlock").removeClass("hoverIn");
		}, 1);
	});
	$(document).on('mouseleave', '.headerDown .headerDownBlock', function(){
		$(".header .leftNav .navLi").removeClass("hoverIn");
		setTimeout(function(){
			if($(".header .leftNav .navLi").hasClass("hoverIn") == false){
				$(".headerDown .headerDownBlock").removeClass("hover");
				$(".header .leftNav .navLi").removeClass("hover");
			}
		}, 1);
	});
	
	//top回到頂端
	$(document).on('click', '.top', function(){
		$("html,body").animate({scrollTop: 0}, 1000, 'swing');
	});
	//top回到頂端
	$(document).on('click', '.productBg .productContentTitleSpan .title', function(){
		$(".productBg .productContentTitleSpan .title").removeClass("click");
		$(this).addClass("click");
		$(".productBg .qAndAArea, .productBg .productArea").removeClass("displaynone displayblock");
		if($(this).hasClass("product") == true){
			$(".productBg .productArea").addClass("displayblock");
			$(".productBg .qAndAArea").addClass("displaynone");
		}
		else if($(this).hasClass("qAndA") == true){
			$(".productBg .qAndAArea").addClass("displayblock");
			$(".productBg .productArea").addClass("displaynone");
		}
		$("html,body").animate({scrollTop: 500}, 1000, 'swing');
	});
});