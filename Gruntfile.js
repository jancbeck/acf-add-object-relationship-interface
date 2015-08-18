module.exports = function(grunt) {

	grunt.loadNpmTasks('grunt-wp-deploy');

	grunt.initConfig({
	    wp_deploy: {
	        deploy: { 
	            options: {
	                plugin_slug: 'acf-add-object-relationship-interface',
	                svn_user: 'jancbeck',  
	                build_dir: 'plugin' //relative path to plugin directory
	            },
	        }
	    },
	});
};