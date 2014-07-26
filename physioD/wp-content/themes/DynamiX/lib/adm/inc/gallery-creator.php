<?php if(get_option('medialib_disable')=='enable'||get_option('medialib_disable')=='') { ?>
<script type="text/javascript">
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('0(12).1r(4(){0(\'.1q\').1o(4(){0(7).r(\'#s-1n\').1d()});0(\'.z-C.1c\').F().G(H).M(g);0(".s-1b").n(4(){i(0("#P").9()!=""){q 19}0(\'.z-C.8\').F().G(H).M(g);q 18});u();v()});4 u(){0(\'.w-2-3\').17(4(){0(\'.2-3\').h();0(7).16().B(\'<5 6="2-3"><E><j 6="2-3-j"><k><e>15 14 13</e><e><L 6="2-l"></L><1a Q="O" N="O" R="S" T="1" /> U V / W</e></k></j></E><5 N="2-3"><5 6="X-Y"></5></5></5>\');0(\'.2-3\').Z({10:\'11\'},g);$f=0(\'#2-3-K\').9();0("#2-3").J($f+"/I/A/y/2-3.t",4(a,b,c){i(b=="8"){D d="1e 1f 1g 1h 1i 8: ";0("#8").1j(d+c.1k+" "+c.1l)}});0(\'.2-l\').n(4(){0(\'5.2-3\').h()})})}4 v(){0(\'.w-2-3\').1m(4(){D a=0(7).9();i(a){$x=0(7).r(\'k\').o(\'.1p\');0(7).o(\'.m-p\').h();0($x).B(\'<5 6="m-p"><1s 1t="\'+a+\'" /></5>\')}})}4 1u(a){$f=0(\'#2-3-K\').9();0("#2-3").J($f+\'/I/A/y/2-3.t?1v=\'+a)}',62,94,'jQuery||media|list|function|div|class|this|error|val|||||th|media_list_url|400|remove|if|thead|tr|close|preview|click|find|image|return|closest|slideset|php|get_media_list|display_image|get|place_img|inc|alertbox|adm|append|wrap|var|table|fadeIn|delay|4000|lib|load|url|span|slideUp|id|addtitledesc|slideset_id_id|name|type|checkbox|value|Add|Title|Description|ajax|loader|animate|width|show|document|Images|Library|Media|parent|focus|false|true|input|save|green|submit|Sorry|but|there|was|an|html|status|statusText|each|dataselect|change|slider_img_wrap|slideset_select|ready|img|src|load_pagination|page'.split('|'),0,{}))
</script>
<?php }
settings_fields( 'gallery-settings-group' );

$filter_categories_str = maybe_unserialize(get_option('filter_categories'));

if (!$get_slideset_num) {
	 $get_slideset_num = 1;
}

$chk_gallery_data = maybe_unserialize(get_option('slideset_data')); // check is pre 2.8.2 version
$get_gallery_version_data = maybe_unserialize(get_option('slideset_data_update')); // check is pre 2.8.2 version
$slideset_data_ids  = substr(maybe_unserialize(get_option('slideset_data_ids')), 0, -1);  // trim last comma
$slideset_data_ids = explode(",", $slideset_data_ids);

if($_POST['slideset_select']) $slideset_select = $_POST['slideset_select'];

