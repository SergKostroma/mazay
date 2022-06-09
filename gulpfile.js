var gulp = require('gulp');
var watch = require('gulp-watch');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('gulp-cssnano');
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var order = require('gulp-order');
var cheerio = require('gulp-cheerio');
var replace = require('gulp-replace');
var svgSprite = require('gulp-svg-sprite');


var path = {
    build: {
        css: 'dist/css/',
        svg: 'dist/img/svg/',
        js: 'dist/js/',
    },
    src: {
        style: 'app/css/**/*.scss',
        style_vendor: 'app/plugins/**/*.css',
        svg: ['app/img/svg/icons/**/*.svg'],
        js: ['app/js/**/*.js'],
        vendor: ['app/plugins/**/*.js'],
    },
    watch: {
        style: 'app/css/**/*.scss',
        svg: ['app/img/svg/icons/**/*.svg'],
        js: ['app/js/**/*.js']
    },
    clean: './build'
};

gulp.task('style', function (done) {
    gulp.src(path.src.style)
    //.pipe(sourcemaps.init())
        .pipe(sass()).on("error", function (e) {
        console.log(e.formatted);
    })
        .pipe(postcss([autoprefixer({browsers: ['>0%']})]))
        .pipe(cssnano({autoprefixer: false, convertValues: false, zindex: false}))
        //.pipe(sourcemaps.write())
        .pipe(gulp.dest(path.build.css));
    done();
})

gulp.task('style:vendor', function (done) {
    gulp.src(path.src.style_vendor)
        .pipe(concat('vendor.min.css'))
        .pipe(gulp.dest(path.build.css));
    done();
});

gulp.task('js:build', function (done) {
    gulp.src(path.src.js)
        .pipe(order([
            'app/js/common/**/*.js',
            'app/js/pages/**/*.js',
            'app/js/app.js',
        ], {base: './'}))
        .pipe(uglify()).on("error", function (e) {
            console.log(e);
    })
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest(path.build.js));
    done();
});

gulp.task('js:vendor', function (done) {
    gulp.src(path.src.vendor)
        .pipe(order([
            'app/plugins/jquery-3.6.0.min.js',
            'app/plugins/moment.min.js',
            'app/plugins/daterangepicker.min.js',
            'app/plugins/scrollmagic/ScrollMagic.js',
            'app/plugins/**/*.js',
        ], {base: './'}))
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(path.build.js))
        .pipe(rename('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(path.build.js));
    done();
});

gulp.task('svg', function (done) {
    gulp
        .src(path.src.svg)
        // .pipe(svgmin(function (file) {
        //     return {
        //         plugins: [{
        //             cleanupIDs: {
        //                 prefix: '-',
        //                 minify: false
        //             }
        //         }]
        //     }
        // }))
        .pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
            },
            parserOptions: {xmlMode: true}
        }))
        .pipe(replace('&gt;', '>'))
        .pipe(rename({prefix: 'icon-'}))
        .pipe(svgSprite({
                mode: {
                    symbol: {
                        sprite: "../sprite.svg"  //sprite file name
                    }
                },
            }
        ))
        // .pipe(svgstore())
        .pipe(gulp.dest(path.build.svg));
    done();
});

gulp.task('build', gulp.series([
    'style',
    'style:vendor',
    'svg',
    'js:vendor',
    'js:build',
]));

gulp.task('watch', function () {
    gulp.watch(path.watch.style, gulp.series('style'));
    gulp.watch(path.watch.js, gulp.series('js:build'));
    gulp.watch(path.watch.svg, gulp.series('svg'));
});
