( function() {

	tinymce.create( 'tinymce.plugins.tinymce_clear_float', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} editor Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function( editor, url ) {
			var clear_html = '<br style="clear: both;" />',
				clear_title = editor.getLang( 'tinymce_clear_float.img_title' );
				clear_shortcut_label = ( tinymce.Env.mac ? '\u2303\u2325' : 'Shift+Alt+' ) + 'F';
				clear_placeholder = '<img ' +
					'src="' + tinymce.Env.transparentSrc + '" ' +
					/*
					* Note: The `data-wp-more` attribute is used to let WordPress apply core CSS at the placeholder.
					*/
					'data-wp-more ' +
					'class="wp-tinymce-clear-float mce-tinymce-clear-float" ' +
					'alt="" ' +
					'title="' + clear_title + '" ' +
					'data-mce-resize="false" ' +
					'data-mce-placeholder="1" ' +
				'/>';

			editor.addButton( 'tinymce-clear-float', {
				title: editor.getLang( 'tinymce_clear_float.tooltip' ) + ' (' + clear_shortcut_label + ')',
				cmd: 'clear_both',
				image: url + '/../images/tinymce-clear-float-icon.svg',
			} );

			editor.addShortcut( 'access+f', null, 'clear_both' );

			editor.addCommand( 'clear_both', function(){
                editor.execCommand( 'mceInsertContent', false, clear_placeholder );
			} );

			editor.on( 'BeforeSetContent', function( event ) {
				if ( event.content ) {
					var re = new RegExp( clear_html, 'g' );
					event.content = event.content.replace( re, clear_placeholder );
					/*
					 * Replace `<div style="clear: (left|right|both);"></div>` with placeholder too.
					 * This HTML markup has been used until version 1.1.
					 */
					event.content = event.content.replace( /<div style="clear:(.+?)"><\/div>/g, clear_placeholder );
				}
			} );

			editor.on( 'PostProcess', function( event ) {
				if ( event.get ) {
					event.content = event.content.replace( /<img[^>]+>/g, function( image ) {
						var string;

						if ( image.indexOf( 'mce-tinymce-clear-float' ) !== -1 ) {
							string = clear_html;
						}
						return string || image;
					} );
				}
			} );
		},

	} );

	// Register plugin
	tinymce.PluginManager.add( 'tinymce_clear_float_plugin', tinymce.plugins.tinymce_clear_float );
} )();
