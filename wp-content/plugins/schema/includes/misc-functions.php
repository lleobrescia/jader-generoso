<?php
/**
 * Misc functions
 *
 * @package     Schema
 * @subpackage  Functions/Formatting
 * @copyright   Copyright (c) 2016, Hesham Zebida
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Get publisher array
 *
 * @since 1.2
 * @return array
 */
function schema_wp_get_publisher_array() {
	
	$publisher = array();
	
	$name = schema_wp_get_option( 'name' );
	
	// Use site name as organization name for publisher if not presented in plugin settings
	// @since 1.5.9.5
	if ( empty($name) ) $name = get_bloginfo( 'name' );
	
	// @since 1.5.9.3
	$logo = esc_attr( stripslashes( schema_wp_get_option( 'publisher_logo'  ) ) );
	
	$publisher = array(
		"@type"	=> "Organization",	// default required value
		"name"	=> $name,
		"logo"	=> array(
    		"@type" => "ImageObject",
    		"url" => $logo,
    		"width" => 600,
			"height" => 60
		)
	);
	
	return apply_filters( 'schema_wp_publisher', $publisher );
}


/**
 * Get an array of enabled post types
 *
 * @since 1.4
 * @return array of enabled post types, schema type
 */
function schema_wp_cpt_get_enabled() {
	
	$cpt_enabled = array();
	
	$args = array(
					'post_type'			=> 'schema',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1
				);
				
	$schemas_query = new WP_Query( $args );
	
	$schemas = $schemas_query->get_posts();
	
	// If there is no schema types set, return and empty array
	if ( empty($schemas) ) return array();
	
	foreach( $schemas as $schema ) : 
		
		// Get post meta
		$schema_type			= get_post_meta( $schema->ID, '_schema_type'			, true );
		$schema_type_sub_pre	= get_post_meta( $schema->ID, '_schema_article_type'	, true );
		$schema_type_sub		= ( $schema_type_sub_pre == 'General' ) ? $schema_type : $schema_type_sub_pre;
		$schema_post_types 		= get_post_meta( $schema->ID, '_schema_post_types'	, true );
		$schema_categories 		= schema_wp_get_categories( $schema->ID );
		
		// Build our array
		$cpt_enabled[] = array (
									'id'			=>	$schema->ID,
									'type'			=>	$schema_type,
									'type_sub'		=>	$schema_type_sub,
									'post_type'		=>	$schema_post_types,
									'categories'	=>	$schema_categories
								);
		
	endforeach;
 	
	// debug
	//echo '<pre>'; print_r($cpt_enabled); echo '</pre>'; exit;
	
	return apply_filters('schema_wp_cpt_enabled', $cpt_enabled);
}


/**
 * Get an array of enabled post types
 *
 * @since 1.5.9.6
 * @return array of enabled post types, schema type
 */
function schema_wp_cpt_get_enabled_post_types() {
	
	$cpt_enabled = array();
	
	$args = array(
					'post_type'			=> 'schema',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1
				);
				
	$schemas_query = new WP_Query( $args );
	
	$schemas = $schemas_query->get_posts();
	
	// If there is no schema types set, return and empty array
	if ( empty($schemas) ) return array();
	
	foreach( $schemas as $schema ) : 
		
		$schema_post_types = get_post_meta( $schema->ID, '_schema_post_types'	, true );
		
		// Build our array
		$cpt_enabled[] = reset($schema_post_types);
		
		
	endforeach;
	
	// debug
	//echo '<pre>'; print_r($cpt_enabled); echo '</pre>'; exit;
	//echo reset($cpt_enabled[0]);
	return apply_filters('schema_wp_cpt_enabled_post_types', $cpt_enabled);
}


/**
 * Get an array of enabled post types
 *
 * @since 1.4
 * @return array of enabled post types, schema type
 */
