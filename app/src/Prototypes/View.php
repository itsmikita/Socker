<?php
namespace Prototypes;

use Toolbox\HTTP;
use Toolbox\Event;
use Mustache_Engine;
use Mustache_Autoloader;
use Mustache_Loader_FilesystemLoader;

class View
{
	/**
	 * Get Mustache
	 */
	public static function getMustache()
	{
		static $mustache = null;
		
		if( ! is_a( $mustache, 'Mustache_Engine' ) ) {
			require_once ABSPATH . "/app/vendor/mustache-php/src/Mustache/Autoloader.php";
			
			Mustache_Autoloader::register();
			
			$loader = new Mustache_Loader_FilesystemLoader( ABSPATH . "/public/assets/templates", [
				'extension' => "ms"
			] );
			$partialsLoader = new Mustache_Loader_FilesystemLoader( ABSPATH . "/public/assets/templates/partials", [
				'extension' => "ms"
			] );
			$mustache = new Mustache_Engine( [
				'cache' => ABSPATH . "/public/cache/mustache",
				'loader' => $loader,
				'partials_loader' => $partialsLoader,
				'helpers' => [
					'url' => function( $path ) {
						return HTTP::url( $path );
					},
					'i18n' => function( $text, $helper ) {
						return $helper->render( $text );
					}
				]
			] );
		}
		
		return $mustache;
	}
	
	/**
	 * Render template
	 *
	 * @param string $template
	 * @param mixed $data
	 */
	public static function render( $template, $data = [] )
	{
		$mustache = self::getMustache();
		$data = Event::trigger( 'template_data', $data );
		
		return $mustache->render( $template, $data );
	}
}