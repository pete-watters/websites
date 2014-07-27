<form method="get" action="<?php bloginfo('url'); ?>/">
  <input type="text" value="<?php the_search_query(); ?>" name="s" id="searchform" size="70%" class="input_text" />
  <input type="submit" id="submit" value="<?php _e('Cauta'); ?>" />
</form>  