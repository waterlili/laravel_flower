var gulp = require('gulp');
var concat = require('gulp-concat');
var watch = require('gulp-watch');
gulp.task('scripts', function() {
    return gulp.src(['./new/**/*.js'])
        .pipe(concat({ path: 'new.js'}))
        .pipe(gulp.dest('./dist'));
});

gulp.task('stream', function () {
    // Endless stream mode 
    return watch('new/**/*.js' , function () {
        console.log('Changed');
        gulp.src(['new/**/*.js'])
        .pipe(concat({ path: 'new.js'}))
            .pipe(gulp.dest('./dist'));
    })

});