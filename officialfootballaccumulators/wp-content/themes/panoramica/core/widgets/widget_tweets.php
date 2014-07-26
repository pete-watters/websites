<?php

class Cpotheme_Widget_TwitterStream extends WP_Widget{
	
	function Cpotheme_Widget_TwitterStream(){
		$widget_ops = array('classname' => 'cpotheme_twitter_stream', 'description' => __('Displays the latest tweets for a specific Twitter user.', 'cpotheme'));
		$this->WP_Widget('cpotheme-twitter-stream', __('CPO - Twitter Stream', 'cpotheme'), $widget_ops);
		$this->alt_option_name = 'cpotheme_twitter_stream';
	}

	function widget($args, $instance){

		extract($args);
		$widget_id = str_replace('-', '_', $widget_id);
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		$username = strip_tags($instance['username']);
		if(!is_numeric($number)) $number = 5; elseif($number < 1) $number = 1; elseif($number > 99) $number = 99;

		
		echo $before_widget;
		if($title != '') echo $before_title.$title.$after_title; ?>
				
		<ul class="twitter_stream" id="twitter-stream-<?php echo $widget_id; ?>">
			<li></li>
		</ul>
		<a href="http://twitter.com/<?php echo $username; ?>">@<?php echo $username; ?></a> <?php _e('on Twitter', 'cpotheme'); ?>
		
		<script type="text/javascript">
			function cpotheme_display_tweets_<?php echo $widget_id; ?>(tweets) {

				var statusHTML = [];
				for(var i=0; i < tweets.length; i++){
					var username = tweets[i].user.screen_name;
					var message = format_twitter_message(tweets[i].text);
					statusHTML.push('<li class="tweet"><div class="content">'+message+'</div> <a href="http://twitter.com/'+username+'/statuses/'+tweets[i].id_str+'">'+humanize_time_<?php echo $widget_id; ?>(tweets[i].created_at)+'</a></li>');
				}
				document.getElementById('twitter-stream-<?php echo $widget_id; ?>').innerHTML = statusHTML.join('');
			}

			function humanize_time_<?php echo $widget_id; ?>(time_value){
				var values = time_value.split(" ");
				time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
				var parsed_date = Date.parse(time_value);
				var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
				var time_difference = parseInt((relative_to.getTime() - parsed_date) / 1000);
				time_difference = time_difference + (relative_to.getTimezoneOffset() * 60);

				if(time_difference < 120){ return '<?php _e('A minute ago', 'cpotheme'); ?>';
				}else if(time_difference < (60*60)){ return (parseInt(time_difference / 60)).toString() + ' <?php _e('minutes ago', 'cpotheme'); ?>';
				}else if(time_difference < (120*60)){ return '<?php _e('An hour ago', 'cpotheme'); ?>';
				}else if(time_difference < (24*60*60)){ return 'about ' + (parseInt(time_difference / 3600)).toString() + ' <?php _e('hours ago', 'cpotheme'); ?>';
				}else if(time_difference < (48*60*60)){ return '<?php _e('A day ago', 'cpotheme'); ?>';
				}else{ return (parseInt(time_difference / 86400)).toString() + ' <?php _e('days ago', 'cpotheme'); ?>'; }
			}
		</script>
		<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=cpotheme_display_tweets_<?php echo $widget_id; ?>&amp;count=<?php echo $number; ?>&amp;include_rts=t"></script>
		<?php echo $after_widget;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['number'] = (int)$new_instance['number'];
		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		if(!isset($instance['number']) || !$number = (int)$instance['number']) $number = 5; ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'cpotheme'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username', 'cpotheme'); ?></label><br/>
			<input id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Tweets', 'cpotheme'); ?></label><br/>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
	<?php }
}
register_widget('Cpotheme_Widget_TwitterStream'); ?>