if($slideset_select) $get_gallery_data = maybe_unserialize(get_option('slideset_data_'.$slideset_select)); 
?>
<div class="wrap gallerycreator">
<input name="media-list-url" id="media-list-url" type="hidden" value="<?php bloginfo('template_directory'); ?>" />
		<p>
        <div class="alertbox-wrap error">
            <div class="alertbox">
            <p>You must enter a unique name for the Slide Set ID.</p>
            </div>
		</div> 
        </p>
		<?php 
		if(!$get_gallery_version_data && $chk_gallery_data) { ?>
		<p>&nbsp;</p>
		<div class="alertbox-wrap">
		<div class="alertbox">
        <p>The functionality of this system has changed. Your Gallery Slide Set data needs to be upgraded, please click the upgrade button to proceed.</p>
		</div>
		</div>
		<form method="post" id="slideset-upgrade" action="">
		<p><input type="submit" class="button-secondary" value="Upgrade Slide Set Data" name="upgrade" /></p>
		
		</form>
		<?php } else { 
		
		if ( $_POST['delete'] && $_POST['slideset_id_dbid']  ) { ?>
		<p>       
		<div class="alertbox-wrap green">
    		<div class="alertbox green">
            <p>Slide Set was successfully deleted.</p>
    		</div>
		</div>		
		</p>
		<?php } elseif($_POST['save']) { ?>
		<p>
		<div class="alertbox-wrap green">
    		<div class="alertbox green">
            <p>Slide Set was successfully saved.</p>
    		</div>
		</div>		
		</p>		
		<?php } ?>
		<form method="post" id="slideset-dataselect" action="">
		<table class="widefat" style="margin-top:20px;">
            <thead>
                <tr style="cursor: move;">
                    <th class="nowrap">
                       <label>Select Slide Set </label>
					   <select style="margin-left:10px;" class="slideset_select" id="slideset_select" name="slideset_select">
					   <option value="">Select Slide Set</option>
                       <?php
					   
					   	if($slideset_data_ids) {
						
               			if(is_array($slideset_data_ids)) {
                        		foreach ($slideset_data_ids as $slideset_data_ids) {
                        		echo"<option value='". $slideset_data_ids ."'>". $slideset_data_ids ."</option>";
                        		}
               			} else {
               			    echo"<option value='". $slideset_data_ids ."'>". $slideset_data_ids ."</option>";
               			}	
               		}	

               			?>
                       </select> <input type="submit" class="button-primary add_gal" value="New Slide Set" />	
					</th>
					<th class="nowrap" style="text-align:right">
					   <label>New Filter Category: </label><input name="newcategory" class="newcategory" type="text" value="" />
                       <input type="button" class="button-secondary apply adddatacat" id="<?php echo $i; ?>" value="Add Category" />
                       <select style="margin-left:20px;" class="filter_categories_select" id="filter_categories_select" name="filter_categories_select">
                       <?php
               		
               		   $filter_categories = explode(",", $filter_categories_str);
					   if($filter_categories) {
    					   if(is_array($filter_categories)) {
                           		foreach ($filter_categories as $filter_categories) {
                            		echo"<option value='". $filter_categories ."'>". $filter_categories."</option>";
                            	}
    						} else {
                   			    echo"<option value='". $filter_categories ."'>". $filter_categories."</option>";
                   			}	
               			}	
               			?>
                       </select>
                       <input type="button" class="button-secondary apply deldatacat" id="<?php echo $i; ?>" value="Delete Category" />	   
                    </th>
                </tr>
            </thead>
		</table>		
		</form>
        <form method="post" id="slideset-data" action="" style="margin-top:20px;">
		
        <input name="slideset_number" class="slideset_number count_hide_rm" type="hidden" value="<?php echo $get_slideset_num; ?>" />
		<input name="filter_categories" class="filter_categories" type="hidden" value="<?php echo $filter_categories_str; ?>" />
			
        <div class="table_wrap">
		<?php $slide_set = $get_gallery_data['slideset_id_id'];  
		?>
        <input id="slideset_id_dbid" name="slideset_id_dbid" type="hidden" value="<?php echo $slide_set; ?>" />		
        <div id="table-<?php echo $i ?>" class="multitables selected_custom correct_gallery_num">

        <input name="slideset_id_slide_count" id="slideset_id_slide_count" class="slide_counter count_hide_rm correct_num" type="hidden" value="<?php if($get_gallery_data['slideset_id_slide_count']) echo $get_gallery_data['slideset_id_slide_count']; else echo "1";  ?>" />
        <table class="widefat">
            <thead>
                <tr style="cursor: move;">
                    <th>
                    <label style="padding-top:4px;">Slide Set ID:</label> <input style="margin-left:10px;" class="correct_num" id="slideset_id_id" name="slideset_id_id" type="text" value="<?php echo $slide_set; ?>" />
                    </th>
                </tr>
            </thead>
        
            <tfoot>
                <tr>
                    <th></th>
                </tr>
            </tfoot>
            <tr>      
        	<tbody>
            <tr>
                <td>                
                <div>
                <p style="padding:5px 0 5px 0;"><input type="submit" style="float:right" class="button-secondary apply del_gal correct_gallery_num" id="delete" name="delete" value="Delete Slide Set" /><input type="submit" class="button-secondary apply add_row correct_gallery_num" id="" value="Add New Slide" /> <a title="Add an Image" class="button cwz thickbox" href="media-upload.php?type=image&amp;TB_iframe=1&amp;width=640&amp;height=338">Get Image URL</a> </p>                
                <table class="widefat table_sort" tabindex="">
                
                    <thead>
                        <tr style="cursor: move;">
                            <th width="40px">Order</th>
                            <th width="20px">&nbsp;</th>
                            <th width="280px">Setting</th>
                            <th width="280px">Description</th>
                            <th width="280px">&nbsp;</th>
                            <th width="300px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>                    
                
                    <tbody>
                      <?php 
                     
                      $count = $get_gallery_data['slideset_id_slide_count'] +1; 
					  if(!$get_gallery_data['slideset_id_slide_count']) {$count="2";}
                      
					  for($z = 0; $z < $count; $z++) {
                      
					  if($z+1 == $count){ $get_gallery_data=null;}
					  ?>
                    <tr class="multitable multitable_hide_rm<?php if ($z+1 == $count) echo ' hidden'; if($z+1 == $count) echo ' clone_row';?>">
                        
                    <td class="slider_drag media-list-wrap">
                    <div class="slider_img_wrap" style="position:relative"></div>
                      <span class="changenumber"><?php echo $z+1; ?></span>
                    </td>
                      
                    <td>
                      <a href='#' title="Delete Row" tabindex="" class='del_row' id='del_number_<?php echo $z + 1; ?>'><img src="<?php bloginfo('template_directory') ?>/lib/adm/imgs/delete.png" alt="Delete Slide" /></a>
                    </td>
                      
                    <td class="media-list-wrap" style="min-width:320px;">
                      <div style="float:left;width:110px;">Image URL</div>
                      <div style="position:relative">
                      <input class="correct_num get-media-list" id="slideset_id_url_<?php echo $z; ?>" name="slideset_id_url_<?php echo $z; ?>" type="text" value="<?php echo $get_gallery_data['slideset_id_url_'.$z] ?>" /> <br />
                      </div>
                      <div style="float:left;width:110px;">Link URL</div>
                      <input class="correct_num" id="slideset_id_link_<?php echo $z; ?>" name="slideset_id_link_<?php echo $z; ?>" type="text" value="<?php echo $get_gallery_data['slideset_id_link_'.$z] ?>" /><br />
                
                      <div style="float:left;width:110px;">Disable Link Text</div>
                      <?php if($get_gallery_data['slideset_id_disreadmore_'.$z]){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                      <input class="correct_num" type="checkbox" id="slideset_id_disreadmore_<?php echo $z; ?>" name="slideset_id_disreadmore_<?php echo $z; ?>" value="true" <?php echo $checked; ?> /><small class="description">Disable Read More text.</small><br class="clear" />
              
				      
                      <div style="float:left;width:110px;">Image Crop</div>
                      <select class="correct_num" id="slideset_id_crop_<?php echo $z; ?>" name="slideset_id_crop_<?php echo $z; ?>">
                      <?php
                      $crop_image = array("Crop","Zoom","Zoom Crop");
                      foreach ($crop_image as $crop_image) {
                      if ($get_gallery_data['slideset_id_crop_'.$z] == $crop_image && $z+1 != $count){
                      $selected = "selected='selected'";	
                      }else{
                      $selected = "";		
                      }
                      echo"<option $selected value='". $crop_image."'>". $crop_image."</option>";
                      }
                      ?>
                      </select><br />
                      <div style="float:left;width:110px;">Stage Content</div>
                      <select class="correct_num" id="slideset_id_stagecontent_<?php echo $z; ?>" name="slideset_id_stagecontent_<?php echo $z; ?>">
                      <?php
                      $stage_content = array("Image Only","Text/Image (Left Align)","Text/Image (Right Align)","Title Overlay Image","Title / Text Overlay Image","Text Only");
                      foreach ($stage_content as $stage_content) {
                      if ($get_gallery_data['slideset_id_stagecontent_'.$z] == $stage_content && $z+1 != $count){
                      $selected = "selected='selected'";	
                      }else{
                      $selected = "";
                      }
					   echo"<option $selected value='". $stage_content ."'>". $stage_content."</option>";
                      }
                      ?>
                      </select><br />
                      
                    </td>
                      
                    <td>
                    <div style="float:left;width:80px;">Title</div>
                    <input class="correct_num get-media-list-title" id="slideset_id_title_<?php echo $z; ?>" name="slideset_id_title_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_title_'.$z])); ?>" /><br />          
                    <div style="float:left;width:80px;">Description</div><textarea rows="2" class="correct_num get-media-list-desc" id="slideset_id_desc_<?php echo $z; ?>" name="slideset_id_desc_<?php echo $z; ?>"><?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_desc_'.$z])); ?></textarea><br />
                      <div style="float:left;width:80px;">Title Overlay</div>
                      <select class="correct_num" id="slideset_id_overlay_<?php echo $z; ?>" name="slideset_id_overlay_<?php echo $z; ?>">
                      <?php
                      $overlay = array("Disabled","Center Left Light","Center Left Light","Center Middle Light","Center Left Dark","Center Right Dark","Center Middle Dark","Center Left Light","Top Left Light","Top Right Light","Top Middle Light","Top Left Dark","Top Right Dark","Top Middle Dark Text","Bottom Left Light","Bottom Right Light","Bottom Middle Light","Bottom Left Dark","Bottom Right Dark","Bottom Middle Dark");
                      foreach ($overlay as $overlay) {
                      if ($get_gallery_data['slideset_id_overlay_'.$z] == $overlay && $z+1 != $count){
                      $selected = "selected='selected'";	
                      }else{
                      $selected = "";
                      }
                      if($overlay!="Disabled") {
                        echo"<option $selected value='". $overlay."'>". $overlay."</option>";
                      } else {
                        echo"<option $selected value=''>". $overlay."</option>";				  
                      }
                      }
                      ?>
                      </select><br />
                    </td>

                    <td>
                    <div style="float:left;width:80px;">Video URL</div>
                    <input class="correct_num" id="slideset_id_videourl_<?php echo $z; ?>" name="slideset_id_videourl_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_videourl_'.$z])); ?>" /><br />   
                      <div style="float:left;width:80px;">Embed Type</div>
                      <select class="correct_num" id="slideset_id_embed_<?php echo $z; ?>" name="slideset_id_embed_<?php echo $z; ?>">
                      <?php
                      $video_embed = array("Disabled","Vimeo","YouTube","SWF","3dvid","jwp");
                      foreach ($video_embed as $video_embed) {
                      if ($get_gallery_data['slideset_id_embed_'.$z] == $video_embed && $z+1 != $count){
                      $selected = "selected='selected'";	
                      }else{
                      $selected = "";		
                      }
                      if($video_embed!="Disabled") {
					  	if($video_embed=="3dvid") {
					     echo"<option $selected value='". $video_embed."'>Video (3d Gallery Only)</option>";					  
						} elseif($video_embed=="jwp") {
						 echo"<option $selected value='". $video_embed."'>JW Player</option>";	
						} else {
                          echo"<option $selected value='". $video_embed."'>". $video_embed."</option>";
						}
                      } else {
                        echo"<option $selected value=''>". $video_embed."</option>";				  
                      }
                      }
                      ?>
                      </select><br />
                           
                    <div style="float:left;width:80px;">Timeout</div>
                    <input class="correct_num" style="width:30px" id="slideset_id_timeout_<?php echo $z; ?>" name="slideset_id_timeout_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_timeout_'.$z])); ?>" /><small class="description">Seconds</small><br />
                    <div style="float:left;width:80px;">Autoplay</div>
                    <?php if($get_gallery_data['slideset_id_autoplay_'.$z]){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                    <input class="correct_num" type="checkbox" id="slideset_id_autoplay_<?php echo $z; ?>" name="slideset_id_autoplay_<?php echo $z; ?>" value="true" <?php echo $checked; ?> /> <small class="description">(YouTube, Vimeo, Video(3d) Embed)</small><br />
            
                    </td>

                    <td>
					  <div style="float:left;width:110px;">CSS Classes</div>
					  <input class="correct_num" id="slideset_id_cssclasses_<?php echo $z; ?>" name="slideset_id_cssclasses_<?php echo $z; ?>" type="text" style="width:120px" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_cssclasses_'.$z])); ?>" /><small class="description">Separate by spaces</small><br />
                      <div style="float:left;width:110px;">Filter Category</div>
                      <select class="catselect">
                      
                      <?php
					  echo"<option value='Disabled'>Select Category</option>";	
					  $filter_categories = explode(",", $filter_categories_str);
					  
					  if(is_array($filter_categories)) {
                        foreach ($filter_categories as $filter_categories) {
    					  
                          if($filter_categories!="Disabled") {
                            echo"<option value='". $filter_categories."'>". $filter_categories."</option>";
                          } else {
                            echo"<option value=''>". $filter_categories."</option>";				  
                          }
                        }
					  } else {	  
                         if($filter_categories!="Disabled") {
                            echo"<option value='". $filter_categories."'>". $filter_categories."</option>";
                          } else {
                            echo"<option value=''>". $filter_categories."</option>";				  
                          }					  
					  }
                      ?>
                      </select><br />
                      <input type="hidden" class="correct_num selected_cats" id="slideset_id_catselect_<?php echo $z; ?>" name="slideset_id_catselect_<?php echo $z; ?>" value="<?php echo $get_gallery_data['slideset_id_catselect_'.$z]; ?>" />
                      <ul id="catselect">
                      <?php
					  if($get_gallery_data['slideset_id_catselect_'.$z]) {
							$selected_cats = explode(",", $get_gallery_data['slideset_id_catselect_'.$z] );
							
							if(is_array($selected_cats)) {
								foreach ($selected_cats as $selected_cat) { ?>
									<li class="button-secondary" title="<?php echo $selected_cat; ?>"><span class="cat-remove"></span><?php echo $selected_cat; ?></li>
								<?php }
							} else { ?>
									<li class="button-secondary" title="<?php echo $selected_cats; ?>"><span class="cat-remove"></span><?php echo $selected_cats; ?></li>
							<?php }
							
					  }
					  ?>
                      
                      </ul>
                      <div class="reveal threed"><a href="#"><img src="<?php bloginfo('template_directory') ?>/lib/adm/imgs/blank.gif" alt="slide set control" width="17" height="17" /> </a><div class="revealtext">3d Gallery Settings</div></div>
					  <div class="reveal-content">
					  <br />
					  <div style="float:left;width:110px;">Pieces</div>
                      <input class="correct_num" style="width:40px" id="slideset_id_segments_<?php echo $z; ?>" name="slideset_id_segments_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_segments_'.$z])); ?>" /><br />

					  <div style="float:left;width:110px;">Transition</div>
                      
	                  <select class="correct_num" id="slideset_id_transition_<?php echo $z; ?>" name="slideset_id_transition_<?php echo $z; ?>">
                      <?php
					  echo"<option value=''>Select</option>";
                      $tween_types = array("linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce");
		 
                      foreach ($tween_types as $tween_type) {
                      if ($get_gallery_data['slideset_id_transition_'.$z] == $tween_type && $z+1 != $count){
                      $selected = "selected='selected'";	
                      }else{
                      $selected = "";		
                      }
                      if($video_embed!="Disabled") {
                          echo"<option $selected value='". $tween_type ."'>". $tween_type ."</option>";
                      } 
                      }
                      ?>
                      </select><br />				  
 					  <div style="float:left;width:110px;">Transition Time</div>
                      <input class="correct_num" style="width:40px" id="slideset_id_transtime_<?php echo $z; ?>" name="slideset_id_transtime_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_transtime_'.$z])); ?>" /><small class="description">Seconds (Default 1.2)</small><br class="clear" />

 					  <div style="float:left;width:110px;">Delay</div>
                      <input class="correct_num" style="width:40px" id="slideset_id_transdelay_<?php echo $z; ?>" name="slideset_id_transdelay_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_transdelay_'.$z])); ?>" /><small class="description">Seconds (Default 0.1)</small><br />

 					  <div style="float:left;width:110px;">Depth Offset</div>
                      <input class="correct_num" style="width:40px" id="slideset_id_depthoffset_<?php echo $z; ?>" name="slideset_id_depthoffset_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_depthoffset_'.$z])); ?>" /><small class="description">(-200 to 700)</small><br />

 					  <div style="float:left;width:110px;">Cube Distance</div>
                      <input class="correct_num" style="width:40px" id="slideset_id_cubedistance_<?php echo $z; ?>" name="slideset_id_cubedistance_<?php echo $z; ?>" type="text" value="<?php echo stripslashes(htmlspecialchars($get_gallery_data['slideset_id_cubedistance_'.$z])); ?>" /><small class="description">(Default 20)</small><br />
               
   
					  </div>        	
					  	
          
                    	</td>                    
                      </tr>
                      <?php } ?>
                    </tbody>
                
                </table>
                <p>&nbsp;</p>
				<input type="submit" class="button-secondary apply add_row correct_gallery_num" id="" value="Add New Slide" /> <a title="Add an Image" class="button cwz thickbox" href="media-upload.php?type=image&amp;TB_iframe=1&amp;width=640&amp;height=338">Get Image URL</a></p>                
                </div>
            </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
        <p><input type="submit" class="button-primary slideset-save" value="<?php _e('Save Slide Set') ?>" name="save" /></p>
        <input type="hidden" name="action" value="update" />
                 
        </form>
		<?php } ?>
</div>
