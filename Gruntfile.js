/*jslint node: true*/

module.exports = function (grunt) {

  'use strict';

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  // Project configuration.
  grunt.initConfig({
    // Meta data
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      main: {
        options: {
          sourcemap: 'none',
          style: 'compressed'
        },
        files: {
          'includes/assets/css/style.css': 'includes/assets/sass/style.scss'
        }
      }
    },

    autoprefixer: {
      options: {
        browsers: [
          "Android 2.3",
          "Android >= 4",
          "Chrome >= 20",
          "Firefox >= 24",
          "Explorer >= 8",
          "iOS >= 6",
          "Opera >= 12",
          "Safari >= 6"
        ]
      },
      style: {
        src: ['includes/assets/css/style.css']
      }
    },

    watch: {
      style: {
        files: 'includes/assets/sass/*.scss',
        tasks: ['style']
      }
    }

  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');

  grunt.registerTask('style', ['sass', 'autoprefixer']);
  grunt.registerTask('install', ['watch']);

  grunt.registerTask('default', ['watch']);

};
