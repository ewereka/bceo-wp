const { series, parallel, src, dest, watch, task } = require("gulp");
const autoprefixer = require("gulp-autoprefixer");
const uglifyES = require("uglify-es");
const composer = require("gulp-uglify/composer");
const sass = require("gulp-sass");
const sourcemaps = require("gulp-sourcemaps");
const concat = require("gulp-concat");
const stripStyleComments = require("gulp-strip-css-comments");
const stripComments = require("gulp-strip-comments");
const cssmin = require("gulp-clean-css");
const del = require("del");
const fancyLog = require("fancy-log");
const replace = require("gulp-string-replace");
const environments = require("gulp-environments");
const imagemin = require("gulp-imagemin");
const imageminOptipng = require("imagemin-optipng-progressive");
const gap = require("gulp-append-prepend");
const p = require("./package.json");

const uglify = composer(uglifyES, console);
const envBuild = environments.make("build");
const jsFolder = "js/";
const cssFolder = "css/";
const sassFolder = "scss/";
const fontFolder = "font/";
const imgFolder = "img/";
const vendorFolder = "vendor/";
const srcFolder = "src/";
const distFolder = "dist/";
const incFolder = "includes/";
const rootFolder = "./";
const themeFolder = rootFolder + "themes/bceo/";
const pluginFolder = rootFolder + "plugins/bceo-custom/";
// const humansFolder = rootFolder + "humans-txt/";
const nodeModules = rootFolder + "node_modules/";

//File Arrays
var paths = {
  scripts: {
    vendor: [
      themeFolder + jsFolder + vendorFolder + "jquery/jquery.js",
      themeFolder + jsFolder + vendorFolder + "jquery-parallax/parallax.js",
      themeFolder + jsFolder + vendorFolder + "popper/umd/popper.js",
      themeFolder + jsFolder + vendorFolder + "bootstrap/bootstrap.js",
    ],
    src: [themeFolder + jsFolder + srcFolder + "main.js"],
    editorSrc: [themeFolder + jsFolder + srcFolder + "editor.js"],
    watch: [themeFolder + jsFolder + srcFolder + "**/*.js"],
  },
  styles: {
    src: [themeFolder + sassFolder + "main.scss"],
    editorSrc: [themeFolder + sassFolder + "editor.scss"],
    watch: [
      themeFolder + sassFolder + "main.scss",
      themeFolder + sassFolder + "editor.scss",
      themeFolder + sassFolder + incFolder + "**/*.scss",
    ],
  },
  images: {
    src: [themeFolder + imgFolder + srcFolder + "**/*.{png,gif,jpg,jpeg,svg}"],
    watch: [
      themeFolder + imgFolder + srcFolder + "**/*.{png,gif,jpg,jpeg,svg}",
    ],
  },
  replace: [
    // humansFolder + "humans.txt",
    themeFolder + "style.css",
  ],
  clean: {
    scripts: [
      themeFolder + jsFolder + vendorFolder,
      themeFolder + jsFolder + distFolder,
    ],
    styles: [themeFolder + sassFolder + vendorFolder, themeFolder + cssFolder],
    images: [themeFolder + imgFolder + distFolder],
  },
};

const date_today = () => {
  var today = new Date();
  var day = today.getDate();
  var month = today.getMonth() + 1; //January is 0!
  var year = today.getFullYear();

  if (day < 10) {
    day = "0" + day;
  }

  if (month < 10) {
    month = "0" + month;
  }

  today = year + "/" + month + "/" + day;
  return today;
};

const vendor_fontawesome = () => {
  "use strict";
  return src(nodeModules + "@fortawesome/fontawesome-free/**/*.*").pipe(
    dest(themeFolder + fontFolder + vendorFolder + "fontawesome")
  );
};

const vendor_jquery_scripts = () => {
  "use strict";
  return src(nodeModules + "jquery/dist/**/*.*").pipe(
    dest(themeFolder + jsFolder + vendorFolder + "jquery")
  );
};

const vendor_parallax_scripts = () => {
  "use strict";
  return src(nodeModules + "jquery-parallax.js/*.js").pipe(
    dest(themeFolder + jsFolder + vendorFolder + "jquery-parallax")
  );
};

