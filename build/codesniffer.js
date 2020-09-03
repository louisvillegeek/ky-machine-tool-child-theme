const gulp = require('gulp');
const shell = require('gulp-shell');
const execSync = require('child_process').execSync;
/**
 * Get the command to run the php code sniffer
 * @return {string}
 */
function getPhpCsCommand() {
    let isWin = /^win/.test(process.platform);
    let phpcsCommand = '';
    if(isWin)
        phpcsCommand = 'vendor\\bin\\phpcs -s --standard=ruleset_standard.xml --extensions=php src\\';
    else
        phpcsCommand = './vendor/bin/phpcs -s --standard=ruleset_standard.xml --extensions=php src/';
    return phpcsCommand
}

module.exports = getPhpCsCommand;


/**
 * lint php code. This is platform independent
 */
gulp.task('php-lint', shell.task(getPhpCsCommand(), { ignoreErrors : true }));

// invoked via cli
if (require.main === module) {
    try { execSync(getPhpCsCommand(),{stdio:[0,1,2]}) }
    catch(exception) { process.exit(1) }
}