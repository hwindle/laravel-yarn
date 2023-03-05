// Load Grunt
module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Tasks
    concat : {
			dist : {
				src : ["sass/application.scss"],
				dest : "sass/styles.scss"
			}
		},
    sass: {
      // Begin Sass Plugin
      dist: {
        options: {
          // sourcemap: 'none',
        },
        files: [
          {
            expand: true,
            cwd: 'sass',
            src: ['styles.scss'],
            dest: 'public/css/',
            ext: '.css',
          },
        ],
      },
    },
    cssmin: {
      // Begin CSS Minify Plugin
      target: {
        files: [
          {
            expand: true,
            cwd: 'public/css',
            src: ['styles.css'],
            dest: 'public/css/',
            ext: '.min.css',
          },
        ],
      },
    },
    watch: {
      // Compile everything into one task with Watch Plugin
      css: {
        files: 'sass/*.scss',
        tasks: ['concat', 'sass', 'cssmin'],
      },
    },
  })
  // Load Grunt plugins
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Register Grunt tasks
  grunt.registerTask('default', ['watch']);
}
