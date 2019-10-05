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
		case 'themes':
			lazyLoadImages( document.querySelectorAll( '.theme-screenshot img' ) );
			lazyLoadTemplate( 'tmpl-theme' );
			break;
		case 'theme-install':
			lazyLoadTemplate( 'tmpl-theme' );
			break;
	}
} );