function schema_wp_get_media( $post_id = null) {
	
	global $post;
	
	if ( ! isset( $post_id ) ) $post_id = $post->ID;
	
	$media = array();
	
	// Featured image
	$image_attributes	= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
	$image_url			= $image_attributes[0];
	$image_width		= ( $image_attributes[1] > 696 ) ? $image_attributes[1] : 696; // Images should be at least 696 pixels wide
	$image_height		= $image_attributes[2];
	
	// Thesis 2.x Post Image
	$my_theme = wp_get_theme();
	if ( $my_theme->get( 'Name' ) == 'Thesis') {
		$image_attributes	= get_post_meta( $post_id, '_thesis_post_image', true);
		if ( ! empty($image_attributes) ) {
			$image_url			= $image_attributes['image']['url'];
			// Make sure url is valid
			if ( filter_var( $image_url, FILTER_VALIDATE_URL ) === FALSE ) {
    			//die('Not a valid URL');
				$image_url			= get_site_url() . $image_attributes['image']['url'];
			}
			$image_width		= ( $image_attributes['image']['width'] > 696 ) ? $image_attributes['image']['width'] : 696;
			$image_height		= $image_attributes['image']['height'];
		}
	}
	
	// Try something else...
	// @since 1.5.4
	if ( ! isset($image_url) || $image_url == '' ) {
		if ( $post->post_content ) {
			$Document = new DOMDocument();
			@$Document->loadHTML( $post->post_content );
			$DocumentImages = $Document->getElementsByTagName( 'img' );

			if ( $DocumentImages->length ) {
				$image_url 		= $DocumentImages->item( 0 )->getAttribute( 'src' );
				$image_width 	= ( $DocumentImages->item( 0 )->getAttribute( 'width' ) > 696 ) ? $DocumentImages->item( 0 )->getAttribute( 'width' ) : 696;
				$image_height	= $DocumentImages->item( 0 )->getAttribute( 'height' );
			}
		}
	}	
			
	// Check if there is no image, then return an empy array
	// @since 1.4.3 
	if ( ! isset($image_url) || $image_url == '' ) return $media;
	// @since 1.4.4
	if ( ! isset($image_width) || $image_width == '' ) return $media;
	if ( ! isset($image_height) || $image_height == '' ) return $media;
	
	$media = array (
		'@type' 	=> 'ImageObject',
		'url' 		=> $image_url,
		'width' 	=> $image_width,
		'height' 	=> $image_height,
		);
	
	// debug
	//echo '<pre>'; print_r($media); echo '</pre>';
	
	return apply_filters( 'schema_wp_filter_media', $media );
}


/**
 * Get post single category,
 * the first category
 *
 * @param int $post_id The post ID.
 * @since 1.4.5
 */
function schema_wp_get_post_category( $post_id ) {
	
	global $post;
	
	if ( ! isset( $post_id ) ) $post_id = $post->ID;
	
	$cats		= get_the_category($post_id);
	$cat		= !empty($cats) ? $cats : array();
	$category	= (isset($cat[0]->cat_name)) ? $cat[0]->cat_name : '';
   
   return $category;
}

	
/**
 * Get post tags separate by commas,
 * to be used as schema keywords for BlogPosting
 *
 * @param int $post_id The post ID.
 * @since 1.4.5
 */
function schema_wp_get_post_tags( $post_id ) {
	
	global $post;
	
	if ( ! isset( $post_id ) ) $post_id = $post->ID;
	
	$tags = '';
	$posttags = get_the_tags();
    if ($posttags) {
       $taglist = "";
       foreach($posttags as $tag) {
           $taglist .=  $tag->name . ', '; 
       }
      $tags =  rtrim($taglist, ", ");
   }
   
   return $tags;
}


/**
 * Get an array of schema enabed categories
 * 
 * @since 1.4.7
 * @return array of enabled categories, schema type
 */

function schema_wp_get_categories( $post_id ) {
	
	global $post;
	
	if ( ! isset($post_id) ) $post_id = $post->ID;
	
	$post_categories	= wp_get_post_categories( $post_id );
	$categories			= array();
     
	if ( empty($post_categories) ) return $categories;
		
	$cats = array();
		
	foreach( $post_categories as $c ){
    	$cat	= get_category( $c );
		$cats[]	= $cat->slug;
	}
	
	if ( empty($cats) ) return $categories;
	
	// Flat
	$categories = schema_wp_array_flatten($cats);
	
	return apply_filters( 'schema_wp_filter_categories', $categories );
}


add_action( 'save_post', 'schema_save_categories', 10, 3 );
/**
 * Save categories when a Schema post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 * @since 1.4.7
 */
function schema_save_categories( $post_id, $post, $update ) {
	
	if( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
    || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) 
        return;
		
	$slug = 'schema';

    // If this isn't a 'schema' post, don't update it.
    if ( $slug != $post->post_type ) {
        return;
    }
	
	// If this is just a revision, don't save ref.
	if ( wp_is_post_revision( $post_id ) )
		return;
		
    // - Update the post's metadata.
	$post_categories = schema_wp_get_categories( $post_id );
	
	update_post_meta($post_id, '_schema_categories', $post_categories);
}


