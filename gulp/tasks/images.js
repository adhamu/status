module.exports = function(gulp, config, $) {
    return function() {
        return gulp.src(config.sources.imgs, {
                base: "./"
            })
            .pipe($.debug())
            .pipe($.imagemin({
                progressive: true
            }))
            .pipe(gulp.dest("./"))
            .pipe($.size());
    }
}
