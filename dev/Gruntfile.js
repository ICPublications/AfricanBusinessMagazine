module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    sass: {
      dist: {
        options: {
          style: 'compressed',
          sourcemap: true,
          compass: true
        },
        files: {
          '../<%= pkg.stylesheetName %>.css': 'sass/<%= pkg.stylesheetName %>.scss',
          '../<%= pkg.stylesheetName %>-no-mq.css': 'sass/<%= pkg.stylesheetName %>-no-mq.scss'
        }
      }
    },
    
		jshint: {
			options: {
				node: true,
				esnext: true,
				curly: false,
				smarttabs: true,
				quotmark: 'single',
				globals: {
					jQuery: true
				}
			},
			dist: {
				src: ['Gruntfile.js', 'js/app/*.js', 'js/page/*.js'],
				ignores: ['js/plugins/*.js', 'js/lib/*.js']
			}
		},
		
    requirejs: { 
      common: { 
        options: { 
          findNestedDependencies: true, 
          mainConfigFile: 'js/main.js', 
          baseUrl: 'js', 
          name: 'main', 
          out: '../lib/js/main.min.js',
          optimize: 'uglify2',
          preserveLicenseComments: false,
          generateSourceMaps: true
        } 
      }
    },
    
		copy: {
			main: {
				files: [
					{expand: true, src: ['fonts/**'], dest: '../lib/'}
				]
			}
		},
    
    watch: {
			styles: {
				files: ['sass/**/*.scss'],
				tasks: ['sass']
			},
			scripts: {
				files: ['js/**/*.js'],
				tasks: ['jshint', 'requirejs']
			}
		},
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-requirejs');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('default', ['sass', 'jshint', 'requirejs']);

};