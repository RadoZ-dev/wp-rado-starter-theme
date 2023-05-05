module.exports = function (grunt) {
  const sass = require("sass");
  // require('load-grunt-tasks')(grunt);

  /* * Load Grunt Plugins * */
  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks("grunt-stylelint");
  grunt.loadNpmTasks("grunt-dart-sass");
  grunt.loadNpmTasks("grunt-autoprefixer");
  grunt.loadNpmTasks("grunt-eslint");
  grunt.loadNpmTasks("grunt-browserify");
  // grunt.loadNpmTasks("grunt-terser");
  grunt.loadNpmTasks('grunt-contrib-uglify');


  grunt.initConfig({
    pkg: grunt.file.readJSON("package.json"),

    eslint: {
      options: {
        overrideConfigFile: "eslintrc.json",
      },
      target: ["assets/public/src/js/**/*.js"],
    },
    'dart-sass': {
      dev: {
        options: {
          implementation: sass,
        },
        files: [
          {
            "assets/public/dist/css/theme.min.css": [
              "assets/public/src/scss/theme.scss",
            ],
          },
        ],
      },
      prod: {
        options: {
          implementation: sass,
          outputStyle: "compressed",
          sourceMap: true,
        },
        files: [
          {
            "assets/public/dist/css/theme.min.css": [
              "assets/public/src/scss/theme.scss",
            ],
          },
        ],
      },
      admin: {
        options: {
          implementation: sass,
          outputStyle: "compressed",
          sourceMap: true,
        },
        files: [
          {
            "assets/admin/dist/css/theme-admin.min.css": [
              "assets/admin/src/scss/theme-admin.scss",
            ],
          },
        ],
      },
    },
    autoprefixer: {
      options: {
        browsers: ["last 2 versions"],
      },
      dist: {
        options: {
          map: false,
        },
        files: {
          "assets/public/dist/css/theme.min.css":
            "assets/public/dist/css/theme.min.css",
        },
      },
    },
    browserify: {
      dev: {
        src: [
          "assets/public/src/js/default.js",
          "assets/public/src/js/ajax.js",
        ],
        dest: "assets/public/dist/js/theme.min.js",
        options: {
          transform: [
            [
              "babelify",
              {
                presets: [
                  [
                    "@babel/preset-env",
                    {
                      targets: "> 0.25%, not dead",
                      useBuiltIns: "usage",
                      corejs: 3,
                    },
                  ],
                ],
              },
            ],
          ],
          browserifyOptions: {
            debug: true,
          },
        },
      },
      prod: {
        src: [
          "assets/public/src/js/default.js",
          "assets/public/src/js/ajax.js",
        ],
        dest: "assets/public/dist/js/theme.min.js",
        options: {
          transform: [
            [
              "babelify",
              {
                presets: [
                  [
                    "@babel/preset-env",
                    {
                      targets: "> 0.25%, not dead",
                      useBuiltIns: "usage",
                      corejs: 3,
                    },
                  ],
                ],
              },
            ],
          ],
          browserifyOptions: {
            debug: false,
          },
        },
      },
    },
    uglify: {
      options: {
        mangle: {
          reserved: ['jQuery']
        }
      },
      my_target: {
        files: {
          'assets/public/dist/js/theme.min.js': ['assets/public/dist/js/theme.min.js']
        }
      }
    },
    watch: {
      dart_sass: {
        files: ["assets/public/src/scss/**/*.scss"],
        tasks: ["dart-sass:dev", "autoprefixer"],
      },
      dart_sass_admin: {
        files: ["assets/admin/src/scss/**/*.scss"],
        tasks: ["dart-sass:admin", "autoprefixer"],
      },
      js: {
        files: ["assets/public/src/js/**/*.js"],
        tasks: ["eslint", "browserify:dev"],
      },
    },
  });

  /* * Register Tasks * */
  grunt.registerTask("dev", [
    "dart-sass:dev",
    "dart-sass:admin",
    "autoprefixer",
    "eslint",
    "browserify:dev",
  ]);

  grunt.registerTask("default", [
    "dart-sass:prod",
    "dart-sass:admin",
    "autoprefixer",
    "eslint",
    "browserify:prod",
    "uglify",
  ]);
};
