$(document).ready(function(){
//Fix Errors - http://www.learningjquery.com/2009/01/quick-tip-prevent-animation-queue-buildup/
//Remove outline from links
$("a").click(function(){
$(this).blur();
});
//When mouse rolls over
$("#menu li").mouseover(function(){
$(this).stop().animate({height:'130px'},{queue:false, duration:600, easing: 'easeOutBounce'})
});
//When mouse is removed
$("#menu li").mouseout(function(){
$(this).stop().animate({height:'27px'},{queue:false, duration:600, easing: 'easeOutBounce'})
});


$(".rss").mouseover(function(){
$(this).stop().animate({height:'160px'},{queue:false, duration:600, easing: 'easeOutBounce'})
});

$(".rss").mouseout(function(){
$(this).stop().animate({height:'30px'},{queue:false, duration:600, easing: 'easeOutBounce'})
});
});