const vendor_popper_scripts = () => {
  "use strict";
  return src(nodeModules + "popper.js/dist/**/*.js").pipe(
    dest(themeFolder + jsFolder + "/" + vendorFolder + "popper")
  );
};

const vendor_bootstrap_scripts = () => {
  "use strict";
  return src(nodeModules + "bootstrap/dist/js/*.js").pipe(
    dest(themeFolder + jsFolder + "/" + vendorFolder + "bootstrap")
  );
};

const vendor_bootstrap_styles = () => {
  "use strict";
  return src(nodeModules + "bootstrap/scss/**/*.*").pipe(
    dest(themeFolder + sassFolder + vendorFolder + "bootstrap")
  );
};

const build_styles = () => {
  "use strict";
  return src(paths.styles.src)
    .pipe(sourcemaps.init())
    .pipe(
      sass().on("error", function (error) {
        fancyLog.error(error);
      })
    )
    .pipe(autoprefixer())
    .pipe(concat("main.css"))
    .pipe(stripStyleComments({ preserve: false }))
    .pipe(replace("{{VERSION}}", p.version))
    .pipe(envBuild(cssmin()))
    .pipe(sourcemaps.write("./"))
    .pipe(dest(themeFolder + cssFolder));
};

const build_editor_styles = () => {
  "use strict";
  return src(paths.styles.editorSrc)
    .pipe(sourcemaps.init())
    .pipe(
      sass().on("error", function (error) {
        fancyLog.error(error);
      })
    )
    .pipe(autoprefixer())
    .pipe(concat("editor.css"))
    .pipe(stripStyleComments({ preserve: false }))
    .pipe(replace("{{VERSION}}", p.version))
    .pipe(envBuild(cssmin()))
    .pipe(sourcemaps.write("./"))
    .pipe(dest(themeFolder + cssFolder));
};

const build_scripts = () => {
  "use strict";
  return src(paths.scripts.vendor.concat(paths.scripts.src))
    .pipe(sourcemaps.init())
    .pipe(concat("main.js"))
    .pipe(envBuild(stripComments()))
    .pipe(envBuild(uglify()))
    .pipe(sourcemaps.write("./"))
    .pipe(dest(themeFolder + jsFolder + distFolder));
};

const build_editor_scripts = () => {
  "use strict";
  return src(paths.scripts.editorSrc)
    .pipe(sourcemaps.init())
    .pipe(concat("editor.js"))
    .pipe(envBuild(stripComments()))
    .pipe(envBuild(uglify()))
    .pipe(sourcemaps.write("./"))
    .pipe(dest(themeFolder + jsFolder + distFolder));
};

// const build_images = () => {
//   "use strict";
//   return src(paths.images.src)
//   .pipe(envBuild(imagemin()))
//   .pipe(dest(themeFolder + imgFolder + distFolder));
// }

const clean_styles = () => {
  "use strict";
  return del(paths.clean.styles);
};

const clean_scripts = () => {
  "use strict";
  return del(paths.clean.scripts);
};

// const clean_images = () => {
//   "use strict";
//   return del(paths.clean.images);
// }

// function server_replace() {
//   "use strict";
//   return src(paths.replace, {base: "./"})
//   .pipe(envBuild(replace("{{VERSION}}", p.version)))
//   .pipe(envBuild(replace("{{COMMIT_DATE}}", date_today())))
//   .pipe(envBuild(dest("./")));
// }

const watch_files = () => {
  "use strict";
  watch(
    paths.scripts.watch,
    series(clean_scripts, move_scripts, build_scripts, build_editor_scripts)
  );
  watch(paths.styles.watch, series(clean_styles, move_styles, build_styles, build_editor_styles));
};

const clean = parallel(clean_styles, clean_scripts /*, clean_images*/);
const move_styles = parallel(vendor_fontawesome, vendor_bootstrap_styles);
const move_scripts = parallel(
  vendor_jquery_scripts,
  vendor_parallax_scripts,
  vendor_popper_scripts,
  vendor_bootstrap_scripts
);
const move = parallel(move_scripts, move_styles);
const build = series(
  clean,
  move,
  build_styles,
  build_editor_styles,
  build_scripts,
  build_editor_scripts /*build_images, server_replace*/
);
const build_watch = series(build, watch_files);

// Export tasks
exports.default = build_watch;
exports.build = build;
exports.watch = watch_files;
