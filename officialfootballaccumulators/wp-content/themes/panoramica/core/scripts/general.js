/* Formats Twitter Messages with hyperlinks */
function format_twitter_message(str){
	str=' '+str;
	str = str.replace(/((ftp|https?):\/\/([-\w\.]+)+(:\d+)?(\/([\w/_\.]*(\?\S+)?)?)?)/gm,'<a href="$1" target="_blank">$1</a>');
	str = str.replace(/([^\w])\@([\w\-]+)/gm,'$1@<a href="http://twitter.com/$2" target="_blank">$2</a>');
	str = str.replace(/([^\w])\#([\w\-]+)/gm,'$1<a href="http://twitter.com/search?q=%23$2" target="_blank">#$2</a>');
	return str;
}

jQuery(document).ready(function(){
    //DEFAULT WORDPRESS GALLERY LIGHTBOX
	jQuery("a[rel^='gallery']").prettyPhoto({
		show_title: false,
		overlay_gallery: false,
		theme: 'pp_default',
		social_tools: false
	});
	
	//INLINE SLIDESHOWS
	jQuery('.inline_slider').cycle({
        fx: 'fade',
		pause: true,
		pauseOnPagerHover: true
    });
	
	
	if(jQuery('.accordion').length){
		jQuery('.accordion').each(function(){
			var accordion = jQuery(this);
			accordion.find('.accordion_title').click(function(){
				accordion.find('.accordion_content').toggle(300);
			});
		});
	}
	
	/*jQuery('.tabs').each(function(){
		var container = jQuery(this);
		var defaults = { heading: '.tab', content:'.tab_content' };
		var options = jQuery.extend(defaults, options);
	
		var tabs = jQuery(options.heading, container);
		var content = jQuery(options.content, container);
		var initialOpen = 1;
		
		// sort tabs
		if(tabs.length < 2) return;

				
		tabs.prependTo(container).each(function(i){
			var tab = jQuery(this);
			
			//set default tab to open
				if(initialOpen == (i+1)){
					tab.addClass('active_tab');
					content.filter(':eq('+i+')').addClass('active_tab_content');
				}
		
			tab.bind('click', function(){
				if(!tab.is('.active_tab')){
					jQuery('.active_tab', container).removeClass('active_tab');
					jQuery('.active_tab_content', container).removeClass('active_tab_content');
					
					tab.addClass('active_tab');
					content.filter(':eq('+i+')').addClass('active_tab_content');
				}
				return false;
			});
		});
	}*/
});