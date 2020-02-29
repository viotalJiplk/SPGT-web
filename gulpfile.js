const gulp = require('gulp');
const sass = require('gulp-sass');
const browserSync = require('browser-sync').create();

// compile scss
function compile(){

    // get scss files
    return gulp.src('./scss/**/*.scss')
    // compile them
    .pipe(sass())
    // put css into its folder
    .pipe(gulp.dest('./css'));

}

exports.scsscomp = compile;