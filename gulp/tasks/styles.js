module.exports = function(gulp, config, $) {

    return function() {
        var del = require("del");

        // Empty dist directory of CSS
        del([
            config.paths.dist + "**/*.{css,css.map,css.json}"
        ]);

        // Compile SASS, concat with any other CSS and minify
        gulp.src(config.sources.styles)
            .pipe($.debug())
            .pipe($.sourcemaps.init())
            .pipe($.sass())
            .pipe($.autoprefixer({
                browsers: ["last 5 versions", "> 1%", "ie 8", "ie 7"]
            }))
            .pipe($.concat("styles.min.css"))
            .pipe($.minifyCss())
            .pipe($.rev())
            .pipe($.sourcemaps.write("./maps", function() {
                includeContent: false
            }))
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.rev.manifest("manifest.css.json"))
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.size());
    }
}
