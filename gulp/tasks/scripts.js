module.exports = function(gulp, config, $) {

    return function() {
        var del = require("del");

        // Empty dist directory of all JS
        del([
            config.paths.dist + "**/*.{js,js.map,js.json}"
        ]);

        // Concat and minify all Javascript
        gulp.src(config.sources.scripts)
            .pipe($.sourcemaps.init())
            .pipe($.debug())
            .pipe($.concat("script.min.js"))
            .pipe($.uglify())
            .pipe($.rev())
            .pipe($.sourcemaps.write("./maps"))
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.rev.manifest("manifest.js.json"))
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.size());
    }
}
