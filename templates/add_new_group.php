<?php 
	if (isset($_GET['group'])) {
		global $wpdb;
		$id = sanitize_text_field($_GET['group']);
        $table_name = $wpdb->prefix . "aspl_asl_group_data";
        $question12 = $wpdb->get_results("SELECT * FROM $table_name WHERE id = $id ");
        foreach ($question12 as $key => $value) {
        	?>
			<div class="wrap"> 
				<form method="POST">				
				  	<div id="poststuff">
			            <div id="post-body" class="metabox-holder columns-<?php _e(esc_attr(1 == get_current_screen()->get_columns() ? '1' : '2')); ?>">
			                
			                <div id="post-body-content" style="background-color: white; border:1px solid #ccd0d4;">
								<div class="aspl_asl_addnew_main_section">
				            	<h1 class="main-title">Update # <?php _e(ucfirst($value->title)); ?></h1>
				                	<div class="aspl_asl_edit_title">
										<input type="text" name="group_title" class="group_title" placeholder=" Title ..." value="<?php _e($value->title); ?>">
									</div>
									<div class="aspl_asl_link_data">
										<table class="aspl_asl_edit_table" width="100%" style="text-align: center;">
											<tr>
												<th>Enable/Disable</th>
												<th>Name</th>
												<th>Icon</th>
												<th>Link</th>
											</tr>
											<?php 
												$data = $value->group_data;
												$data_unserialize = unserialize($data);
												foreach ($data_unserialize as $data_value) {
													$name = '';
													$name = $data_value['social_name'];
													?>
													<tr>
														<td>
															<input type="hidden" name="record[]" value="0">
															<label class="aspl_container">
																<?php $aspl_social_link_status = $data_value['aspl_social_link_status']; ?>
																<input type="checkbox" name="aspl_social_link_status[]" <?php 
																	if ($aspl_social_link_status == 'on') {
																		_e('checked="true"');
																	}
																 ?> >
																<span class="checkmark"></span>
															</label>
														</td>
														<td><?php _e(ucfirst($data_value['social_name'])); ?>
															<input type="hidden" name="social_name[]" value="<?php _e($data_value['social_name']); ?>">
														</td>
														<td>
															<input id="<?php _e($name.'_image'); ?>" type="text" name="aspl_social_menu_image_image[]" value="<?php _e($data_value['aspl_social_menu_image_image']); ?>" class="aspl_asl_link_input" />
															<input id="<?php _e('upload_'.$name.'_link'); ?>" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn " value="Insert Image" />
														</td>
														<td><input type="text" name="link[]" value="<?php _e($data_value['link']); ?>"></td>
													</tr>
													<?php
												}
											?>
										</table>
									</div>
								</div>
			                </div>

			                <div id="postbox-container-1" class="postbox-container" style="background-color: white; border:1px solid #ccd0d4; ">
			                    <div style="width:100%;border-bottom: 1px solid #ccd0d4; "><h2 style="width: 100%; padding-left: 10px;">Request Action</h2></div>
			                    <div style="padding: 10px;">
			                    	<table style="width:100%;">	
		                    			<tr>
		                    				<div class="aspl_asl_short_code">
												<input type="text" name="group_short_code" class="group_short_code" placeholder="Shortcode" value="<?php _e($value->shortcode); ?>">
											</div>		
		                    			</tr>
		                    			<tr style="width:100%;">
		                    				<td style="width:50%;">
				                    			<span style="color: #0073aa;text-decoration:underline;cursor: pointer;" class="wqp_delete_request_data">Move to trash</span>
				                    		</td>
				                    		<td style="text-align: right; width: 50%;float: right;">
				                    			<input type="submit" name="aspl_asl_save_btn" class="button button-primary wqp_update_request_data" value="Update">
				                    		</td>
		                    			</tr>
		                    			<tr></tr>
			                    	</table>
			                    </div>
			                </div>

			                <div id="post-body-content" style="background-color: white; border:1px solid #ccd0d4;">
			                	<div style="padding: 20px;">
				                	<h3>Genral</h3>
				                	<table>
				                		<tr>
				                			<?php 
				                				$sticky = $value->sticky;
				                			?>
				                			<td><h5>Sticky Position:</h5></td><td></td>
				                			<td>
				                				<input type="radio" name="aspl_als_sticky" id="default" value="default" <?php if ($sticky == 'default') { _e('checked'); } ?> >
				                				<label for='default'>Default</label>
				                			</td>
				                			<td>
				                				<input type="radio" name="aspl_als_sticky" id="left" value="left" <?php if ($sticky == 'left') { _e('checked'); } ?>>
				                				<label for='left'>Left side</label>
				                			</td>
				                			<td>
				                				<input type="radio" name="aspl_als_sticky" id="right" value="right" <?php if ($sticky == 'right') { _e('checked'); } ?> >
				                				<label for='right'>Right side</label>
				                			</td>
				                		</tr>
				                	</table>             		
			                	</div>		
			                </div>

			            </div>
			       	</div>
				</form>
			</div>
	        <?php    
        }

        if (isset($_POST['aspl_asl_save_btn'])) {

			global $wpdb;
			$field_data_inner = array();
			$field_data_outer = array();
			$link = array();
			$social_name = array();
			$aspl_social_link_status = array();
			$aspl_social_menu_image_image = array();

			$group_title = sanitize_text_field($_POST['group_title']);
			$aspl_als_sticky = sanitize_text_field($_POST['aspl_als_sticky']);
			$group_short_code = sanitize_text_field($_POST['group_short_code']);

			$aspl_social_link_status = array_map('sanitize_text_field',$_POST['aspl_social_link_status']);
			$social_name = array_map('sanitize_text_field',$_POST['social_name']);
			$aspl_social_menu_image_image = array_map('sanitize_text_field',$_POST['aspl_social_menu_image_image']);
			$link = array_map('sanitize_text_field',$_POST['link']);

			$record = array_map('sanitize_text_field',$_POST['record']);
			$rec_count = count($record);

			for( $i = 0 ;$i < $rec_count ; $i++ ){

				@$status = $aspl_social_link_status[$i];
				if ( $status != 'on') {
					$field_data_inner['aspl_social_link_status'] = 'off';
				}else{
					$field_data_inner['aspl_social_link_status'] = $status;
				}
				$field_data_inner['social_name'] = $social_name[$i];
				$field_data_inner['aspl_social_menu_image_image'] = $aspl_social_menu_image_image[$i];
				$field_data_inner['link'] = $link[$i];

				$field_data_outer[] = $field_data_inner;

			}

			$field_data_outer_serialize = serialize($field_data_outer); 
			$data = [ 
				'title' => $group_title,
			    'group_data' => $field_data_outer_serialize,
			    'shortcode' => $group_short_code,
			    'sticky' => $aspl_als_sticky
			];
			$where = [ 'id' => $id ];
			$wpdb->update( $wpdb->prefix . 'aspl_asl_group_data', $data, $where); 

			wp_redirect( admin_url( '/admin.php?page=aspl_asl_group_list' ) );

		}

	}else{

		?>

		<div class="wrap"> 
			<form method="POST">
			  	<div id="poststuff">
		            <div id="post-body" class="metabox-holder columns-<?php _e(esc_attr(1 == get_current_screen()->get_columns() ? '1' : '2')); ?>">
		                
		                <div id="post-body-content" style="background-color: white; border:1px solid #ccd0d4;">
							<div class="aspl_asl_addnew_main_section">
				            	<h1 class="main-title">Social Link Group</h1>
			                	<div class="aspl_asl_edit_title"><input type="text" name="group_title" class="group_title" placeholder=" Title ..."></div>
								<div class="aspl_asl_link_data">
									<table class="aspl_asl_edit_table" width="100%" style="text-align: center;">
										<tr>
											<th>Enable/Disable</th>
											<th>Name</th>
											<th>Icon</th>
											<th>Link</th>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
													<input type="checkbox" name="aspl_social_link_status[]" >
													<span class="checkmark"></span>
												</label>
											</td>
											<td> <img src="<?php _e(plugins_url('/../assest/images/facebook.png' , __FILE__)); ?>" width="20px" height="20px" > <!-- Facebook --><input type="hidden" name="social_name[]" value="facebook"></td>
											<td>
												<input id="facebook_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_facebook_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
													<input type="checkbox" name="aspl_social_link_status[]" >
													<span class="checkmark"></span>
												</label>
											<!-- <img src="<?php _e( plugins_url('/../assest/images/facebook.png' , __FILE__)); ?>"> -->
											</td>
											<td> <img src="<?php _e( plugins_url('/../assest/images/Tumblr.png' , __FILE__)); ?>" width="20px" height="20px"><!-- Tumblr --><input type="hidden" name="social_name[]" value="tumblr"></td>
											<td>
												<input id="tumblr_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_tumblr_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
													<input type="checkbox" name="aspl_social_link_status[]" >
													<span class="checkmark"></span>
												</label>

											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/insta.png' , __FILE__)); ?>" width="20px" height="20px"><!-- Instagram --><input type="hidden" name="social_name[]" value="instagram"></td>
											<td>
												<input id="instagram_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_instagram_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
												  	<input type="checkbox" name="aspl_social_link_status[]" >
												  	<span class="checkmark"></span>
												</label>
											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/Twiter.png' , __FILE__)); ?>" width="20px" height="20px"><!-- Twitter --><input type="hidden" name="social_name[]" value="twitter"></td>
											<td>
												<input id="twitter_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_twitter_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
												  	<input type="checkbox" name="aspl_social_link_status[]" >
												  	<span class="checkmark"></span>
												</label>
											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/skype.png' , __FILE__)); ?>" width="20px" height="20px"><!-- Skype --><input type="hidden" name="social_name[]" value="skype"></td>
											<td>
												<input id="skype_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_skype_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">
												<label class="aspl_container">
												  	<input type="checkbox" name="aspl_social_link_status[]">
												  	<span class="checkmark"></span>
												</label>
											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/line.png' , __FILE__)); ?>" width="20px" height="20px"><!-- LINE --><input type="hidden" name="social_name[]" value="line"></td>
											<td>
												<input id="line_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_line_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">	
												<label class="aspl_container">
												  	<input type="checkbox" name="aspl_social_link_status[]">
												  	<span class="checkmark"></span>
												</label>
											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/link.png' , __FILE__)); ?>" width="20px" height="20px"><!-- LinkedIn --><input type="hidden" name="social_name[]" value="linkedin"></td>
											<td>
												<input id="linkedin_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_linkedin_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
										<tr>
											<td>
												<input type="hidden" name="record[]" value="0">	
												<label class="aspl_container">
												  	<input type="checkbox" name="aspl_social_link_status[]">
												  	<span class="checkmark"></span>
												</label>
											</td>
											<td><img src="<?php _e( plugins_url('/../assest/images/you_tube.png' , __FILE__)); ?>" width="20px" height="20px"><!-- YouTube --><input type="hidden" name="social_name[]" value="youtube"></td>
											<td>
												<input id="youtube_image" type="text" name="aspl_social_menu_image_image[]" class="aspl_asl_link_input" />
												<input id="upload_youtube_link" type="button" class="button-primary aspl_pop_button aspl_asl_link_btn" value="Insert Image" />
											</td>
											<td><input type="text" name="link[]"></td>
										</tr>
									</table>
								</div>
							</div>
		                </div>
		            	
		                <div id="postbox-container-1" class="postbox-container" style="background-color: white; border:1px solid #ccd0d4; ">
		                    <div style="width:100%;border-bottom: 1px solid #ccd0d4; "><h2 style="width: 100%; padding-left: 10px;">Request Action</h2></div>
		                    <div style="padding: 10px;">
		                    	<table style="width:100%;">	
	                    			<tr>
	                    				<div class="aspl_asl_short_code"><input type="text" name="group_short_code" class="group_short_code" placeholder="Shortcode"></div>		
	                    			</tr>
	                    			<tr style="width:100%;">
	                    				<td style="width:50%;">
			                    			<span style="color: #0073aa;text-decoration:underline;cursor: pointer;" class="wqp_delete_request_data">Move to trash</span>
			                    		</td>
			                    		<td style="text-align: right; width: 50%;float: right;">
			                    			<input type="submit" name="aspl_asl_save_btn" class="button button-primary wqp_update_request_data" value="Publish">
			                    		</td>
	                    			</tr>
	                    			<tr></tr>
		                    	</table>
		                    </div>
		                </div>

		                <div id="post-body-content" style="background-color: white; border:1px solid #ccd0d4;">
		                	<div style="padding: 20px;">
			                	<h3>Genral</h3>
			                	<table>
			                		<tr>
			                			<td><h5>Sticky Position:</h5></td><td></td>
			                			<td><input type="radio" name="aspl_als_sticky" id="default" value="default" checked ><label for='default'>Default</label></td>
			                			<td><input type="radio" name="aspl_als_sticky" id="left" value="left" ><label for='left'>Left side</label></td>
			                			<td><input type="radio" name="aspl_als_sticky" id="right" value="right" ><label for='right'>Right side</label></td>
			                		</tr>
			                	</table>             		
		                	</div>		
		                </div>
		            </div>
		       	</div>
			</form>
		</div>
		<?php 

		if (isset($_POST['aspl_asl_save_btn'])) {

			global $wpdb;
			$field_data_inner = array();
			$field_data_outer = array();
			$aspl_social_link_status = array();
			$social_name = array();
			$link = array();
			$aspl_social_menu_image_image = array();

			$group_title = sanitize_text_field($_POST['group_title']);
			$aspl_als_sticky = sanitize_text_field($_POST['aspl_als_sticky']);
			$group_short_code = sanitize_text_field($_POST['group_short_code']);

			$aspl_social_link_status = array_map('sanitize_text_field',$_POST['aspl_social_link_status']);
			$social_name = array_map('sanitize_text_field',$_POST['social_name']);
			$aspl_social_menu_image_image = array_map('sanitize_text_field',$_POST['aspl_social_menu_image_image']);
			$link = array_map('sanitize_text_field',$_POST['link']);

			$record = array_map('sanitize_text_field',$_POST['record']);
			$rec_count = count($record);

			for( $i = 0 ;$i < $rec_count ; $i++ ){

				@$status = $aspl_social_link_status[$i];
				if ( $status != 'on') {
					$field_data_inner['aspl_social_link_status'] = 'off';
				}else{
					$field_data_inner['aspl_social_link_status'] = $status;
				}
				$field_data_inner['social_name'] = $social_name[$i];
				$field_data_inner['aspl_social_menu_image_image'] = $aspl_social_menu_image_image[$i];
				$field_data_inner['link'] = $link[$i];
				$field_data_outer[] = $field_data_inner;

			}

			$field_data_outer_serialize = serialize($field_data_outer); 
			
			$table_name1 = $wpdb->prefix . "aspl_asl_group_data";
			$q = $wpdb->insert($table_name1, array(
					    'title' => $group_title,
					    'group_data' => $field_data_outer_serialize,
					    'shortcode' => $group_short_code,
					    'sticky' => $aspl_als_sticky,
					));

			wp_redirect( admin_url( '/admin.php?page=aspl_asl_group_list' ) );

		}

	}
?>