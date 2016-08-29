<?php

use Rudolf\Component\Hooks\Filter;

// textarea
Filter::add('admin_textarea', function($args) {
	$html = sprintf('<textarea name="%2$s" class="%3$s" id="%4$s" placeholder="%5$s" cols="%6$s" rows="%7$s">%1$s</textarea>',
        $args['content'],
        $args['name'],
        $args['class'].' tinymce',
        $args['id'],
        $args['placeholder'],
        $args['cols'],
        $args['rows']
    );

    return $html;
});

// external scripts
Filter::add('admin_foot_scripts', function($scripts) {
	$scripts[] = PLUGINS.'/tinymce/bower_components/tinymce/tinymce.min.js';
	return $scripts;
});

// inline scripts
Filter::add('admin_foot_after', function($after) {
	$after[] = '<script>tinymce.init({ selector:"textarea.tinymce"});</script>';
	return $after;
});
