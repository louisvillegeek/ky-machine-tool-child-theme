const sass = require('gulp-sass');
const stylelint = require('gulp-stylelint');
const autoPrefixer = require('gulp-autoprefixer');
const sourceMaps = require('gulp-sourcemaps');
const cleanCSS = require('gulp-clean-css');
const gulp = require('gulp');


function getSassTask(path, production = false) {
    if (production) {
        // noinspection JSUnresolvedFunction
        let task =  gulp.src(path)
            .pipe(sourceMaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(autoPrefixer())
            .pipe(cleanCSS({}));

        return task.pipe(sourceMaps.write('./'))
            .pipe(gulp.dest('./'));
    }

    // noinspection JSUnresolvedFunction
    let task =  gulp.src(path)
        .pipe(sourceMaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoPrefixer());

    return task.pipe(sourceMaps.write('./'))
        .pipe(gulp.dest('./'));
}

module.exports.getSassTask = getSassTask;

/**
 * Lint all SCSS files and report errors in console
 */

function scssLint() {
    return gulp.src('assets/scss/**/*.scss')
        .pipe(stylelint({
            failAfterError: false,
            reporters: [
                {
                    formatter: 'string',
                    console: true
                }
            ]
        }))
}
gulp.task('scss-lint', scssLint);

const scss = gulp.series(scssLint, function scssTask() {
    return getSassTask('assets/scss/style.scss');
});

/**
 * Compile Sass into style.css
 */
gulp.task('scss', scss);

/**
 * Compile Sass into style.css for production
 */
gulp.task('scss-production', gulp.series(function scssTask() {
    return getSassTask('assets/scss/style.scss', true);
}));

function watchScss() {
    return gulp.watch('assets/scss/**/*.scss', {}, scss);
}
gulp.task('watch-scss', gulp.series('scss', watchScss));
