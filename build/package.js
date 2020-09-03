const gulp = require('gulp');
const fs = require('fs');
const runSequence = require('run-sequence');
const clean = require('gulp-clean');
const gulpCopy = require('gulp-copy');
const tar = require('tar');

gulp.task("copy-dist", function() {
    return gulp.src([
        '**/*',
        '!./node_modules/**/*',
        '!./assets/node_modules/**/*',
        '!./.deploy',
        '!./dist.tgz'
    ])
        .pipe(gulpCopy("dist"))
});

gulp.task("compress-dist", () => compress_dist());

function compress_dist() {
    process.chdir('dist');
    return tar.create(
        {gzip: true, file: '../dist.tgz'},
        ['.']
    ).then(function () {
        process.chdir('../');
    })
}

gulp.task("copy-env", gulp.series( function() {
    fs.writeFileSync('./dist/.env', fs.readFileSync('.env.production'));
}));


gulp.task('clean-dist', gulp.series(function () {
    return gulp
        .src('dist', {read: false})
        .pipe(clean())
}));

/**
 * Build sass and typescript for production.
 */
gulp.task('package-production', gulp.series('ts-production', 'scss-production', 'clean-dist', () => {
    return runSequence(
        "copy-dist",
        "copy-front-end-dependencies",
        "copy-env",
        'compress-dist',
        'clean-dist'
    )
}));

