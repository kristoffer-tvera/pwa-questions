module.exports = function (grunt) {

    // configure the tasks
    var config = {
        //  Sass
        sass: {
            expanded: {
                options: {
                    outputStyle: 'expanded',
                    sourcemap: false,
                },
                files: {
                    'css/site.css': 'sass/site.scss',
                }
            },

            min: {
                options: {
                    outputStyle: 'compressed',
                    sourcemap: false
                },
                files: {
                    'css/site.min.css': 'sass/site.scss',
                }
            },
        },

        // PostCss Autoprefixer
        postcss: {
            options: {
                processors: [
                    require('autoprefixer')({
                        browsers: [
                            'last 2 versions',
                            'Chrome >= 30',
                            'Firefox >= 30',
                            'ie >= 10',
                            'Safari >= 8']
                    })
                ]
            },
            expanded: {
                src: 'css/site.css'
            },
            min: {
                src: 'css/site.min.css'
            }
        },

        // Browser Sync integration
        browserSync: {
            bsFiles: ["js/*.js", "css/*.css", "./*.php", "!**/node_modules/**/*"],
            options: {
                proxy: '127.0.0.1:8010',
                port: 8000,
                ui: {
                    port: 8080,
                    weinre: {
                        port: 9090
                    }
                },
                open: true
            }
        },

        php: {
            dev: {
                options: {
                    port: 8010,
                    base: './'
                }
            }
        },

        //  Concat
        concat: {
            options: {
                separator: ';'
            },
            dist: {
                // the files to concatenate
                src: [
                    "js/_site.js",
                    "js/_menu.js"
                ],
                // the location of the resulting JS file
                dest: 'js/site.js'
            },
            temp: {
                // the files to concatenate
                options: {
                    sourceMap: true,
                    sourceMapStyle: 'link'


                },
                src: [
                    "js/_site.js",
                    "js/_menu.js"
                ],
                // the location of the resulting JS file
                dest: 'js/site.js'
            },
        },

        //  Uglify
        uglify: {
            options: {
                // Use these options when debugging
                // mangle: false,
                // compress: false,
                // beautify: true

            },
            dist: {
                files: {
                    'js/site.min.js': ['js/site.js']
                }
            }
        },

        //  Clean
        clean: {
            temp: {
                src: ['temp/']
            },
        },

        //  Watch Files
        watch: {
            sass: {
                files: ['sass/**/*'],
                tasks: ['sass_compile'],
                options: {
                    interrupt: false,
                    spawn: false,
                },
            },
            js: {
                files: ['js/**/*'],
                tasks: ['js_compile'],
                options: {
                    interrupt: false,
                    spawn: false,
                },
            }
        },


        //  Concurrent
        concurrent: {
            options: {
                logConcurrentOutput: true,
                limit: 10,
            },
            monitor: {
                tasks: ["sass_compile", "watch:sass",
                    "js_compile", "watch:js",
                    "notify:watching", 'php', 'server']
            },
        },

        //  Notifications
        notify: {
            watching: {
                options: {
                    enabled: true,
                    message: 'Watching Files!',
                    title: "Questions", // defaults to the name in package.json, or will use project directory's name
                    success: true, // whether successful grunt executions should be notified automatically
                    duration: 1 // the duration of notification in seconds, for `notify-send only
                }
            },

            sass_compile: {
                options: {
                    enabled: true,
                    message: 'Sass Compiled!',
                    title: "Questions",
                    success: true,
                    duration: 1
                }
            },

            server: {
                options: {
                    enabled: true,
                    message: 'Server Running!',
                    title: "Questions",
                    success: true,
                    duration: 1
                }
            }
        },
    };

    grunt.initConfig(config);

    // load the tasks
    // grunt.loadNpmTasks('grunt-gitinfo');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-php');

    // define the tasks
    grunt.registerTask(
        'release', [
            'sass:expanded',
            'sass:min',
            'postcss:expanded',
            'postcss:min',
            'concat:dist',
            'uglify:dist',
            'clean:temp'
        ]
    );

    grunt.registerTask('js_compile', ['concat:dist', 'uglify:dist']);
    grunt.registerTask('sass_compile', ['sass:expanded', 'sass:min', 'notify:sass_compile']);
    grunt.registerTask('server', ['php', 'browserSync', 'notify:server']);
    grunt.registerTask('monitor', ["concurrent:monitor"]);
};