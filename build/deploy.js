'use strict';

const node_ssh = require('node-ssh');
const prompt = require('prompt');
const fs = require('fs');
const ini = require('ini');



function getParameters() {
   return new Promise((resolve, reject) => {
       if(fs.existsSync(".deploy"))
       {
           console.log("reading from deploy file");
           let iniFile = fs.readFileSync(".deploy", {encoding: "UTF-8"});
           let result = ini.decode(iniFile);
           resolve(result);
       }
       else {
           prompt.start();
           prompt.get(['hostname', 'username', 'password', 'remotePath'],  (err, result) => {
               fs.writeFileSync(".deploy", ini.encode(result));
               resolve(result);
           });
       }
   })


}

function deploy() {
    getParameters().then(result => transferPackage(result.hostname, result.username, result.password, result.remotePath));
}


function transferPackage(hostname, username, password, remotePath) {
    console.log("Connecting to server.");
    const ssh = new node_ssh();
    return ssh.connect({
        host: hostname,
        username: username,
        password: password
    })
        .then(() => console.log("Starting upload."))
        .then(() => ssh.putFile('dist.tgz', remotePath + "/dist.tgz"))
        .then(() =>  console.log("Uploaded payload"))
        .then(() => ssh.execCommand('tar -zxf dist.tgz --no-same-owner', { cwd: remotePath}))
        .then(() =>  console.log("Extracting payload"))
        .then(() => ssh.execCommand('rm -f dist.tgz', { cwd: remotePath}))
        .then(() => console.log("Finished Deploying"))
        .then(() => ssh.dispose())
        .catch((error) => {
            console.error("Something went wrong deploying.");
            console.error(error);
            ssh.dispose();
            process.exit(1);
        })
}


// invoked via cli
if (require.main === module) {
    deploy();
}
