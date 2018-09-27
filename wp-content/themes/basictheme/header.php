<!DOCTYPE>
<html>

<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase|Source+Sans+Pro|Roboto" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<title>
		<?php the_title(); ?>
	</title>
	<?php wp_head(); ?>
</head>

<?php 
		
		if( is_front_page() ):
			$basictheme_classes = array( 'basictheme-class', 'my-class' );
		else:
			$basictheme_classes = array( 'no-basictheme-class' );
		endif;
		
	?>

<body <?php body_class( $basictheme_classes ); ?>>
							<div class="wrapper">
	<header class="bg-dark">
		<div class="row">
			<div class='col-12 d-flex justify-content-center text-white pt-3'>
				<h3 class="text-center my-0">JOYCE McCULLOCH</h3>
			</div>
		</div>
		<div class="row">
			<div class='col-12 d-flex justify-content-center text-white pt-2'>
				<p>VOCALIST</p>
			</div>
		</div>
			</header>
		<div class="row">
			<div class="col-12 d-none d-lg-flex justify-content-center my-1 pt-2">
				<?php wp_nav_menu(array('theme_location'=>'primary')); ?>
			</div>
		</div>
		<div class="row d-xs-block d-lg-none">
			<div class="col-12 text-center">
				<div class="col-10 col-offset-1 m-auto pt-4">
					<img id="mobile-photo" class="rounded" style="" src="/wp-content/uploads/2018/07/Joyce_about_mobile-300x300.jpg" alt="Joyce McCulloch" /></p>
				</div>
			</div>
		</div>
		<div class="row d-none d-lg-block">
			<div class="col-12">
				<div>
					<img id="main-photo" class="rounded" src="/wp-content/uploads/2018/06/Joyce_about-200x300.jpg" alt="Joyce McCulloch" /></p>
				</div>
			</div>
		</div>

