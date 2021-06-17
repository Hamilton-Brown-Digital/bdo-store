module.exports = function(grunt) {

  require("jit-grunt")(grunt);

  grunt.initConfig({

    // doesn't work when I create targets, no idea why
    "dart-sass": {
      options: {
        sourceMap: true,
        outputStyle: 'compressed'
      },
      files: {
        src: "assets/css/main.scss",
        dest: "build/css/main.css"
      }
    },
    postcss: {
      prod: {
        options: {
          processors: [
            require("autoprefixer"),
            require("cssnano")(), // minify the result
          ]
        },
        src: "assets/css/main.scss",
        dest: "build/css/main.css"
      }
    },
    svgstore: {
      options: {
        includedemo: true,
        cleanup:true
      },
      files: {
        src: 'assets/svg/*.svg',
        dest: 'build/svg/icons.svg',
      },
    },
    browserify: {
        default: {
          src: 'assets/scripts/main.js',
          dest: 'build/scripts/main.js',
          options: {
              browserifyOptions: { debug: true },
              transform: [["babelify", { "presets": ["@babel/preset-env"] }]],
          }
      }
    },
    browserSync: {
        dev: {
            bsFiles: {
                src : [
                    "**/*.php",
                    "build/css/*.css",
                    "build/scripts/main.js"
                ]
            },
            options: {
                watchTask: true,
                proxy: "http://bdostore.local/"
            }
        }
    },
    watch: {
      css: {
        files: ["assets/css/**/*.scss"],
        tasks: ["dart-sass"]
      },
      scripts: {
        files: ["assets/scripts/**/*.js"],
        tasks: ["browserify"]
      }
    }
  });
  grunt.registerTask("svg", [
    "svgstore", "browserSync", "watch"
  ]);
  grunt.registerTask("dev", [
    "browserSync", "watch"
  ]);
  grunt.registerTask("build", [
    "dart-sass", "browserify"
  ]);
};