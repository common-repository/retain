<?php
add_action( 'admin_init', 'retain_options_page' );


function retain_options_page(  ) { 

	register_setting( 'retain', 'retain_settings' );

	add_settings_section(
		'retain_pluginPage_section', 
		__( 'Retain - General Settings', 'retain' ), 
		'retain_settings_section_callback', 
		'retain'
	);
	add_settings_field( 
		'retain_appid', 
		__( 'Rtain App ID', 'retain' ), 
		'retain_appid_render', 
		'retain', 
		'retain_pluginPage_section' 
	);
	add_settings_field( 
		'retain_type', 
		__( 'Gather data from logged in users', 'retain' ), 
		'retain_type_render', 
		'retain', 
		'retain_pluginPage_section' 
	);
}
function retain_appid_render(  ) { 
	$options = get_option( 'retain_settings' );
	?>
	<input size="60" style='direction:ltr;' type='text' name='retain_settings[retain_appid]' value='<?php echo $options['retain_appid']; ?>'>
	<p class="description"><?php echo __( 'Find your App ID from Retain dashboard', 'retain' ); ?></p>
	<?php

}
function retain_type_render(  ) { 

	$options = get_option( 'retain_settings' );
	?>
	<select name="retain_settings[retain_type]">
		<option value="no" <?php selected( $options['retain_type'], 'no' ); ?>><?php echo __('No','retain'); ?></option>
		<option value="yes" <?php selected( $options['retain_type'], 'yes' ); ?>><?php echo __('Yes','retain'); ?></option>
	</select>
		<p class="description"><?php echo __( 'Add User data to your retain dashboard including username,email, first name and last name', 'retain' ); ?></p>

<?php
}
function retain_settings_section_callback(  ) { 

	echo __( 'This settings are neccessary for Plugin to work.', 'retain' );

}

function retain_options_page_view() { 

	?>
	<form action='options.php' method='post'>
		<?php
		settings_fields( 'retain' );
		do_settings_sections( 'retain' );
		submit_button();
		?>
		
	</form>
<?php } ?>