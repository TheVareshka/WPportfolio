
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css2?family=Azeret+Mono:ital,wght@0,700;1,700&family=Inter&display=swap"
        rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header class="header__section">
			<div class="container">
				<div class="header__section-title">
					<a href="<?php esc_url(home_url("/"));?>">
						<h1><?php bloginfo('name');?></h1>
					</a>
				</div>
	
