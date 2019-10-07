/**
 * External dependencies
 */
import 'lazysizes';

/**
 * Internal dependencies
 */
import { lazyLoadImages, lazyLoadTemplate } from './utils';

/**
 * Transform images as soon as the DOM content is available, but before images and other resources
 * are loaded.
 */
document.addEventListener( 'DOMContentLoaded', () => {
	switch ( adminLazyLoad.page ) {
		case 'post-edit-blocks':
			lazyLoadImages( document.querySelectorAll( '#editor img' ) );
			break;
		case 'plugin-install':
			lazyLoadImages( document.querySelectorAll( '.plugin-icon' ) );
			break;
		case 'themes':
			lazyLoadImages( document.querySelectorAll( '.theme-screenshot img' ) );
			lazyLoadTemplate( 'tmpl-theme' );
			break;
		case 'theme-install':
			lazyLoadTemplate( 'tmpl-theme' );
			break;
		case 'upload':
			lazyLoadTemplate( 'tmpl-attachment' );
			break;
	}
} );
