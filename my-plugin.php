<?php
/*
 * Plugin Name: My-Plugin
 * Version:1.0.0
 * Author: Bisnu
 * Description: Just for learning plugin development
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

//After Active the plugin, the table will be create;
function after_activation() {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix . 'bisnu';
	$query      = "CREATE TABLE $table_name (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(255))";
	$wpdb->query( $query );

	$wpdb->insert( $table_name, [ 'name' => "Bisnu", 'email' => 'bisnu@gmail.com', 'phone' => '+880174446' ] );
}

register_activation_hook( __FILE__, 'after_activation' );


//After Deactive the plugin, the table will be truncate
function after_deactivation() {
	global $wpdb, $table_prefix;
	$table_name = $table_prefix . 'bisnu';
	$wpdb->query( "TRUNCATE TABLE $table_name" );
}

register_deactivation_hook( __FILE__, 'after_deactivation' );

function show_latest_posts() {
	$arg    = array(
		'post_type'      => 'post',
		'posts_per_page' => 5
	);
	$result = new WP_Query( $arg );

	ob_start();
	?>
    <h3>Latest 10 Posts</h3>
	<?php
	while ( $result->have_posts() ):
		$result->the_post();
		?>
        <li>
            <a href="<?php echo get_the_permalink(); ?>">
				<?php echo get_the_title(); ?>
            </a>
            <p>
                <span><?php echo get_the_date(); ?></span>
            </p>
        </li>
	<?php
	endwhile;
	$html = ob_get_clean();
	echo $html;
}

add_shortcode( 'bisnu_latest_post', 'show_latest_posts' );