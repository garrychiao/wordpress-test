<?php
/**
 * Template Name: One Page Layout
 *
 * @author Designova (designova.net)
 * @theme Signature
*/
 get_header();	
 $signature_options = signature_get_options('signature_wp');
?>

<?php
	

	$signature_page_count = 0; 
	$signature_countpages = wp_count_posts('page')->publish;
	$signature_pages = get_pages( 'sort_order=asc&sort_column=menu_order');
	//Count published pages
	foreach($signature_pages as $signature_page):

	setup_postdata($signature_page);
	
	

	//Anchor point and title
	$signature_newanchorpoint = strtolower(preg_replace('/\s+/', '-', $signature_page->post_name)); 
	$signature_new_title      = $signature_newanchorpoint;
	$signature_templ_name     = get_post_meta( $signature_page->ID, '_wp_page_template', true );
	$signature_filename       = preg_replace('"\.php$"', '', $signature_templ_name); 

	//Check wether to include in one page
	$signature_include_onepage =  get_post_meta($signature_page->ID,'_signature_one_page',true);

	


	

	if($signature_filename == 'the-onepage' AND $signature_include_onepage == 'yes')
	{

	}
	elseif($signature_include_onepage == 'yes')
	{
		$signature_page_count ++;
		if($signature_page_count == 2)
		{
			$nav_trigger_class = 'second-page';
		}
		else
			$nav_trigger_class = '';

		
		$container_enabled = get_post_meta($signature_page->ID,'_signature_full_width',true);
		if($container_enabled != 'on')
		{
			$container_class = 'container';
		}
		else
		{
			$container_class = '';
		}
		
	?>
		
		<section id="<?php echo esc_attr($signature_new_title); ?>" class="page signature-page-section <?php echo esc_attr($nav_trigger_class);?>">
			<?php
			
			
			if(get_post_meta($signature_page->ID,'_signature_page_title',true) != null || get_post_meta($signature_page->ID,'_signature_page_title',true) =='on')
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
			?>
			<section class="page-content">
				<div class="page-content-wrap-<?php echo esc_attr(signature_get_main_class()); ?> <?php echo esc_attr($container_class);?>">
					<?php the_content();?>
				</div>
			</section>
		</section>
		
	<?php
	}

	endforeach;

	

get_footer();
?>	  