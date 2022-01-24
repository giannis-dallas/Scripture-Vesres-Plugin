<?php

/**
 * Plugin Name:       napsv Features
 * Plugin URI:        napsvbible.com
 * Description:       Custom Scripture post type with advanced capabilities
 * Version:           2.0.0
 * Author:            napsv
 * Author URI:        napsvbible.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       napsv_features
 * Domain Path:       /languages
 */

add_action('wp_enqueue_scripts', 'napsv_enqueue_scripts');
function napsv_enqueue_scripts(){
	wp_enqueue_style( 'varibles_style', plugin_dir_url( __FILE__ ) . 'assets/variables.css' );
	wp_enqueue_script( 'napsv_custom_script', plugin_dir_url( __FILE__ ) . 'assets/custom.js', array('jquery') );
	wp_enqueue_script( 'napsv_actions_script', plugin_dir_url( __FILE__ ) . 'assets/actions.js', array('jquery') );
	wp_localize_script( 'napsv_actions_script', 'napsv_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}


// add_shortcode( 'BrideName', 'napsv_bridename_function' );
// function napsv_bridename_function() {
//     return '<span class="blessed-bride-name">Bride</span>';
// }
// add_shortcode( 'GroomName', 'napsv_groomname_function' );
// function napsv_groomname_function() {
//     return '<span class="blessed-groom-name">Groom</span>';
// }
// add_shortcode( 'GenderPronoun', 'napsv_gender_function' );
// function napsv_gender_function() {
//     return '<span class="gender-pronoun">they</span>';
// }


add_shortcode( 'YourName', 'napsv_name_function' );
function napsv_name_function() {
    return '<span class="blessed-name">Loved One</span>';
}
add_shortcode( 'thename', 'napsv_thename_function' );
function napsv_thename_function() {
    return '<span class="blessed-name">Loved One</span>';
}

add_shortcode( 'they', 'napsv_they_function' );
function napsv_they_function() {
    return '<span class="gender-they">they</span>';
}
add_shortcode( 'their', 'napsv_their_function' );
function napsv_their_function() {
    return '<span class="gender-their">their</span>';
}
add_shortcode( 'them', 'napsv_them_function' );
function napsv_them_function() {
    return '<span class="gender-them">them</span>';
}

add_action( 'init', 'napsv_register_post_type' );
function napsv_register_post_type() {
	$args = [
		'label'  => esc_html__( 'Scriptures', 'text-domain' ),
		'labels' => [
			'menu_name'          => esc_html__( 'Scriptures', 'napsv_features' ),
			'name_admin_bar'     => esc_html__( 'Scripture', 'napsv_features' ),
			'add_new'            => esc_html__( 'Add Scripture', 'napsv_features' ),
			'add_new_item'       => esc_html__( 'Add new Scripture', 'napsv_features' ),
			'new_item'           => esc_html__( 'New Scripture', 'napsv_features' ),
			'edit_item'          => esc_html__( 'Edit Scripture', 'napsv_features' ),
			'view_item'          => esc_html__( 'View Scripture', 'napsv_features' ),
			'update_item'        => esc_html__( 'View Scripture', 'napsv_features' ),
			'all_items'          => esc_html__( 'All Scriptures', 'napsv_features' ),
			'search_items'       => esc_html__( 'Search Scriptures', 'napsv_features' ),
			'parent_item_colon'  => esc_html__( 'Parent Scripture', 'napsv_features' ),
			'not_found'          => esc_html__( 'No Scriptures found', 'napsv_features' ),
			'not_found_in_trash' => esc_html__( 'No Scriptures found in Trash', 'napsv_features' ),
			'name'               => esc_html__( 'Scriptures', 'napsv_features' ),
			'singular_name'      => esc_html__( 'Scripture', 'napsv_features' ),
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-testimonial',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'taxonomies' => [
			'category',
			'tag',
			'post_tag',
		]
	];

	register_post_type( 'scripture', $args );
}

add_action( 'widgets_init', 'napsv_sidebars' );
function napsv_sidebars() {
    register_sidebar(
        array(
            'id'            => 'after-scripture-content',
            'name'          => __( 'After Main Scripture' ),
            'description'   => __( 'Content to add afrer the main scripture text' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}

// Scripture Astra hooks

add_action( 'astra_entry_after','after_scripture' );
function after_scripture () { 

	$classes = get_body_class();
	if (in_array('single-scripture',$classes)){
		?>
		<div class="after-scripture-content">
		<?php if ( is_active_sidebar( 'after-scripture-content' ) ) : ?>
			<?php dynamic_sidebar( 'after-scripture-content' ); ?>
		<?php endif; ?>
		</div>
		<!-- loader -->
		<div class="roller-container">
			<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			<div class="roller-description">FILL THE NAME</div>
		</div>
		<!-- loader end  -->
		<?php
	}
	
}
add_action( 'astra_content_before','variables_bar' );
function variables_bar () {
	$classes = get_body_class();
	if (in_array('single-scripture',$classes)){
	?>
		<div class="variables-bar" id="variables_bar">
			<div class="variables-bar-content">
				<div>Fill the name and gender</div>
				<div class="variables-container">
					<input type="text" name="Name" placeholder="Name" id="name_input">
					<select name="gender" id="gender_select">
						<option value="neutral">Neutral</oprion>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
					<button id="update_variables">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M20.944 12.979c-.489 4.509-4.306 8.021-8.944 8.021-2.698 0-5.112-1.194-6.763-3.075l1.245-1.633c1.283 1.645 3.276 2.708 5.518 2.708 3.526 0 6.444-2.624 6.923-6.021h-2.923l4-5.25 4 5.25h-3.056zm-15.864-1.979c.487-3.387 3.4-6 6.92-6 2.237 0 4.228 1.059 5.51 2.698l1.244-1.632c-1.65-1.876-4.061-3.066-6.754-3.066-4.632 0-8.443 3.501-8.941 8h-3.059l4 5.25 4-5.25h-2.92z"/></svg>
						Update
					</button>
				</div>
			</div>
			<div class="variables-bar-toggle">
				<a href="#" class="close">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z"/></svg>
				</a>	
				<a href="#" class="open">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
				</a>	
			</div>
		</div>

	<?php
	}
}


/***********************
*                      
 *    AJAX FUNCTIONS
 * 
 ***********************/

add_action( 'wp_ajax_napsv_send_message', 'napsv_send_message' );
add_action( 'wp_ajax_nopriv_napsv_send_message', 'napsv_send_message' );

function napsv_send_message() {
	
	if (isset($_POST['message'])) {

		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = 'From: ' . $_POST['name'] . ' <"andrey.swystun@gmail.com">';
		$to = $_POST['email'];
		$subject = "Personalized Scriptures | New Message from " . $_POST['name'];
		
		ob_start();
		
		echo '<table border="0" cellpadding="0" cellspacing="0" class="body" 
		style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;background-color: #fafafa;border:4px solid #0170B9;padding:50px 40px;max-width:960px;margin:0 auto"><tr><td>' .
			wpautop($_POST['message']) . '
			<img src="https://napsvbible.org/wp-content/uploads/2021/08/end3.gif" alt="sylish image"/>
			<br />
			--
			<p>Created at: <a href = "https://napsvbible.org">napsvbible.org</a></p>
			<td><tr></table>';
		
		$message = ob_get_contents();
		
		ob_end_clean();

		$var1 = $to;
		$var2 = $headers;
		$var3 = $subject;
		$var4 = $message;

		$mail = wp_mail($to, $subject, $message, $headers);
		if($mail){
			$var5 ='success';
		}else{
			$var5 = 'Wtf?';
		}
		
		echo json_encode(array($mail,$var5));


	}

	wp_die(); 
}

//** END OF AJAX FUNCTIONS **/

// Add Scriptures to tag archives
function scriptures_cpt_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'scripture' ) );
    }
}
add_action( 'pre_get_posts', 'scriptures_cpt_tags' );

// show wp_mail() errors
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    echo "<pre>";
    print_r($wp_error);
    echo "</pre>";
}   