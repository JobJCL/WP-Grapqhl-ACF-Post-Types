<?php 
/*
 * Plugin Name: Wordpress GraphQL ACF Post Types
 *  Description: Adds post types made with ACF to the GraphQL schema
 */

 add_action('acf/post_type/render_settings_tab/graphql', function ($acf_post_type) {
	acf_render_field_wrap(
		array(
			'label' => 'Show in GraphQL',
			'instructions' => 'Exposes this post type in the GraphQL schema',
			'name' => 'show_in_graphql',
			'prefix' => 'acf_post_type',
			'value' => isset($acf_post_type['show_in_graphql']) ? $acf_post_type['show_in_graphql'] : false,
			'type' => 'true_false',
			'ui' => 1,
		),
	);
});

add_action('acf/post_type/render_settings_tab/graphql', function ($acf_post_type) {
	acf_render_field_wrap(
		array(
			'label' => 'Graphql single name',
			'instructions' => '',
			'name' => 'graphql_single_name',
			'prefix' => 'acf_post_type',
			'value' => isset($acf_post_type['graphql_single_name']) ? $acf_post_type['graphql_single_name'] : '',
			'type' => 'text',
			'ui' => 2,
		),
	);
});

add_action('acf/post_type/render_settings_tab/graphql', function ($acf_post_type) {
	acf_render_field_wrap(
		array(
			'label' => 'Graphql plural name',
			'instructions' => '',
			'name' => 'graphql_plural_name',
			'prefix' => 'acf_post_type',
			'value' => isset($acf_post_type['graphql_plural_name']) ? $acf_post_type['graphql_plural_name'] : '',
			'type' => 'text',
			'ui' => 2,
		),
	);
});

add_filter('acf/post_type/registration_args', function ($args, $post_type) {
	if (isset($post_type['graphql_plural_name'])) {
		$args['graphql_plural_name'] = (string) $post_type['graphql_plural_name'];
	}

	return $args;
}, 10, 2);

add_filter('acf/post_type/registration_args', function ($args, $post_type) {
	if (isset($post_type['graphql_single_name'])) {
		$args['graphql_single_name'] = (string) $post_type['graphql_single_name'];
	}

	return $args;
}, 10, 2);

add_filter('acf/post_type/registration_args', function ($args, $post_type) {
	if (isset($post_type['show_in_graphql'])) {
		$args['show_in_graphql'] = (bool) $post_type['show_in_graphql'];
	}

	return $args;
}, 10, 2);

add_filter('acf/post_type/additional_settings_tabs', function ($tabs) {
	$tabs['graphql'] = 'GraphQL';

	return $tabs;
});