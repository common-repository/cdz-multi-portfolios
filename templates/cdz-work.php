<?php

namespace cdzMultiPortfolios;

/*
 *	cdzTemplate: Single Work
 */

$cdz_work_title		= $post->post_title;
$cdz_work_content	= $post->post_content;

$cdz_work_customer_label	= get_post_meta( $post->ID, 'cdz_work_customer_label', true );
$cdz_work_customer			= get_post_meta( $post->ID, 'cdz_work_customer', true );
$cdz_work_website_label		= get_post_meta( $post->ID, 'cdz_work_website_label', true );
$cdz_work_website_url		= get_post_meta( $post->ID, 'cdz_work_website_url', true );
$cdz_work_skills_label		= get_post_meta( $post->ID, 'cdz_work_skills_label', true );
$cdz_work_skills			= get_post_meta( $post->ID, 'cdz_work_skills', true );

?>

<?php get_header(); ?>

	<div id="primary" class="cdz_portfolio site-content">
		<div id="content" role="main">
			<div id="cdz_work-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-header">
					<?php the_post_thumbnail( 'medium' ); ?>
					<h1 class="entry-title"><?php echo $cdz_work_title; ?></h1>
				</div>

				<div class="entry-content"><p><?php echo do_shortcode( $cdz_work_content ); ?></p></div>

				<div class="entry-meta">
					<?php if ( $cdz_work_customer ) : ?>
						<p class="customer">
							<i class="fa fa-user"></i>
							<span class="label"><?php echo $cdz_work_customer_label ? $cdz_work_customer_label : __( 'Customer' ) . ': '; ?></span>
							<span class="text"><?php echo $cdz_work_customer; ?></span>
						</p>
					<?php endif; ?>
					<?php if ( $cdz_work_website_url ) : ?>
						<p class="customer">
							<i class="fa fa-globe"></i>
							<span class="label"><?php echo $cdz_work_website_label ? $cdz_work_website_label : __( 'Website' ) . ': '; ?></span>
							<span class="text"><a href="<?php echo esc_url( $cdz_work_website_url ); ?>"><?php echo $cdz_work_website_url; ?></a></span>
						</p>
					<?php endif; ?>
					<?php if ( $cdz_work_skills ) : ?>
						<p class="customer">
							<i class="fa fa-tasks"></i>
							<span class="label"><?php echo $cdz_work_skills_label ? $cdz_work_skills_label : __( 'Skills' ) . ': '; ?></span>
							<span class="text"><?php echo $cdz_work_skills; ?></span>
						</p>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>