/*
* Dependencias
*/
var gulp = require('gulp'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
  jquery = require('jquery'),
convertEncoding = require('gulp-convert-encoding');

// carpetas de destino y fuente
var source = 'resources/assets/',
    dest = 'public/';

// Defino bootstrap
var bootstrapSass = {
    in: 'node_modules/bootstrap-sass/'
};

// Defino fontawesome
var fonts = {
    in: [source + 'fonts/*.*', bootstrapSass.in + 'assets/fonts/**/*'],
    out: dest + 'fonts/'
};

// css source file: .scss files
var scss = {
    in: source + 'sass/app.scss',
    out: dest + 'css/',
    watch: source + 'sass/**/*',
    sassOpts: {
        outputStyle: 'compressed',
        precison: 3,
        errLogToConsole: true,
        includePaths: [bootstrapSass.in + 'assets/stylesheets']
    }
};

var javascript = {
  in: source + 'js/*.js',
  out: dest + 'js/',
  watch: source + 'js/**/*',
  concat: 'main.js',
  encode: 'utf8'
}

// copy bootstrap required fonts to dest
gulp.task('fonts', function () {
    return gulp
        .src(fonts.in)
        .pipe(gulp.dest(fonts.out));
});

// compile scss
gulp.task('sass', ['fonts'], function () {
    return gulp.src(scss.in)
        .pipe(sass(scss.sassOpts))
        .pipe(gulp.dest(scss.out));
});

// compile js
gulp.task('js', function () {
    gulp.src(javascript.in)
    .pipe(concat(javascript.concat))
    .pipe(convertEncoding({to: javascript.encode}))
    .pipe(uglify())
    .pipe(gulp.dest(javascript.out));
});

// default task
gulp.task('default', ['sass','js'], function () {
     gulp.watch(scss.watch, ['sass']);
     gulp.watch(javascript.watch, ['js']);
});
