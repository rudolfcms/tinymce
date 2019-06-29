const { task, src, dest, series, parallel } = require("gulp");
const rename = require("gulp-rename");
const del = require("del");

const paths = {
  npm: "./node_modules/",
  bower: "./bower_components/",
  dest: "./build/"
};

const npm = {
  "tinymce": "tinymce/**/*.{min\.js,min\.css,ttf,svg,woff,eot}",
  "tinymce-i18n": "tinymce-i18n/**/*.js"
};

task("copy-assets", function (done) {
  for (const destinationDir in npm) {
    src(paths.npm + npm[destinationDir])
      .pipe(dest(paths.dest));
  }
  done();
});

task("responsivefilemanager-addon", function (done) {
  src(paths.npm + "responsive-filemanager/resources/assets/js/plugin.js")
      .pipe(dest("./build/plugins/filemanager/"));

  src(paths.npm + "responsive-filemanager/resources/assets/js/plugin_responsivefilemanager_plugin.js")
      .pipe(rename("plugin.min.js"))
      .pipe(dest("./build/plugins/responsive-filemanager/"));
  done();
});

task("php", function (done) {
  src("./src/**/*.php")
    .pipe(dest(paths.dest));
  done();
});

task("clean", function() {
  return del([paths.dest]);
});

// Build Sequences
// ---------------

task("build", series("clean", parallel("copy-assets", "php"), "responsivefilemanager-addon"));

exports.default = series("build");
