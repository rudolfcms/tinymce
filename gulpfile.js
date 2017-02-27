var _  = require("lodash");
var del = require("del");
var gulp = require("gulp");
var rename = require("gulp-rename");
var runSequence = require("run-sequence");

var paths = {
  npm: "./node_modules/",
  bower: "./bower_components/",
  dest: "./build/"
}; 

var npm = {
  "tinymce": "tinymce/**/*.{min\.js,min\.css,ttf,svg,woff,eot}",
  "tinymce-i18n": "tinymce-i18n/**/*.js"
}

gulp.task("copy-assets", function () {
  for (var destinationDir in npm) {
    gulp.src(paths.npm + npm[destinationDir])
      .pipe(gulp.dest(paths.dest));
  }
});

gulp.task("responsivefilemanager-addon", function () {
  gulp.src(paths.bower + "ResponsiveFilemanager/resources/assets/js/plugin.js")
      .pipe(gulp.dest("./build/plugins/filemanager/"));

  gulp.src(paths.bower + "ResponsiveFilemanager/resources/assets/js/plugin_responsivefilemanager_plugin.js")
      .pipe(rename("plugin.min.js"))
      .pipe(gulp.dest("./build/plugins/responsivefilemanager/"));
});

gulp.task("php", function () {
  gulp.src("./src/**/*.php")
    .pipe(gulp.dest(paths.dest));
});

gulp.task("clean", function() {
  return del.sync(paths.dest);
})

// Build Sequences
// ---------------

gulp.task("default", ["build"]);

gulp.task("build", function() {
  runSequence("clean", ["copy-assets", "php"], "responsivefilemanager-addon")
});
