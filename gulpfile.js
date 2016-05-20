var gulp   = require("gulp"),
    $      = require("gulp-load-plugins")(),
    config = require("./gulp/config.json"),
    tasks  = ["styles", "scripts"];

// Main tasks
for (i = 0; i < tasks.length; i++) {
    gulp.task(tasks[i], require("./gulp/tasks/"+tasks[i])(gulp, config, $));
}

// Watch
gulp.task("watch", function() {
    gulp.watch(config.paths.scss+"*.scss", ["styles"]);
    gulp.watch(config.paths.js+"*.js", ["scripts"]);
    gulp.watch(config.paths.bower+"*.{scss,css}", ["styles"]);
    gulp.watch(config.paths.bower+"*.js", ["scripts"]);
});

// Default task
gulp.task("default", ["styles", "scripts", "watch"]);

// Install
gulp.task("install", ["styles", "scripts"]);
