const gulp = require('gulp');

const sass = require('gulp-sass');
sass.compiler = require('sass');

const browserSync = require('browser-sync').create();

// compile scss
function compile(){

    // get scss files
    return gulp.src('./scss/**/*.scss')
    // compile them
    .pipe(sass().on('error', sass.logError))
    // put css into its folder
    .pipe(gulp.dest('./css'))

    .pipe(browserSync.stream());
}

function watch(){
    browserSync.init({
        proxy: "spgt",
        port: 3000,
    });

    gulp.watch('./scss/**/*.scss', compile);
    gulp.watch('./**/*.html').on('change', browserSync.reload);
    gulp.watch('./*.php').on('change', browserSync.reload);
}

exports.scsscomp = compile;
exports.watch = watch;