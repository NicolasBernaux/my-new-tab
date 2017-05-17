var gulp         = require( 'gulp' ),
    gulp_stylus  = require( 'gulp-stylus' ),
    gulp_plumber = require( 'gulp-plumber' ),
    uglify = require('gulp-uglify'),
    gulp_notify  = require('gulp-notify'),
    autoprefixer = require('gulp-autoprefixer'),
    gulp         = require('gulp'),
    browserSync  = require('browser-sync').create(),
    gulp = require('gulp'),
    imagemin = require('gulp-imagemin');



/*CSS stylus*/
gulp.task( 'css', function()
          {
    return gulp.src( './app/stylus/main.styl')
        .pipe(gulp_plumber({errorHandler: gulp_notify.onError("Error: <%= error.message %>")})) //error
        .pipe( gulp_stylus( { compress: true } ) ) // compress
        .pipe( gulp.dest( './app/prefixer/' ) ) // destination
});


/* CSS prefixer*/
gulp.task('prefixer', function()
          {
    gulp.src('./app/prefixer/main.css')
        .pipe(autoprefixer({
        browsers: ['last 5 versions'],
        cascade: false
    }))
        .pipe(gulp.dest('./assets/css/'))
});


/* JS Uglify*/

gulp.task('js', function() {
    return gulp.src('./app/js/script.js')
        .pipe(gulp_plumber({errorHandler: gulp_notify.onError("JS Error: <%= error.message %>")}))
        .pipe( uglify() )   // Minify them
        .pipe( gulp.dest( './assets/js/' ) )      // Put it in folder

});



/*Browser sync launch*/
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "localhost:80", // !!!!! Replace localhost if you need
        notify : false
    });
});


/* Update of browser-sync*/
gulp.task( 'browser-update', function()
          {
    browserSync.reload();
} );



gulp.task('imagemin', function(){
    gulp.src('app/img/**')
        .pipe(imagemin())
        .pipe(gulp.dest('assets/img'))
});




/* Watch task */

gulp.task( 'watch', function()
          {
    gulp.watch( './app/stylus/**', [ 'css' ] ); // stylus on .styl modification
    gulp.watch( './app/prefixer/**', ['prefixer'] ); // prefixer after the stylus
    gulp.watch( './app/js/**', ['js'] ); // uglify on js modification
    gulp.watch( './app/img/**', ['imagemin'] ); // uglify on js modification
    gulp.watch( './assets/css/**', ['browser-update'] ); // Update of browser-sync after php modification
    gulp.watch( './assets/js/**', ['browser-update'] ); // Update of browser-sync after php modification
    gulp.watch( './views/**', ['browser-update'] ); // Update of browser-sync after php modification
} );

gulp.task( 'default', [ 'css', 'prefixer', 'js', 'watch', 'imagemin' ] );
gulp.task( 'share', [ 'css', 'prefixer', 'js', 'browser-sync', 'watch', 'imagemin' ] );
