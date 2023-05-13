const run = require('gulp');
const config = require('../config');
const path = require('path');
const clean = require('gulp-clean');
const replace = require('gulp-string-replace');
const zip = require('gulp-zip');

run.task('clean', () => {
  return run.src(['./pkg/', './package/'], { read: false }).pipe(clean());
});

run.task('administrator', () => {
  return run
    .src(path.join(__dirname, config.package.administrator_src))
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.administrator_dest));
});

run.task('site', () => {
  return run
    .src([config.package.site_src, '!./node_modules/**'], { dot: true })
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.site_dest));
});

run.task('api', () => {
  return run
    .src(config.package.api_src, { dot: true })
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.api_dest));
});

run.task('finder-plugin', () => {
  return run
    .src(config.package.finder_plugin_src, { dot: true })
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.finder_plugin_dest));
});

run.task('webservices-plugin', () => {
  return run
    .src(config.package.webservices_plugin_src, { dot: true })
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.webservices_plugin_dest));
});


run.task('module', () => {
  return run
    .src(config.package.module_src, { dot: true })
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.module_dest));
});

run.task('media', () => {
  return run
    .src(path.join(__dirname, config.package.media_src))
    .pipe(run.dest(config.package.media_dest));
});

run.task('administrator-language-gb', () => {
  return run
    .src([
      path.join(__dirname, config.package.admin_language_gb_ini_src),
			path.join(__dirname, config.package.admin_language_gb_sys_src)
    ])
    .pipe(run.dest(config.package.admin_language_gb_dest));
});

run.task('module-language-gb', () => {
  return run
    .src([
      path.join(__dirname, config.package.module_language_gb_ini_src),
			path.join(__dirname, config.package.module_language_gb_sys_src)
    ])
    .pipe(run.dest(config.package.module_language_gb_dest));
});

run.task('plugin-webservices-language-gb', () => {
  return run
    .src([
      path.join(__dirname, config.package.plugin_webservices_language_gb_ini_src),
			path.join(__dirname, config.package.plugin_webservices_language_gb_sys_src),
    ])
    .pipe(run.dest(config.package.plugin_webservices_language_gb_dest));
});

run.task('plugin-finder-language-gb', () => {
  return run
    .src([
			path.join(__dirname, config.package.plugin_finder_language_gb_ini_src),
			path.join(__dirname, config.package.plugin_finder_language_gb_sys_src)
    ])
    .pipe(run.dest(config.package.plugin_finder_language_gb_dest));
});

run.task('site-language-gb', () => {
  return run
    .src(path.join(__dirname, config.package.site_language_gb_src))
    .pipe(run.dest(config.package.site_language_gb_dest));
});

run.task('installer-script', () => {
  return run
    .src([
      path.join(__dirname, config.package.script_file_src),
      path.join(__dirname, config.package.studies_file_src),
    ])
    .pipe(replace(/CVS(.{7})/g, `CVS: ${config.version}`))
    .pipe(run.dest(config.package.studies_file_dest));
});

run.task('indexhtml-file', () => {
  return run.src([ path.join(__dirname, config.package.html_file)]).pipe(run.dest('./pkg/site/build/package/'));
});

run.task('updates-file', () => {
  return run
    .src(
      path.join(
        __dirname,
        './../../../../administrator/components/com_example/updates.xml'
      )
    )
    .pipe(run.dest('./package/'));
});

run.task('zip', () => {
  return run
    .src(['./pkg/**/*.*', '!./pkg/site/build/**/*.*'], { dot: true })
    .pipe(zip(`com_example-${config.version}.zip`))
    .pipe(run.dest('./package/'));
});
