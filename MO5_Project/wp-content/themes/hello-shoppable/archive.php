<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello Shoppable
 */

get_header();

if( ( function_exists( 'bcn_display' ) && ( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_pages' || get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ) ) || get_theme_mod( 'enable_blog_archive_page_title', true ) ){
	?>
	<div class="page-head">
		<div class="container">
			<?php
			if( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_pages' || get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ){
				hello_shoppable_breadcrumb_wrap();
			} 
			if( get_theme_mod( 'enable_blog_archive_page_title', true ) ){
				hello_shoppable_blog_page_title();
			}
			?>
		</div>
	</div>
<?php } ?>
<div id="content" class="site-content">
	<div class="container">
		<section class="wrap-detail-page ">
				<div class="row">
					<?php
						$sidebarClass = 'col-lg-8';
						$sidebarColumnClass = 'col-lg-4';
						$masonry_class = '';

						if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid'){
							$masonry_class = 'masonry-wrapper';
						}
						if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
							$layout_class = 'grid-post-wrap';
						}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
							$layout_class = 'single-post';
						}
						if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){
							if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
								if( !is_active_sidebar( 'right-sidebar') ){
									$sidebarClass = "col-12";
								}	
							}else{
								if( !is_active_sidebar( 'right-sidebar') ){
									$sidebarClass = "col-lg-8 offset-lg-2";
								}
							}
						}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){
							if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
								if( !is_active_sidebar( 'left-sidebar') ){
									$sidebarClass = "col-12";
								}	
							}else{
								if( !is_active_sidebar( 'left-sidebar') ){
									$sidebarClass = "col-lg-8 offset-lg-2";
								}
							}
						}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
							$sidebarClass = 'col-lg-6';
							$sidebarColumnClass = 'col-lg-3';
							if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
								if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
									$sidebarClass = "col-12";
								}	
							}else{
								if(!is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
									$sidebarClass = "col-lg-8 offset-lg-2";
								}
							}
						}
						if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' || !get_theme_mod( 'sidebar_blog_page', true ) ){
							if( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
								$sidebarClass = "col-12";
							}else{
								$sidebarClass = 'col-lg-8 offset-lg-2';
							}
						}
						if( get_theme_mod( 'sidebar_blog_page', true ) ){
							if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){ 
								if( is_active_sidebar( 'left-sidebar') ){ ?>
									<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'left-sidebar' ); ?>
									</div>
							<?php }
								}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
									if( is_active_sidebar( 'left-sidebar') || is_active_sidebar( 'right-sidebar') ){ ?>
										<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
											<?php dynamic_sidebar( 'left-sidebar' ); ?>
										</div>
							<?php
									}
								}
						} ?>
					
					<div id="primary" class="content-area <?php echo esc_attr( $sidebarClass ); ?>">
						<div class="row <?php echo esc_attr( $masonry_class ); ?>">
						<?php
						if ( have_posts() ) :

							if ( is_home() && !is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

						elseif ( !is_sticky() && ! have_posts() ):
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
						</div><!-- #main -->
						<?php
							if( get_theme_mod( 'enable_pagination', true ) ):
								the_posts_pagination( array(
									'next_text' => '<span>'.esc_html__( 'Next', 'hello-shoppable' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'hello-shoppable' ) . '</span>',
									'prev_text' => '<span>'.esc_html__( 'Prev', 'hello-shoppable' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'hello-shoppable' ) . '</span>',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'hello-shoppable' ) . ' </span>',
								));
							endif;
						?>
					</div><!-- #primary -->
					<?php
						if( get_theme_mod( 'sidebar_blog_page', true ) ){
							if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){ 
								if( is_active_sidebar( 'right-sidebar') ){ ?>
									<div id="secondary" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'right-sidebar' ); ?>
									</div>
								<?php }
							}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
								if( is_active_sidebar( 'left-sidebar') || is_active_sidebar( 'right-sidebar') ){ ?>
									<div id="secondary-sidebar" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'right-sidebar' ); ?>
									</div>
							<?php
								}
							}
						}
					?>
				</div>
		</section>
	</div><!-- #container -->
</div><!-- #content -->	
<?php
get_footer();
