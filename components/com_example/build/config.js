module.exports = {
  // compoenent version
  version: '1.0.0',

  // css files paths
  css: {
    front_src: './src/scss/front.scss',
    front_dest: './../../../media/com_example/css/',
    admin_src: './src/scss/admin.scss',
    admin_dest:
      './../../../media/com_example/css/',
  },

  // js files paths
  js: {
    front_src: './src/js/front.js',
    front_dest: './../../../media/com_example/js/',
    admin_src: './src/js/admin.js',
    admin_dest:
      './../../../media/com_example/js/',
  },

  // package files paths
  package: {
    administrator_src:
      './../../../../administrator/components/com_example/**/*.*',
    administrator_dest: './pkg/administrator/',

    site_src: './.././**/*.*',
    site_dest: './pkg/site/',

    media_src: './../../../../media/com_example/**/*.*',
    media_dest: './pkg/media/',

		finder_plugin_src: './../../../plugins/finder/exampleitems/**/*.*',
		finder_plugin_dest: './pkg/plugins/finder/exampleitems/',

		webservices_plugin_src: './../../../plugins/webservices/example/**/*.*',
		webservices_plugin_dest: './pkg/plugins/webservices/example/',

		api_src: './../../../api/components/com_example/**/*.*', 
		api_dest: './pkg/webservices/',

		module_src: './../../../modules/mod_example/**/*.*',
		module_dest: './pkg/modules/mod_example/',

		html_file:'./../../../../components/com_example/build/index.html',
		
    script_file_src:
      './../../../../administrator/components/com_example/script.php',
    script_file_dest: './pkg/',
    studies_file_src:
      './../../../../administrator/components/com_example/example.xml',
    studies_file_dest: './pkg/',

    admin_language_gb_ini_src:
      './../../../../administrator/language/en-GB/com_example.ini',
    admin_language_gb_sys_src:
      './../../../../administrator/language/en-GB/com_example.sys.ini',
    admin_language_gb_dest: './pkg/administrator/languages/en-GB/',

		module_language_gb_ini_src: './../../../../language/en-GB/mod_example.ini',
		module_language_gb_sys_src: './../../../../language/en-GB/mod_example.sys.ini',
		module_language_gb_dest: './pkg/modules/mod_example/language/en-GB/',

		plugin_webservices_language_gb_ini_src: './../../../../administrator/language/en-GB/plg_webservices_example.ini',
		plugin_webservices_language_gb_sys_src: './../../../../administrator/language/en-GB/plg_webservices_example.sys.ini',

		plugin_webservices_language_gb_dest: './pkg/plugins/webservices/example/languages/en-GB/', 
		
		plugin_finder_language_gb_ini_src: './../../../../administrator/language/en-GB/plg_finder_exampleitems.ini',
		plugin_finder_language_gb_sys_src: './../../../../administrator/language/en-GB/plg_finder_exampleitems.sys.ini',
		
		plugin_finder_language_gb_dest: './pkg/plugins/finder/exampleitems/languages/en-GB/', 
		
  
    site_language_gb_src:
      './../../../../language/en-GB/com_example.ini',
    site_language_gb_dest: './pkg/site/languages/en-GB/',
  },
};
