<?php
get_header();
$signature_options = signature_get_options('signature_wp');

if ( have_posts() ) :
	// Start the Loop.
	while ( have_posts() ) : the_post();
	
	

	$container_enabled = get_post_meta(get_the_ID(),'_signature_full_width',true);
	if($container_enabled != 'on')
	{
		$container_class = 'container';
	}
	else
	{
		$container_class = '';
	}

		
?>

		<section id="page-<?php echo esc_attr(get_the_ID()); ?>" >
			
				<?php
				
				
				if(!class_exists( 'CMB2', false ))
				{
				?>
					<section class="project-page-head white-bg">
					   	<div class="container">
					      <div class="row add-top add-bottom">
					          <article class="col-md-12 text-center">
					            <h3 class="black font3bold"><?php echo get_the_title(); ?></h3>
					          </article>
					      </div>
					   	</div>
					</section>
				<?php
				}
				else
				{
					if(get_post_meta(get_the_ID(),'_signature_page_title',true) == 'on'){
				?>
					<section class="project-page-head white-bg">
					   	<div class="container">
					      <div class="row add-top add-bottom">
					          <article class="col-md-12 text-center">
					            <h3 class="black font3bold"><?php echo get_the_title(); ?></h3>
					          </article>
					      </div>
					   	</div>
					</section>
				<?php
					}
				}
				?>
				<section class="page-content">
					<div class="page-content-wrap-<?php echo esc_attr(signature_get_main_class()); ?> <?php echo esc_attr($container_class);?>">
						<?php the_content();?>
					</div>
				</section>
				
			
			<div class="hidden"><?php wp_link_pages(); ?></div>
			<?php
		    if(comments_open())
		    {
		    ?>
		    <!-- inner-section : starts -->
		    <section class=" inner-section add-top pad-top pad-bottom offwhite-bg comments-wrap">
			    <section class="container">
			        <div class="row">
		              <div class="col-md-12">
		                <?php comments_template( '', true ); ?>
		              </div>
			        </div>
			    </section>
			</section>
		    <?php
			}
		    ?>
		</section>
		

<?php
	endwhile;
endif;

get_footer();
?>