/**
 * Get supported Article types  
 *
 * @since 1.5.3
 * @return array 
 */
function schema_wp_get_support_article_types() {

	$support_article_types = array( 'Article', 'BlogPosting', 'NewsArticle', 'Report', 'ScholarlyArticle', 'TechArticle' );
	
	return apply_filters( 'schema_wp_support_article_types', $support_article_types );
}




/**
 * Get time Seconds in ISO format
 *
 * @link http://stackoverflow.com/questions/13301142/php-how-to-convert-string-duration-to-iso-8601-duration-format-ie-30-minute
 * @param string $time
 * @since 1.5
 * @return string The time Seconds in ISO format
 */
function schema_wp_get_time_second_to_iso8601_duration( $time ) {
	
	$units = array(
        "Y" => 365*24*3600,
        "D" =>     24*3600,
        "H" =>        3600,
        "M" =>          60,
        "S" =>           1,
    );

    $str = "P";
    $istime = false;

    foreach ($units as $unitName => &$unit) {
        $quot  = intval($time / $unit);
        $time -= $quot * $unit;
        $unit  = $quot;
        if ($unit > 0) {
            if (!$istime && in_array($unitName, array("H", "M", "S"))) { // There may be a better way to do this
                $str .= "T";
                $istime = true;
            }
            $str .= strval($unit) . $unitName;
        }
    }

    return $str;
}


add_action( 'save_post', 'schema_wp_clear_json_on_post_save', 10, 3 );
/**
 * Clear schema json on post save
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 * @since 1.5.9.8
 */
function schema_wp_clear_json_on_post_save( $post_id, $post, $update ) {
	
	if( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
    || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) 
		return $post_id;
		
	$slug = 'schema';

    // If this is a 'schema' post, don't update it.
	if ( get_post_type( $post_id ) == $slug ) {
        return $post_id;
    }
	
	// If this is just a revision, don't save ref.
	if ( wp_is_post_revision( $post_id ) )
		 return $post_id;
		
    // - Delete the post's metadata.
	delete_post_meta( $post_id, '_schema_json' );
	delete_post_meta( $post_id, '_schema_json_timestamp' );
	
	// update ref
	// @since 1.6
	schema_wp_update_meta_ref( $post_id );
	
	// Debug
	//$msg = 'Is this un update? ';
  	//$msg .= $update ? 'Yes.' : 'No.';
  	//wp_die( $msg );
	
	 return $post_id;
}



/**
 * Retrieves all the available currencies.
 *
 * @since   1.6.9
 * @return  array
 */
function schema_wp_get_currencies() {
	$currencies = array(
		'AUD' => __( 'Australian Dollars', 'schema-wp' ),
		'BDT' => __( 'Bangladeshi Taka', 'schema-wp' ),
		'BRL' => __( 'Brazilian Real', 'schema-wp' ),
		'BGN' => __( 'Bulgarian Lev', 'schema-wp' ),
		'CAD' => __( 'Canadian Dollars', 'schema-wp' ),
		'CLP' => __( 'Chilean Peso', 'schema-wp' ),
		'CNY' => __( 'Chinese Yuan', 'schema-wp' ),
		'COP' => __( 'Colombian Peso', 'schema-wp' ),
		'CZK' => __( 'Czech Koruna', 'schema-wp' ),
		'DKK' => __( 'Danish Krone', 'schema-wp' ),
		'DOP' => __( 'Dominican Peso', 'schema-wp' ),
		'EUR' => __( 'Euros', 'schema-wp' ),
		'HKD' => __( 'Hong Kong Dollar', 'schema-wp' ),
		'HRK' => __( 'Croatia kuna', 'schema-wp' ),
		'HUF' => __( 'Hungarian Forint', 'schema-wp' ),
		'ISK' => __( 'Icelandic krona', 'schema-wp' ),
		'IDR' => __( 'Indonesia Rupiah', 'schema-wp' ),
		'INR' => __( 'Indian Rupee', 'schema-wp' ),
		'NPR' => __( 'Nepali Rupee', 'schema-wp' ),
		'ILS' => __( 'Israeli Shekel', 'schema-wp' ),
		'JPY' => __( 'Japanese Yen', 'schema-wp' ),
		'KIP' => __( 'Lao Kip', 'schema-wp' ),
		'KRW' => __( 'South Korean Won', 'schema-wp' ),
		'MYR' => __( 'Malaysian Ringgits', 'schema-wp' ),
		'MXN' => __( 'Mexican Peso', 'schema-wp' ),
		'NGN' => __( 'Nigerian Naira', 'schema-wp' ),
		'NOK' => __( 'Norwegian Krone', 'schema-wp' ),
		'NZD' => __( 'New Zealand Dollar', 'schema-wp' ),
		'PYG' => __( 'Paraguayan Guaran??', 'schema-wp' ),
		'PHP' => __( 'Philippine Pesos', 'schema-wp' ),
		'PLN' => __( 'Polish Zloty', 'schema-wp' ),
		'GBP' => __( 'Pounds Sterling', 'schema-wp' ),
		'RON' => __( 'Romanian Leu', 'schema-wp' ),
		'RUB' => __( 'Russian Ruble', 'schema-wp' ),
		'SGD' => __( 'Singapore Dollar', 'schema-wp' ),
		'ZAR' => __( 'South African rand', 'schema-wp' ),
		'SEK' => __( 'Swedish Krona', 'schema-wp' ),
		'CHF' => __( 'Swiss Franc', 'schema-wp' ),
		'TWD' => __( 'Taiwan New Dollars', 'schema-wp' ),
		'THB' => __( 'Thai Baht', 'schema-wp' ),
		'TRY' => __( 'Turkish Lira', 'schema-wp' ),
		'USD' => __( 'US Dollars', 'schema-wp' ),
		'VND' => __( 'Vietnamese Dong', 'schema-wp' ),
		'EGP' => __( 'Egyptian Pound', 'schema-wp' ),
	);

	return apply_filters( 'schema_wp_currencies', $currencies );
}


