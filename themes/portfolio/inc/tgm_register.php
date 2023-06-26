<?php

add_action( 'tgmpa_register', 'portfolio_register_required_plugins' );

function portfolio_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'Portfolio Extension', // The plugin name.
			'slug'               => 'portfolio', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/protfolio.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		),

		array(
			'name'      => 'Elementor Website Builder – More than Just a Page Builder',
			'slug'      => 'elementor',
			'required'  => false,
		),


	);

	$config = array(
		'id'           => 'portfolio',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
