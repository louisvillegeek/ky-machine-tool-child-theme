const gulpWebpack = require('gulp-webpack');
const gulp = require('gulp');
const webpack = require('webpack');

function getTsTask(production = false, watch = false) {
    let webPackConfig = require('../webpack.config.js');

    if(production) {
        webPackConfig.mode = 'production';
        webPackConfig.optimization = {
            minimize: true
        };
    }

    if(watch)
        webPackConfig.watch = true;
    return gulp.src('assets/ts/src/main.ts')
        .pipe(gulpWebpack(webPackConfig, webpack))
        .pipe(gulp.dest('assets/ts/dist/'))
}

module.exports.getTsTask = getTsTask;


/**
 * Build typescript with webpack
 */
gulp.task('ts',function() { return getTsTask() });

/**
 * Build typescript with webpack
 */
gulp.task('ts-production',function() {return getTsTask(true) });

/**
 * Watch the typescript compilation
 */
gulp.task('watch-ts', function() { return getTsTask(false, false) });
