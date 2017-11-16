<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_format( 'video' ) ) : ?>
		<div class="entry-image video">
			<?php echo hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ); ?>
		</div>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>
		<div class="entry-image audio">
			<?php echo hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ); ?>
		</div>
	<?php elseif ( has_post_format( 'image' ) )	: // do nothing ?>
	<?php elseif ( has_post_format( 'gallery' ) ) : ?>
		<?php echo sitebox_get_format_gallery(); // Get the gallery ?>
	<?php else : ?>

		<?php
		// Get the data set in customizer
		$enable = sitebox_mod( 'sitebox-post-thumbnail' );
		if ( $enable && has_post_thumbnail() ) :
			// for has_sidebar
			$size = 'post-thumbnail';
			// for no sidebar
			if ( current_theme_supports( 'theme-layouts' ) && ! is_admin() ) {
				if ( 'layout-1c' == hybrid_theme_layouts_get_layout() ) {
					$size = 'large';
				}
			}
			?>
			<div class="entry-image clearfix" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<?php the_post_thumbnail( $size, array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
				<meta itemprop="url" content="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
				<meta itemprop="width" content="800">
				<meta itemprop="height" content="480">
			</div>
		<?php endif; ?>

	<?php endif; ?>

	<?php sitebox_entry_publisher(); ?>

	<header class="entry-header wrap">

		<?php the_title( '<h1 ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>

		<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>" content="<?php echo esc_attr( get_the_title() ); ?>" />

		<div class="entry-meta clearfix">

			<?php sitebox_posted_on_single(); ?>

			<?php sitebox_entry_author(); ?>

			<?php sitebox_entry_like(); ?>

			<?php sitebox_comment_count_single(); ?>

		</div><!-- .entry-meta -->

	</header>


	<div <?php hybrid_attr( 'entry-content' ); ?>>

		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sitebox' ),
			'after'  => '</div>',
		) );
		?>

	</div>


	<div id="tlBtn-openModal" class="tlBtn-modalDialog">
		<div>	<a href="#tlBtn-close" title="Close" class="tlBtn-close">X</a>

			<div id="tlbtn-product-title"><p>View Discounted Offers on <span id="tlbtn-product-name"> </span><p></div>

			<div id="tltbn-main-form">
				<form id="tlbtnForm" name="buyform" method="post" enctype="text/plain">

					<div class="tlbtn-form-field"> <label for="tlbtn-field-name">Name</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your full name" name="name"></div>

					<div class="tlbtn-form-field"> <label for="tlbtn-field-contact">Location</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your address (address and city)" name="location"></div>


					<div class="tlbtn-form-field"> <label for="tlbtn-field-contact">Phone</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your phone number (9813XXXXXX or 01-44XXXXX)" name="phone"></div>


					<div id="tlbtn-sumit-div">
						<div id="tlbtn-sumbit">
							<input  type="button" value="Submit">
						</div>
					</div>

				</form>

				<div id="tlbtn-text">We value your privacy. Your details are secure with us.</div>
			</div>
		</div>
	</div>

	<div id="tlbtn-openSuccessDialog" class="tlbtn-successDialog">
		<div id="tlbtn-success-internal">
			<a href="#tlBtn-close" title="Close" class="tlBtn-close">X</a>

			<div id="tlbtn-success-box">
				<div id="tlbtn-product-title"><p>Query received successfully!</p></div>

				<div id="tltbn-main-form">
					<h3>We will call you shortly to provide details on discounted offers.</h3>
					<h4>Have a good day!</h4>
				</div>
			</div>

		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>

	<script>
		var tlbtn_productName, tlbtn_productPrice, tlbtn_productRequestURL, tlbtn_siteURL;
		$(document).ready(function()
		{
			//global url
			$url= window.location.href;
			console.log($url);

			$("button").click(function()
			{
				var c1 =($(this).data("class"));
				//alert(c1);
				var c2 = (c1.split("_"));
				//alert(c2[0]);
				if(c2[0]== "tlbtn"){
					
					//set data to variable to make cookies
					tlbtn_productName = $(this).data("title");
					tlbtn_productPrice = $(this).data("price");
					tlbtn_productRequestURL = $(this).data("request-url");
					tlbtn_siteURL = window.location.origin+window.location.pathname;

					//put product name on popup title
					$('#tlbtn-product-name').html(tlbtn_productName);
				}
			});
		});

		//submit button action
		$("#tlbtn-sumbit").click(function(){
			FormObject = document.forms['tlbtnForm'];
			var name = FormObject.elements["name"].value;
			var location = FormObject.elements["location"].value;
			var phone = FormObject.elements["phone"].value
			//if empty throw error
			if(name == "" || location == "" || phone ==""){
				alert("Please, fill up all the fields.");
			}
			//on success
			else {
					
				var $j = jQuery.noConflict();
				console.log("Hii");
				$j.post(tlbtn.ajax_url, {         							//POST request
          				 _ajax_nonce: tlbtn.nonce,     							//nonce
           				 action: "save_to_db",           						 //action
            			tlbtn_productName : '+tlbtn_productName+',				//data
						tlbtn_productPrice : '+tlbtn_productPrice+',
						tlbtn_productRequestURL : '+tlbtn_productRequestURL+',
						tlbtn_name: '+name+'},             		
   					 	function(response) {                    				//callback
            				alert(response.productname);
              				alert(response.productprice);	//insert server response
        		});
				
				//cleaning the $url
				$url=window.location.origin+window.location.pathname;
				window.location = $url+'#tlbtn-openSuccessDialog';
			}
			console.log("Name: " + name + " Location: " + location + " Phone: "+ phone);
		});

		//on close button
		$(".tlBtn-close").click(function(){
			console.log(window.location.origin+window.location.pathname);
			//cleaning the $url
			$url=window.location.origin+window.location.pathname;
		});
	</script>

	<footer class="entry-footer wrap clearfix">

		<?php sitebox_entry_category( true ); ?>

		<?php sitebox_entry_tags(); ?>

		<?php sitebox_entry_share_single(); ?>

	</footer>


	<?php if ( function_exists( 'sharing_display' ) ) : ?>
		<div class="jetpack-share-like">
			<?php sharing_display( '', true ); ?>
			<?php if ( class_exists( 'Jetpack_Likes' ) ) { $custom_likes = new Jetpack_Likes; echo $custom_likes->post_likes( '' ); } ?>
		</div>
	<?php endif; ?>

</article><!-- #post-## -->