const fs = require('fs-extra');
const unzipper = require('unzipper');

const outputFolder = __dirname + '/_unzip/';

//https://stackoverflow.com/a/52890363
fs.access(outputFolder, function(err) { if (err && err.code === 'ENOENT') { fs.mkdir(outputFolder); } });

function unzipSingle(name) {
	//https://www.npmjs.com/package/unzipper
	fs.createReadStream(name + '.gmind')
		.pipe(unzipper.Extract({ path: outputFolder }));

	//https://github.com/jprichardson/node-fs-extra/blob/master/docs/copy.md
	fs.copy(outputFolder + 'content.json', __dirname + '/' + name + '.json', { overwrite: true });
}

function main() {
	unzipSingle('main');
}

main();
