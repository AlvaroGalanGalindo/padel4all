module.exports = function(grunt) {
    //require('jit-grunt')(grunt);

    grunt.initConfig({
	pkg: grunt.file.readJSON('package.json'),
        resourcesPath: 'src/AppBundle/Resources',

	clean: {
            js: ['web/js/*'],
            css: ['web/css/*'],
        },

	copy: {
            js: {
                expand: true,
                cwd: '<%= resourcesPath %>/public/js/',
                src: '**',
                dest: 'web/js'
            }
        },

        less: {
            app: {
                options: {
                    paths: ['<%= resourcesPath %>/public/less'],
                    compress: true
                },
                files: {
                    'web/css/style.min.css': '<%= resourcesPath %>/public/less/custom.less'
                }
            }
        },

	shell: {
            cache_clear_prod: {
                options: {
                    stdout: true
                },
                command: 'php bin/console cache:clear --env=prod --no-debug'
            },
            composer_dump_autoload: {
                options: {
                    stdout: true
                },
                command: 'composer dump-autoload --optimize'
            }
        },

	watch: {
            less: {
                files: '<%= resourcesPath %>/public/less/**/*.less',
                tasks: ['clean:css', 'less:app']
            }
        },

        watch: {
            options: {
                livereload: true
            },
            styles: {
                files: ['less/**/*.less'], // which files to watch
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            }
        }
    });

    // Load the plugins.
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-shell');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', function() {
        grunt.task.run("clean");
        grunt.task.run("less");
        grunt.task.run("copy:js");
    });

    grunt.registerTask('dev', ['default', 'watch']);

    grunt.registerTask('optimizejs', function() {
        grunt.task.run("clean:js");
        grunt.task.run("copy:js");
    });

    grunt.registerTask('prod', function() {
        grunt.task.run("clean");
        grunt.task.run("less");
        grunt.task.run("shell:cache_clear_prod");
        grunt.task.run("shell:composer_dump_autoload");
        grunt.task.run("optimizejs");
    })

    grunt.registerTask('default', ['less', 'watch']);
};
