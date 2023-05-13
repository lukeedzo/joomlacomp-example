const run = require('gulp');
const requireDir = require('require-dir');
const runSequence = require('gulp4-run-sequence');

requireDir('./tasks', { recurse: true });

// Build css and js
run.task('dev', (cb) => {
  runSequence(
    run.series(
      'build-admin-css',
      'build-front-css',
      'build-admin-scripts',
      'build-front-scripts'
    ),
    'watch'
  );
  cb();
});

// Build installer package
run.task('build-package', (cb) => {
  runSequence(
    'clean',
    'administrator',
    'site',
		'api',
		'finder-plugin',
		'webservices-plugin',
		'module',
    'media',
    'administrator-language-gb',
    'site-language-gb',
		'module-language-gb',
		'plugin-webservices-language-gb',
		'plugin-finder-language-gb',
    'installer-script',
    'indexhtml-file',
    'updates-file',
    'zip'
  );
  cb();
});
