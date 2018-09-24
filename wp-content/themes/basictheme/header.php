<!DOCTYPE>
<html>
<head>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<!--<link rel="stylesheet" type="text/css" href="css/basictheme.css">-->
<!--<link rel="stylesheet" type="text/css" href="css/normalize.css">-->
<!--<link rel="stylesheet" type="text/css" href="/style.css">-->
<link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase|Source+Sans+Pro|Roboto" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<title><?php the_title(); ?></title>
  <?php wp_head(); ?>
</head>

	<?php 
		
		if( is_front_page() ):
			$basictheme_classes = array( 'basictheme-class', 'my-class' );
		else:
			$basictheme_classes = array( 'no-basictheme-class' );
		endif;
		
	?>
	
	<body class="m-2" <?php body_class( $basictheme_classes ); ?>>
<div class="row bg-dark">
	<div class='col-12 d-flex justify-content-center text-white my-3'>
<h1 class="text-center display-5">JOYCE McCULLOCH</h1>
</div>
</div>
<div class="row">
		<div class='col-12 d-flex justify-content-center'>
<p class="my-2">VOCALIST</p>
</div>
</div>
<div class="row">
<div class="col-12 d-none d-md-block justify-content-center text-center">	<?php wp_nav_menu(array('theme_location'=>'primary')); ?></div>
</div>
<div class="row">
	<div class="col-12 d-xs-block d-md-none text-center">
<img id="mobile-photo" src="/wp-content/uploads/2018/07/Joyce_about_mobile-300x300.jpg" alt="Joyce McCulloch"/></p>
</div>
</div>
<img id="main-photo" class="d-none d-md-block" src="/wp-content/uploads/2018/06/Joyce_about-200x300.jpg" alt="Joyce McCulloch"/></p>
</div>
</div>