var gulp        = require('gulp'),
    path        = require('path'),
    shell       = require('gulp-shell'),
    config      = require('../../gulpconfig');

// Create symlink of build dir in wordpress theme directory
gulp.task('link-theme', shell.task([
  'ln -s ' + path.join(process.cwd(), config.utils.build) + ' ' + path.join(process.cwd(), config.wordpress, 'wp-content/themes', config.utils.project)
], {ignoreErrors: true}));
