/*jslint node: true*/

module.exports = function (grunt) {

  'use strict';

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  // Project configuration.
  grunt.initConfig({
    // Meta data
    pkg: grunt.file.readJSON('package.json'),

    copy: {
      bower: {
        files: [
          {
            expand: true,
            cwd: 'bower_components/bootstrap-sass/assets/stylesheets/',
            src: ['**/*.scss'],
            dest: 'includes/assets/sass/twbs/'
          }
        ]
      }
    },

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
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-autoprefixer');

  grunt.registerTask('composer', ['shell:composer']);
  grunt.registerTask('wpcli', ['shell:wpCli']);
  grunt.registerTask('wpCoreDownload', ['shell:wpCoreDownload']);
  grunt.registerTask('wpCoreConfig', ['shell:wpCoreConfig']);
  grunt.registerTask('wpCoreInstall', ['shell:wpCoreInstall']);
  grunt.registerTask('bowerInstall', ['shell:bowerInstall', 'copy:bower']);
  grunt.registerTask('style', ['sass', 'autoprefixer']);
  grunt.registerTask('install', ['wpcli', 'wpCoreDownload', 'shell:tcpdf']);

  grunt.registerTask('default', ['watch']);

};
