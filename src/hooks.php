<?php

use Rudolf\Component\Hooks\Filter;

// textarea
Filter::add('admin_textarea', function ($args) {
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

// editor styles
Filter::add('admin_head_after', function ($after) {
  $after[] = '<style>div.mce-fullscreen {z-index: 1050}</style>';

  return $after;
});

// external scripts
Filter::add('admin_foot_scripts', function ($scripts) {
    $scripts[] = PLUGINS.'/tinymce/tinymce.min.js';

    return $scripts;
});

// inline scripts
Filter::add('admin_foot_after', function ($after) {
    $after[] = '<script>
        tinymce.init({
          mode : "specific_textareas",
          theme: "modern",
          selector: "textarea.tinymce",
          language_url : "'.PLUGINS.'/tinymce/langs/pl.js",
          language: "pl",
          relative_urls: false,
          entity_encoding: "raw",
          plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor filemanager code fullscreen",
            "responsivefilemanager"
          ],
          toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
          toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview code fullscreen",
          image_advtab: true,

          external_filemanager_path: "'.PLUGINS.'/responsive-file-manager/filemanager/",
          filemanager_title: "Responsive Filemanager" ,
          external_plugins: {
            "filemanager" : "plugins/filemanager/plugin.js"
          },
        });
    </script>';

    return $after;
});
