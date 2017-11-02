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


<style>

	.tlBtn-modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0, 0, 0, 0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}
	.tlBtn-modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}
	.tlBtn-modalDialog > div {
		width: 600px;
		position: relative;
		margin: 5% auto;
		padding: 0;
		border-radius: 0px;
		background: #fff;
	}
	.tlBtn-close {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}
	.tlBtn-close:hover {
		background: #e41212;
		color: #fff;
	}
	div#tlbtn-product-title p {
		margin: 0;
		font-size: 18px;
		font-weight: bold;
		color: #383838;
	}
	div#tlbtn-product-title {
		background-color: #f8f8f8 !important;
		border-bottom: #f5f5f5 1px solid;
		padding: 12px 15px !important;
		box-shadow: 0 0 6px rgba(0,0,0,0.2);
		background: #d5d5d5;
	}
	div#tltbn-main-form {
		padding: 15px;
	}
	input#tlbtn-sumbit {
		background: #e41121;
		border-radius: 0;
	}

</style>
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

			<a href="#tlBtn-openModal"><button type="button" class="custom-buttons" data-class="tlbtn_2" data-title="Test" data-request-url="dfasfdsa" data-price="11111">dsfasd</button></a>

			<a href="#tlBtn-openModal"><button type="button" class="custom-buttons" data-class="tlbtn_23" data-title="Tessdfsfsfast" data-request-url="dfasfdsa" data-price="11121212111">dsfasd</button></a>



			<div id="tlBtn-openModal" class="tlBtn-modalDialog">
				<div>	<a href="#tlBtn-close" title="Close" class="tlBtn-close">X</a>

					<div id="tlbtn-product-title"><p>Buy <span id="tlbtn-product-name"> </span> | Price <span id="tlbtn-product-price"> </span><p></div>

					<div id="tltbn-main-form">
						<form action="mailto:asmita.subedi@deerwalk.edu.np" id="test" name="buyform" method="post" enctype="text/plain">
							<!-- Title: <input type="text" name="btnname"><br>
                            Price: <input type="text" name="price"><br> -->
							Name: <input type="text" name="name"><br>
							Email: <input type="email" name="email"><br>
							Phone No: <input type="text" name="phno"><br>

							<div id="tlbtn-sumit-div">
								<input id="tlbtn-sumbit" type="submit" value="Submit">
							</div>
						</form>
					</div>

				</div>
			</div>


			<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>

			<script>
				$(document).ready(function()
				{




					//$("#test").hide();
					$("button").click(function()
					{
						var c1 =($(this).data("class"));
						//alert(c1);

						var c2 = (c1.split("_"));
						//alert(c2[0]);

						if(c2[0]== "tlbtn"){
							//alert($(this).data("title"));alert($(this).data("price"));
							FormObject = document.forms['test'];
							//	alert(FormObject.elements["btnname"].value = $(this).data("title"));
							var productName = $(this).data("title");
							console.log(productName);
							$('#tlbtn-product-name').html(productName);
							// FormObject.elements["btnname"].value = $(this).data("title");

							$('#tlbtn-product-price').html = $(this).data("price");
							//	alert(FormObject.elements["price"].value = $(this).data("price"));

							//FormObject.elements["price"].value = $(this).data("price");










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
