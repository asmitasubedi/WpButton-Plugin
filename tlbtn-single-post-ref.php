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

	<a href="#tlBtn-openModal"><button type="button" class="custom-buttons" data-class="tlbtn_2" data-title="Test" data-request-url="dfasfdsa" data-price="11111">dsfasd</button></a>

	<a href="#tlBtn-openModal"><button type="button" class="custom-buttons" data-class="tlbtn_23" data-title="Tessdfsfsfast" data-request-url="dfasfdsa" data-price="11121212111">dsfasd</button></a>



	<div id="tlBtn-openModal" class="tlBtn-modalDialog">
		<div>	<a href="#tlBtn-close" title="Close" class="tlBtn-close">X</a>

			<div id="tlbtn-product-title"><p>View Discounted Offers on <span id="tlbtn-product-name"> </span><p></div>

			<div id="tltbn-main-form">
				<form action="mailto:asmita.subedi@deerwalk.edu.np" id="tlbtnForm" name="buyform" method="post" enctype="text/plain">
					<!-- Title: <input type="text" name="btnname"><br>
                    Price: <input type="text" name="price"><br> -->

					<div class="tlbtn-form-field"> <label for="tlbtn-field-name">Name</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your full name" name="name"></div>

					<div class="tlbtn-form-field"> <label for="tlbtn-field-contact">Location</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your address (address and city)" name="location"></div>


					<div class="tlbtn-form-field"> <label for="tlbtn-field-contact">Phone</label> <input id="tlbtn-field-name-input" type="text" required="required" placeholder="Enter your hone number (9813XXXXXX or 01-44XXXXX)" name="phone"></div>




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

		$(document).ready(function()
		{
			//global url
			$url= window.location.href;
			console.log($url);


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

					//set data to variable to make cookies
					var productName = $(this).data("title");
					var productPrice = $(this).data("price");
					var productURL = $(this).data("request-url");

					//put product name on popup title
					$('#tlbtn-product-name').html(productName);

					//make cookies for email - product information
					document.cookie = "tlbtn_productName= " + productName;
					document.cookie = "tlbtn_productPrice= " + productPrice;
					document.cookie = "tlbtn_productRequestURL= " + productURL;
					document.cookie = "tlbtn_siteURL= " + window.location.origin+window.location.pathname;

					// FormObject.elements["btnname"].value = $(this).data("title");
					//$('#tlbtn-product-price').html = $(this).data("price");
					//	alert(FormObject.elements["price"].value = $(this).data("price"));
					//FormObject.elements["price"].value = $(this).data("price");
					//$("#test").show();
				}
				else {
					//$("#test").hide();
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
				//make cookies for email - personal information
				document.cookie = "tlbtn_name= " + FormObject.elements["name"].value;
				document.cookie = "tlbtn_location= " + FormObject.elements["location"].value;
				document.cookie = "tlbtn_phone= " + FormObject.elements["phone"].value;


				<?php
				//email information fetched from cookies
				$tlbtn_name = $_COOKIE["tlbtn_name"];
				$tlbtn_location = $_COOKIE["tlbtn_location"];
				$tlbtn_phone = $_COOKIE["tlbtn_phone"];
				$tlbtn_productName = $_COOKIE["tlbtn_productName"];
				$tlbtn_productPrice = $_COOKIE["tlbtn_productPrice"];
				$tlbtn_productRequestURL = $_COOKIE["tlbtn_productRequestURL"];
				$tlbtn_siteURL = $_COOKIE["tlbtn_siteURL"];

				//email template ready
				$to = 'agupta@alumni.deerwalk.edu.np';
				$date = date_create();
				$subject = 'View Discounted Offers [TechLekh] | Timestamp: ' . date_format($date, 'Y-m-d H:i:s');
				$body = 'Dear Admin, <br><br> You have got a view offer request from: <br><br><b>Person Information</b><br><b>Name:</b> '. $tlbtn_name . '<br><b>Location:</b>' . $tlbtn_location . '<br><b>Phone:</b> ' . $tlbtn_phone . '<br><br><b>Product Information</b><br>' . '<b>Name:</b> ' . $tlbtn_productName . '<br><b>Price:</b> '	. $tlbtn_productPrice . '<br><b>Request Link:</b> ' . $tlbtn_productRequestURL . '<br><b>Site Link</b> ' . $tlbtn_siteURL .
					'<br><br> Reach this person out asap.';

				$headers = array('Content-Type: text/html; charset=UTF-8');

				//send email
				wp_mail( $to, $subject, $body, $headers );
				?>

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
