<?php
/**
 * Sanitization Functions
 *
 * @package voice_blog
 */

if ( ! function_exists( 'voice_blog_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function voice_blog_sanitize_select( $input, $setting ){
         
		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);
	
		//get the list of possible select options 
		$choices = $setting->manager->get_control( $setting->id )->choices;
						 
		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
		 
	}

endif;

if ( ! function_exists( 'voice_blog_sanitize_radio' ) ) :
	/**
	 * Sanitize radio.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function voice_blog_sanitize_radio( $input, $setting ) {
			
		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		//get the list of possible radio box options 
		$choices = $setting->manager->get_control( $setting->id )->choices;
						
		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
		
	}
endif;


/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
	function voice_blog_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}