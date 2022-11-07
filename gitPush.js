import prompt from "prompt-sync";
import chalk from "chalk";
import { exec } from 'child_process';

const defaultRemote = "origin";
const defaultBranch = "development";
const promptSigint = prompt({ sigint: true });
let remote = promptSigint(`Enter remote name [${chalk.green(defaultRemote)}] : `);
if (remote == '') remote = defaultRemote;

let branch = promptSigint(`Enter branch name [${chalk.green(defaultBranch)}] : `);
if (branch == '') branch = defaultBranch;

let message = getMessage();

function getMessage() {
    const message = promptSigint(`Enter commit message : `);
    if (message == '') {
        console.log(chalk.bold.red('Message must be fill!'));
        return getMessage();
    }
    return message;
}


/**
 * Execute simple shell command (async wrapper).
 * @param {String} cmd
 * @return {Object} { stdout: String, stderr: String }
 */
async function sh(cmd) {
    return new Promise(function (resolve, reject) {
        exec(cmd, (err, stdout, stderr) => {
            if (err) {
                reject(err);
            } else {
                resolve({ stdout, stderr });
            }
        });
    });
}

let { stdout: stdout1 } = await sh('git add .');
for (let line of stdout1.split('\n')) {
    console.log(`${line}`);
}
let { stdout: stdout2 } = await sh(`git commit -m "${message}"`);
for (let line of stdout2.split('\n')) {
    console.log(`${line}`);
}
let { stdout: stdout3 } = await sh(`git push `);
for (let line of stdout3.split('\n')) {
    console.log(`${line}`);
}
