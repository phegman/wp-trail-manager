<?php

/**
 * Partial for displaying all networks
 * 
 * @link       https://peterhegman.com/
 * @since      1.0.0
 *
 * @package    Trail_Manager
 * @subpackage Trail_Manager/public/partials
 */
?>

<?php 
$args = array(
	'post_type' 	=> 'trail_network',
	'post_per_page'	=>	-1,
	'orderby'		=>	'menu_order',
	'order'			=>	'ASC'
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<div class="networks">
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php 
			$trails = Trail_Manager_Public::trail_manager_get_trails();
			$number_of_trails = count($trails);
		?>
		<div class="network">
			<?php if ( is_array( $atts ) && array_key_exists('show-title', $atts) ) : ?>
				<?php if ( $atts['show-title'] == "true" ) : ?>
					<h2 class="network-title"><?php the_title(); ?></h2>
				<?php endif ?>
			<?php else : ?>
				<h2 class="network-title"><?php the_title(); ?></h2>
			<?php endif ?>
			<?php if ( is_array( $atts ) && array_key_exists('show-description', $atts) ) : ?>
				<?php if ( $atts['show-description'] == "true" ) : ?>
					<div class="network-description">
						<?php the_content(); ?>
					</div><!-- /.network-description -->
				<?php endif ?>
			<?php else : ?>
				<div class="network-description">
					<?php the_content(); ?>
				</div><!-- /.network-description -->
			<?php endif; ?>
			<div class="network-status">
				<div class="trails-open status-count">
					<span><?php _e('Trails Open:', 'trail-manager'); ?></span>
					<span><?php echo Trail_Manager_Public::trail_manager_number_trails_status( 'Open' ) ?>/<?php echo $number_of_trails; ?></span>
				</div><!-- /.trails-open -->
				<div class="trails-caution status-count">
					<span><?php _e('Trails Cautioned:', 'trail-manager'); ?></span>
					<span><?php echo Trail_Manager_Public::trail_manager_number_trails_status( 'Caution' ) ?>/<?php echo $number_of_trails; ?></span>
				</div><!-- /.trails-caution -->
				<div class="trails-closed status-count">
					<span><?php _e('Trails Closed:', 'trail-manager'); ?></span>
					<span><?php echo Trail_Manager_Public::trail_manager_number_trails_status( 'Closed' ) ?>/<?php echo $number_of_trails; ?></span>
				</div><!-- /.trails-closed -->
			</div><!-- /.network-status -->
			<?php foreach ($trails as $key => $trail) : ?>
				<div class="trail">
					<div class="trail-header <?php echo 'status-' . $trail->status; ?>">
						<h3 class="trail-name"><?php echo $trail->name; ?></h3>
						<div class="trail-status">
							<?php echo $trail->status; ?>
						</div><!-- /.trail-status -->
					</div><!-- /.trail-header -->
					<div class="trail-meta">
						<div class="left-side">
							<div class="difficulty-icon">
							<?php if ( $trail->difficulty == 'green' ) : ?>
								<img src="<?php echo plugin_dir_url( dirname(__FILE__) ) . 'img/green-circle.svg'; ?>" alt="<?php _e('Green Circle', 'trail-manager'); ?>" />
							<?php elseif ( $trail->difficulty == 'blue' ) : ?>
								<img src="<?php echo plugin_dir_url( dirname(__FILE__) ) . 'img/blue-square.svg'; ?>" alt="<?php _e('Blue Square', 'trail-manager'); ?>" />
							<?php elseif ( $trail->difficulty == 'black' ) : ?>
								<img src="<?php echo plugin_dir_url( dirname(__FILE__) ) . 'img/black-diamond.svg'; ?>" alt="<?php _e('Black Diamond', 'trail-manager'); ?>" />
							<?php elseif ( $trail->difficulty == 'double_black' ) : ?>
								<img src="<?php echo plugin_dir_url( dirname(__FILE__) ) . 'img/double-black.svg'; ?>" alt="<?php _e('Double Black Diamond', 'trail-manager'); ?>" />
							<?php endif ?>
							</div><!-- /.difficulty-icon -->
							<?php if ( $trail->length != '' ) : ?>
								<div class="trail-length">
									<span class="trail-length"><?php echo $trail->length . __(' Miles', 'trail-manager') ?></span>
								</div><!-- /.trail-length -->
							<?php endif ?>
						</div><!-- /.left-side -->
						<div class="trail-description">
							<p><?php echo $trail->description; ?></p>
						</div><!-- /.trail-description -->
					</div><!-- /.trail-meta -->
				</div><!-- /.trail -->
			<?php endforeach ?>
		</div><!-- /.network -->
	<?php endwhile; ?>
	<!-- end of the loop -->

	<?php wp_reset_postdata(); ?>
	</div><!-- /.networks -->
<?php else : ?>
	<p><?php _e( 'Sorry, no trails found' ); ?></p>
<?php endif; ?>