/**
 * Retrieves symbol of the given currency.
 *
 * @since 1.6.9
 *
 * @param string $currency Currency code.
 *
 * @return string $currency_symbol Currency symbol.
 */
function schema_wp_get_currency_symbol( $currency ) {
	switch ( $currency ) {
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'COP' :
		case 'MXN' :
		case 'NZD' :
		case 'HKD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'CNY' :
		case 'RMB' :
		case 'JPY' :
			$currency_symbol = '&yen;';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'KRW' :
			$currency_symbol = '&#8361;';
			break;
		case 'PYG' :
			$currency_symbol = '&#8370;';
			break;
		case 'TRY' :
			$currency_symbol = '&#8378;';
			break;
		case 'NOK' :
			$currency_symbol = '&#107;&#114;';
			break;
		case 'ZAR' :
			$currency_symbol = '&#82;';
			break;
		case 'CZK' :
			$currency_symbol = '&#75;&#269;';
			break;
		case 'MYR' :
			$currency_symbol = '&#82;&#77;';
			break;
		case 'DKK' :
			$currency_symbol = 'kr.';
			break;
		case 'HUF' :
			$currency_symbol = '&#70;&#116;';
			break;
		case 'IDR' :
			$currency_symbol = 'Rp';
			break;
		case 'INR' :
			$currency_symbol = '&#8377;';
			break;
		case 'NPR' :
			$currency_symbol = 'Rs.';
			break;
		case 'ISK' :
			$currency_symbol = 'Kr.';
			break;
		case 'ILS' :
			$currency_symbol = '&#8362;';
			break;
		case 'PHP' :
			$currency_symbol = '&#8369;';
			break;
		case 'PLN' :
			$currency_symbol = '&#122;&#322;';
			break;
		case 'SEK' :
			$currency_symbol = '&#107;&#114;';
			break;
		case 'CHF' :
			$currency_symbol = '&#67;&#72;&#70;';
			break;
		case 'TWD' :
			$currency_symbol = '&#78;&#84;&#36;';
			break;
		case 'THB' :
			$currency_symbol = '&#3647;';
			break;
		case 'GBP' :
			$currency_symbol = '&pound;';
			break;
		case 'RON' :
			$currency_symbol = 'lei';
			break;
		case 'VND' :
			$currency_symbol = '&#8363;';
			break;
		case 'NGN' :
			$currency_symbol = '&#8358;';
			break;
		case 'HRK' :
			$currency_symbol = 'Kn';
			break;
		case 'EGP' :
			$currency_symbol = 'EGP';
			break;
		case 'DOP' :
			$currency_symbol = 'RD&#36;';
			break;
		case 'KIP' :
			$currency_symbol = '&#8365;';
			break;
		default    :
			$currency_symbol = $currency;
			break;
	}

	return apply_filters( 'schema_wp_currency_symbol', $currency_symbol, $currency );
}
