<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
				<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.
			?>

			<div id="openModal" class="modalDialog">
				<div>	<a href="#close" title="Close" class="close">X</a>

					<form action="mailto:asmita.subedi@deerwalk.edu.np" id="test" name="buyform" method="post" enctype="text/plain">
						Title: <input type="text" name="btnname"><br>
						Price: <input type="text" name="price"><br>
						Name: <input type="text" name="name"><br>
						Email: <input type="email" name="email"><br>
						Phone No: <input type="text" name="phno"><br>
						<input type="submit" value="Submit">
					</form>
				</div>
			</div>
			
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>    
    <script>
    $(document).ready(function()
    {
				$("#test").hide();
               	$("button").click(function()
                {
                    var c1 =($(this).data("class")); 
					alert(c1);
					var c2 = (c1.split("_")); alert(c2[0]);
					if(c2[0]== "tlbtn"){
						alert($(this).data("title"));alert($(this).data("price"));
						FormObject = document.forms['test'];
						alert(FormObject.elements["btnname"].value = $(this).data("title"));
						alert(FormObject.elements["price"].value = $(this).data("price"));
						$("#test").show();
						}
					else {
						$("#test").hide();
						}			
                });
            });
	</script>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
