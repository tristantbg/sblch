module.exports = function(grunt) {
    grunt.initConfig({
        concat: {
            plugins: {
                src: [
                'site/plugins/embed/assets/js/embed.js',
                ],
                dest: 'assets/js/plugins.concat.js'
            },
            app: {
                src: ['src/js/components/*.js', 'src/js/app.js'],
                dest: 'assets/js/app.concat.js'
            },
        },
        uglify: {
            plugins: {
                src: 'assets/js/plugins.concat.js',
                dest: 'assets/js/build/plugins.js'
            },
            app: {
                src: 'assets/js/app.concat.js',
                dest: 'assets/js/build/app.min.js',
                options: {
                    sourceMap: true
                }
            }
        },
        svgstore: {
          options: {
            prefix : '', // This will prefix each <g> ID
          },
          default : {
              files: {
                'assets/images/svg-sprite.svg': ['src/svg/*.svg'],
              }
            }
        },
        stylus: {
            compile: {
                options: {
                    'include css': true,
                    use: [
                        require('rupture')
                    ],
                },
                files: {
                    'assets/css/app.min.css': 'src/css/app.styl'
                }
            }
        },
        cssmin: {
          options: {
            shorthandCompacting: true,
            roundingPrecision: -1
          },
          target: {
            files: {
              'assets/css/build/build.min.css':
              ['node_modules/normalize-css/normalize.css',
              'site/plugins/embed/assets/css/embed.css',
              'assets/css/app.min.css']
            }
          }
        },
        watch: {
            // js: {
            //     files: ['src/js/components/*.js', 'src/js/app.js'],
            //     tasks: ['concat:app', 'uglify:app'],
            //     options: {
            //         livereload: true,
            //     }
            // },
            css: {
                files: ['src/css/**/*.styl'],
                tasks: ['stylesheets'],
                options: {
                    livereload: true,
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-svgstore');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-php');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('javascript', ['concat', 'uglify']);
    grunt.registerTask('stylesheets', ['stylus', 'cssmin']);
    grunt.registerTask('test', ['php', 'mocha']);
    grunt.registerTask('default', ['svgstore', 'stylesheets', 'watch']);
};
