module.exports = function(gulp, config, $) {

    return function() {
        var del = require("del");

        // Empty dist directory of CSS
        del([
            config.paths.dist + '**/*.css'
        ]);

        // Compile SASS, concat with any other CSS and minify
        gulp.src(config.sources.styles)
            .pipe($.debug())
            .pipe($.sass())
            .pipe($.autoprefixer({
                browsers: ["last 5 versions", "> 1%", "ie 8", "ie 7"]
            }))
            .pipe($.concat("styles.min.css"))
            .pipe($.minifyCss())
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
