export default function lazyLoadImages( nodeList ) {
	const images = [].slice.call( nodeList );

	images.forEach( ( image ) => {
		image.setAttribute( 'data-src', image.getAttribute( 'src' ) );
		image.removeAttribute( 'src' );

		image.className += ' lazyload';
	} );
}
