const fs = require('fs');
const gulp = require('gulp');
const gulpCopy = require('gulp-copy');

function getDependencies() {
    const assets = fs.readFileSync("assets/package.json", 'UTF8');
    const dependencies = JSON.parse(assets).dependencies;
    const dependencyNames = Object.keys(dependencies);

    const dependencyPaths = [];
    for(let name of dependencyNames) {
        dependencyPaths.push("./assets/node_modules/" + name + "/**/*")
    }
    return {
        dependencyNames,
        dependencyPaths
    }

}

module.exports.getDependencies = getDependencies;

gulp.task('copy-front-end-dependencies', function() {
    return gulp.src(getDependencies().dependencyPaths).pipe(gulpCopy("dist"))
});
