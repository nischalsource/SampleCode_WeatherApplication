/*global
 module: false
 */
module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        imagemin: {
            /* https://www.npmjs.org/package/grunt-contrib-imagemin */
            minify: {
                options: {
                    optimizationLevel: 5,
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: '<%= pkg.config.dist %>/images',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: '<%= pkg.config.dist %>/images'
                }]
            }
        },

        compass: {
            /* https://npmjs.org/package/grunt-contrib-compass */

            options: {
                require: 'sass-globbing',

                httpPath: '/',

                sassDir: '<%= pkg.config.src %>/styles',
                cssDir: '<%= pkg.config.dist %>/css',

                fontsDir: '<%= pkg.config.dist %>/fonts',

                imagesDir: '<%= pkg.config.dist %>/images',
                spriteLoadPath: '<%= pkg.config.src %>/images',
                generatedImagesDir: '/images/sprites',
                generatedImagesPath: '<%= pkg.config.dist %>/images/sprites',

                httpStylesheetsPath: '/styles',
                httpImagesPath: '<%= pkg.config.asset_url %>/images',
                httpGeneratedImagesPath: '<%= pkg.config.asset_url %>/images/sprites',

                raw: '\nhttp_images_path = "/images/"\ngenerated_images_dir = ".tmp/images"\nhttp_generated_images_path = "/images/"\n'

            },

            clean: {
                options: {
                    clean: true
                }
            },

            dev: {
                options: {
                    outputStyle: 'expanded'
                }
            },

            dist: {
                options: {
                    // force: true,
                    outputStyle: 'compressed',
                    // assetCacheBuster : false
                    raw: 'asset_cache_buster :none\n'
                }
            }
        },

        clean: {
            /* https://npmjs.org/package/grunt-contrib-clean */
            options: {
                force: true
            },
            scripts: ['<%= pkg.config.dist %>/js/**/*'],
            styles: ['<%= pkg.config.dist %>/css/**/*']
        },

        uglify: {
            options: {
                banner: '/*! <%= pkg.author.name %> | <%= pkg.author.url %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
                beautify: false
            },
            dev: {
                options: {
                    beautify: true
                },
                files: {
                    '<%= pkg.config.dist %>/js/scripts.js': [
                        '<%= pkg.config.src %>/scripts/vendor/*.js',
                        '<%= pkg.config.src %>/scripts/app/*.js',
                        '<%= pkg.config.src %>/scripts/scripts.js'
                    ]
                }
            },
            dist: {
                files: {
                    '<%= pkg.config.dist %>/js/scripts.js': [
                        '<%= pkg.config.src %>/scripts/vendor/*.js',
                        '<%= pkg.config.src %>/scripts/app/*.js',
                        '<%= pkg.config.src %>/scripts/scripts.js'
                    ]
                }
            }
        },

        assets_hash: {
            assets: {
                options: {
                    algorithm: 'md5',
                    jsonFile: '<%= pkg.config.hash_map %>',
                    //clear: true,
                    suffix: true,
                    removeFromPath: '<%= pkg.config.web_dir %>'
                },
                src: [
                    '<%= pkg.config.dist %>/js/**/*.js',
                    '<%= pkg.config.dist %>/css/**/*.css'
                ]
            }
        },

        watch: {
            /* https://npmjs.org/package/grunt-contrib-watch */

            styles: {
                files: [
                    '<%= pkg.config.src %>/styles/**/*.scss',
                    'Gruntfile.js'
                ],
                tasks: [
                    'compass:dev'
                ],
                options: {
                    nospawn: true,
                    interrupt: false,
                    interval: 100
                }
            },

            scripts: {
                files: [
                    '<%= pkg.config.src %>/scripts/**/*.js',
                    'Gruntfile.js'
                ],
                tasks: [
                    'clean:scripts',
                    'uglify:dev'
                ],
                options: {
                    interrupt: true,
                    beautify: true
                }
            }
        }
    });

    // general
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-rename');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-assets-hash');

    // css
    grunt.loadNpmTasks('grunt-contrib-compass');

    // fonts & images
    grunt.loadNpmTasks('grunt-contrib-imagemin');

    // grunt for distribution
    grunt.registerTask('dist', [
        'clean',

        'uglify:dist',

        'compass:clean',
        'compass:dist',

        'assets_hash:assets'
    ]);

    // grunt for development
    grunt.registerTask('dev', [
        'clean',

        'uglify:dev',

        'compass:clean',
        'compass:dev',

        'watch'
    ]);

    // grunt for development
    grunt.registerTask('img', [
        'imagemin:minify'
    ]);

    // grunt [default]
    grunt.registerTask('default', [
        'dev'
    ]);

    // grunt [development]
    grunt.registerTask('deploy', [
        'dist'
    ]);
};