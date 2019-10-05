/**
 * Some pages rely on Backbone templates for displaying content. In some cases, there is no hook or
 * API provided to override these templates, and are hard-coded in the page. One way to overcome this
 * is to so modify the template in the DOM and let Backbone take it from there.
 */

/**
 * Modify 'img' element so that lazySizes can lazyload it.
 *
 * @param {string} imgAttrs
 * @return {string} Lazy-loadable 'img' element.
 */
const lazyLoadImg = ( imgAttrs ) => {
	// Change 'src' attribute to 'data-src'
	imgAttrs = imgAttrs.replace( 'src', 'data-src' );

	if ( imgAttrs.includes( 'srcset' ) ) {
		// Change 'srcset' attribute to 'data-srcset'
		imgAttrs = imgAttrs.replace( 'srcset', 'data-srcset' );
	}

	// Add a 'lazyload' class
	imgAttrs += ' class="lazyload"';

	return `<img ${ imgAttrs } />`;
};

/**
 * Apply lazyloading to all images in the provided template.
 *
 * @param {Object} id Element ID of Backbone template.
 */
export default function( id ) {
	const template = document.getElementById( id );

	// Modify all 'img' elements so that the image can be lazyloaded.
	template.text = template.text.replace(
		/<img (.*?) \/>/g,
		( match, imgAttrs ) => lazyLoadImg( imgAttrs )
	);
}
