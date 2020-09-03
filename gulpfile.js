'use strict';
const gulp = require('gulp');

/**
 * library imports
 */
require('./build/AssetControl');
require('./build/codesniffer');
require('./build/ts');
require('./build/scss');
require('./build/package');
require('./build/version');
require('./build/deploy');

/**
 * Watch sass and typescript compilation
 */
gulp.task('watch', gulp.parallel('watch-scss', 'watch-ts'));


/**
 * Build sass and typescript for production.
 */
gulp.task('build-production', gulp.parallel('ts-production', 'scss-production'));

/**
 * Build sass and typescript for local development
 */
gulp.task('build', gulp.series('ts', 'scss'));


