const fs = require('fs');
const gulp = require('gulp');


const styleSrc = fs.readFileSync("assets/scss/style.scss", 'UTF8');

function readVersionInformation() {
    let versionLinePos = styleSrc.indexOf("Version:");
    let endOfThatLine = styleSrc.substr(versionLinePos).indexOf("\n") + versionLinePos + 1;
    let line = styleSrc.substring(versionLinePos, endOfThatLine);
    let dos = line.indexOf("\r") !== -1;
    line = line.trim();
    let version =  line.split(':')[1];
    let versionPieces = version.split('.');
    let versionParts = {
        major: versionPieces[0],
        minor: versionPieces[1],
        patch: versionPieces[2]
    };
    return {
        versionLinePos: versionLinePos,
        endOfThatLine: endOfThatLine,
        version: version,
        versionParts: versionParts,
        dos: dos
    }
}

/**
 *
 * @param versionInfo
 */
function setVersion(versionInfo) {
    fs.writeFileSync("assets/scss/style.scss",
        styleSrc.substr(0, versionInfo.versionLinePos) +
        'Version: ' + versionInfo.version + (versionInfo.dos ? "\r\n" : "\n") +
        styleSrc.substr(versionInfo.endOfThatLine),
        'UTF8');
}


function bumpVersion(type = "patch")
{
    const versionInfo = readVersionInformation();
    const version = versionInfo.versionParts;
    if(type === "patch")
        version.patch = String(parseInt(version.patch) + 1);
    else if(type === "minor") {
        version.patch = "0";
        version.minor = String(parseInt(version.minor) + 1);
    }
    else if(type === "major") {
        version.patch = "0";
        version.minor = "0";
        version.major = String(parseInt(version.major) + 1);
    }

    versionInfo.versionParts = version;
    versionInfo.version = version.major + "." + version.minor + "." + version.patch;
    setVersion(versionInfo);
    console.log(versionInfo.version);
}

module.exports.readVersionInformation = readVersionInformation;
module.exports.setVersion = setVersion;
module.exports.bumpVersion = bumpVersion;


gulp.task("bump-major", function() { bumpVersion("major") });
gulp.task("bump-minor", function() { bumpVersion("minor") });
gulp.task("bump-patch", function() { bumpVersion("patch") });