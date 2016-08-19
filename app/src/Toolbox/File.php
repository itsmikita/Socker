<?php
namespace Toolbox;

use Exception;
use Toolbox\HTTP;

class File
{
	/**
	 * Upload file
	 *
	 * @param array $file
	 */
	public static function upload( $file )
	{
		if( UPLOAD_ERR_OK !== $file['error'] ) {
			switch( $file['error'] ) {
				case UPLOAD_ERR_INI_SIZE:
					$message = "The uploaded file exceeds the 'upload_max_filesize' directive in 'php.ini'.";
					break;
				
				case UPLOAD_ERR_FORM_SIZE:
					$message = "The uploaded file exceeds the 'MAX_FILE_SIZE' directive that was specified in the HTML form.";
					break;
				
				case UPLOAD_ERR_PARTIAL:
					$message = "The uploaded file was only partially uploaded.";
					break;
				
				case UPLOAD_ERR_NO_FILE:
					$message = "No file was uploaded.";
					break;
				
				case UPLOAD_ERR_NO_TMP_DIR:
					$message = "Missing a temporary folder.";
					break;
				
				case UPLOAD_ERR_CANT_WRITE:
					$message = "Failed to write file to disk.";
					break;
				
				case UPLOAD_ERR_EXTENSION:
					$message = "PHP extension stopped the file upload.";
					break;
			}
			
			throw new Exception( $message );
		}
		
		$filename = self::getUniqueFilename( $file['name'] );
		
		if( ! move_uploaded_file( $file['tmp_name'], ABSPATH . "/uploads/{$filename}" ) )
			throw new Exception( "Could not move uploaded file to uploads folder." );
		
		return HTTP::getUrl( "/uploads/{$filename}" );
	}
	
	/**
	 * Get unique filename
	 *
	 * @param string $filename
	 */
	public static function getUniqueFilename( $filename )
	{
		$specialChars = [ "?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}", chr( 0 ) ];
		$filename = preg_replace( "#\x{00a0}#siu", ' ', $filename );
		$filename = str_replace( $specialChars, '', $filename );
		$filename = str_replace( [ '%20', '+' ], '-', $filename );
		$filename = preg_replace( '/[\r\n\t -]+/', '-', $filename );
		$filename = trim( $filename, '.-_' );
		$info = pathinfo( $filename );
		$ext = ! empty( $info['extension'] ) ? '.' . $info['extension'] : '';
		$name = basename( $file, $ext );
		$ext = strtolower( $ext );
		$number = '';
		
		while( file_exists( ABSPATH . "/uploads/{$filename}" ) ) {
			if( '' == "{$number}{$ext}" )
				$filename .= ++$number . $ext;
			else
				$filename = str_replace( "{$number}{$ext}", ++$number . $ext );
		}
		
		return $filename;
	}
}