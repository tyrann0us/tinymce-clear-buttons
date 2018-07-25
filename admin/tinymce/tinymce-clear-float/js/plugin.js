( function() {

	tinymce.create( 'tinymce.plugins.tinymce_clear_float', {
		/**
		 * @param {tinymce.Editor} editor Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function( editor, url ) {
			var parser        = new DOMParser(),
			    shortcutLabel = ( tinymce.Env.mac ? '\u2303\u2325' : 'Shift+Alt+' ) + 'F';

			/**
			 * Create placeholder image.
			 */
			placeholder           = document.createElement( 'img' );
			placeholder.src       = tinymce.Env.transparentSrc;
			placeholder.className = 'mce-tinymce-clear-float';
			placeholder.title     = editor.getLang( 'tinymce_clear_float.img_title' );
			/**
			 * `data-wp-more` is required to apply core CSS to the placeholder element.
			 */
			placeholder.setAttribute( 'data-wp-more', '' );
			placeholder.setAttribute( 'data-mce-resize', false );
			placeholder.setAttribute( 'data-mce-placeholder', 1 );

			/**
			 * Create clear element.
			 */
			element             = document.createElement( 'br' );
			element.style.clear = 'both';

			editor.addButton( 'tinymce-clear-float', {
				title: editor.getLang( 'tinymce_clear_float.tooltip' ) + ' (' + shortcutLabel + ')',
				cmd:   'clear_both',
				image: url + '/../images/tinymce-clear-float-icon.svg',
			} );

			editor.addShortcut( 'access+f', null, 'clear_both' );

			editor.addCommand( 'clear_both', function() {
				editor.execCommand( 'mceInsertContent', false, placeholder.outerHTML );
			} );

			/**
			 *  Replace all instances of `<br style="clear: both;">` with placeholder image.
			 */
			editor.on( 'BeforeSetContent', function( event ) {
				if ( ! event.content ) {
					return;
				}

				var html     = parser.parseFromString( event.content, 'text/html' ),
				    elements = html.getElementsByTagName( 'br' );

				for ( var i = elements.length - 1; i >= 0; i-- ) {
					if ( 'both' === elements[ i ].style.clear ) {
						elements[ i ].parentNode.replaceChild( placeholder.cloneNode(), elements[ i ] );
					}
				};

				/**
				 * Also replace `<div style="clear:*"></div>` (deprecated).
				 * This HTML markup has been used until v1.1.
				 */
				var deprecated = html.getElementsByTagName( 'div' ),
					nbsp       = '\u00a0';
				for ( var i = deprecated.length - 1; i >= 0; i-- ) {
					if ( 'both' === deprecated[ i ].style.clear && ( ! deprecated[ i ].hasChildNodes() || nbsp === deprecated[ i ].textContent ) ) {
						deprecated[ i ].parentNode.replaceChild( placeholder.cloneNode(), deprecated[ i ] );
					}
				};
				event.content = html.body.innerHTML;
			} );

			/**
			 *  Replace all instances of the placeholder image with `<br style="clear: both;">`.
			 */
			editor.on( 'PostProcess', function( event ) {
				if ( ! event.content ) {
					return;
				}

				var html     = parser.parseFromString( event.content, 'text/html' ),
				    elements = html.getElementsByTagName( 'img' );

				for ( var i = elements.length - 1; i >= 0; i-- ) {
					if ( 'mce-tinymce-clear-float' === elements[ i ].className ) {
						elements[ i ].parentNode.replaceChild( element.cloneNode(), elements[ i ] );
					}
				};
				event.content = html.body.innerHTML;
			} );
		},

	} );

	// Register plugin
	tinymce.PluginManager.add( 'tinymce_clear_float_plugin', tinymce.plugins.tinymce_clear_float );
} )();
