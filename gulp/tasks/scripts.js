module.exports = function(gulp, config, $) {

    return function() {
        var del = require("del");

        // Empty dist directory of all JS
        del([
            config.paths.dist + '**/*.js'
        ]);

        // Concat and minify all Javascript
        gulp.src(config.sources.scripts)
            .pipe($.debug())
            .pipe($.concat("script.min.js"))
            .pipe($.uglify())
            .pipe($.rev())
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.rev.manifest(config.paths.dist + 'manifest.json', {
                base: process.cwd() + '/' + config.paths.dist,
                merge: true
            }))
            .pipe(gulp.dest(config.paths.dist))
            .pipe($.size());
    }
}
