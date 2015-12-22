<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Download Functions
 *
 * Handles to all donwload functions
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
/**
 * Get File Ctype
 * 
 * Handles to get file ctype
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_file_ctype( $extension ) {
  
	switch( $extension ) {
		case 'ac'		: $type	= "application/pkix-attr-cert"; break;
		case 'adp'		: $type	= "audio/adpcm"; break;
		case 'ai'		: $type	= "application/postscript"; break;
		case 'aif'		: $type	= "audio/x-aiff"; break;
		case 'aifc'		: $type	= "audio/x-aiff"; break;
		case 'aiff'		: $type	= "audio/x-aiff"; break;
		case 'air'		: $type	= "application/vnd.adobe.air-application-installer-package+zip"; break;
		case 'apk'		: $type	= "application/vnd.android.package-archive"; break;
		case 'asc'		: $type	= "application/pgp-signature"; break;
		case 'atom'		: $type	= "application/atom+xml"; break;
		case 'atomcat'	: $type	= "application/atomcat+xml"; break;
		case 'atomsvc'	: $type	= "application/atomsvc+xml"; break;
		case 'au'		: $type	= "audio/basic"; break;
		case 'aw'		: $type	= "application/applixware"; break;
		case 'avi'		: $type	= "video/x-msvideo"; break;
		case 'bcpio'	: $type	= "application/x-bcpio"; break;
		case 'bin'		: $type	= "application/octet-stream"; break;
		case 'bmp'		: $type	= "image/bmp"; break;
		case 'boz'		: $type	= "application/x-bzip2"; break;
		case 'bpk'		: $type	= "application/octet-stream"; break;
		case 'bz'		: $type	= "application/x-bzip"; break;
		case 'bz2'		: $type	= "application/x-bzip2"; break;
		case 'ccxml'	: $type	= "application/ccxml+xml"; break;
		case 'cdmia'	: $type	= "application/cdmi-capability"; break;
		case 'cdmic'	: $type	= "application/cdmi-container"; break;
		case 'cdmid'	: $type	= "application/cdmi-domain"; break;
		case 'cdmio'	: $type	= "application/cdmi-object"; break;
		case 'cdmiq'	: $type	= "application/cdmi-queue"; break;
		case 'cdf'		: $type	= "application/x-netcdf"; break;
		case 'cer'		: $type	= "application/pkix-cert"; break;
		case 'cgm'		: $type	= "image/cgm"; break;
		case 'class'	: $type	= "application/octet-stream"; break;
		case 'cpio'		: $type	= "application/x-cpio"; break;
		case 'cpt'		: $type	= "application/mac-compactpro"; break;
		case 'crl'		: $type	= "application/pkix-crl"; break;
		case 'csh'		: $type	= "application/x-csh"; break;
		case 'css'		: $type	= "text/css"; break;
		case 'cu'		: $type	= "application/cu-seeme"; break;
		case 'davmount'	: $type	= "application/davmount+xml"; break;
		case 'dbk'		: $type	= "application/docbook+xml"; break;
		case 'dcr'		: $type	= "application/x-director"; break;
		case 'deploy'	: $type	= "application/octet-stream"; break;
		case 'dif'		: $type	= "video/x-dv"; break;
		case 'dir'		: $type	= "application/x-director"; break;
		case 'dist'		: $type	= "application/octet-stream"; break;
		case 'distz'	: $type	= "application/octet-stream"; break;
		case 'djv'		: $type	= "image/vnd.djvu"; break;
		case 'djvu'		: $type	= "image/vnd.djvu"; break;
		case 'dll'		: $type	= "application/octet-stream"; break;
		case 'dmg'		: $type	= "application/octet-stream"; break;
		case 'dms'		: $type	= "application/octet-stream"; break;
		case 'doc'		: $type	= "application/msword"; break;
		case 'docx'		: $type	= "application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
		case 'dotx'		: $type	= "application/vnd.openxmlformats-officedocument.wordprocessingml.template"; break;
		case 'dssc'		: $type	= "application/dssc+der"; break;
		case 'dtd'		: $type	= "application/xml-dtd"; break;
		case 'dump'		: $type	= "application/octet-stream"; break;
		case 'dv'		: $type	= "video/x-dv"; break;
		case 'dvi'		: $type	= "application/x-dvi"; break;
		case 'dxr'		: $type	= "application/x-director"; break;
		case 'ecma'		: $type	= "application/ecmascript"; break;
		case 'elc'		: $type	= "application/octet-stream"; break;
		case 'emma'		: $type	= "application/emma+xml"; break;
		case 'eps'		: $type	= "application/postscript"; break;
		case 'epub'		: $type	= "application/epub+zip"; break;
		case 'etx'		: $type	= "text/x-setext"; break;
		case 'exe'		: $type	= "application/octet-stream"; break;
		case 'exi'		: $type	= "application/exi"; break;
		case 'ez'		: $type	= "application/andrew-inset"; break;
		case 'f4v'		: $type	= "video/x-f4v"; break;
		case 'fli'		: $type	= "video/x-fli"; break;
		case 'flv'		: $type	= "video/x-flv"; break;
		case 'gif'		: $type	= "image/gif"; break;
		case 'gml'		: $type	= "application/srgs"; break;
		case 'gpx'		: $type	= "application/gml+xml"; break;
		case 'gram'		: $type	= "application/gpx+xml"; break;
		case 'grxml'	: $type	= "application/srgs+xml"; break;
		case 'gtar'		: $type	= "application/x-gtar"; break;
		case 'gxf'		: $type	= "application/gxf"; break;
		case 'hdf'		: $type	= "application/x-hdf"; break;
		case 'hqx'		: $type	= "application/mac-binhex40"; break;
		case 'htm'		: $type	= "text/html"; break;
		case 'html'		: $type	= "text/html"; break;
		case 'ice'		: $type	= "x-conference/x-cooltalk"; break;
		case 'ico'		: $type	= "image/x-icon"; break;
		case 'ics'		: $type	= "text/calendar"; break;
		case 'ief'		: $type	= "image/ief"; break;
		case 'ifb'		: $type	= "text/calendar"; break;
		case 'iges'		: $type	= "model/iges"; break;
		case 'igs'		: $type	= "model/iges"; break;
		case 'ink'		: $type	= "application/inkml+xml"; break;
		case 'inkml'	: $type	= "application/inkml+xml"; break;
		case 'ipfix'	: $type	= "application/ipfix"; break;
		case 'jar'		: $type	= "application/java-archive"; break;
		case 'jnlp'		: $type	= "application/x-java-jnlp-file"; break;
		case 'jp2'		: $type	= "image/jp2"; break;
		case 'jpe'		: $type	= "image/jpeg"; break;
		case 'jpeg'		: $type	= "image/jpeg"; break;
		case 'jpg'		: $type	= "image/jpeg"; break;
		case 'js'		: $type	= "application/javascript"; break;
		case 'json'		: $type	= "application/json"; break;
		case 'jsonml'	: $type	= "application/jsonml+json"; break;
		case 'kar'		: $type	= "audio/midi"; break;
		case 'latex'	: $type	= "application/x-latex"; break;
		case 'lha'    	: $type  = "application/octet-stream"; break;
		case 'lrf'    	: $type  = "application/octet-stream"; break;
		case 'lzh'    	: $type  = "application/octet-stream"; break;
		case 'lostxml'	: $type	= "application/lost+xml"; break;
		case 'm3u'		: $type	= "audio/x-mpegurl"; break;
		case 'm4a'		: $type	= "audio/mp4a-latm"; break;
		case 'm4b'		: $type	= "audio/mp4a-latm"; break;
		case 'm4p'		: $type	= "audio/mp4a-latm"; break;
		case 'm4u'		: $type	= "video/vnd.mpegurl"; break;
		case 'm4v'		: $type	= "video/x-m4v"; break;
		case 'm21'		: $type	= "application/mp21"; break;
		case 'ma'		: $type	= "application/mathematica"; break;
		case 'mac'		: $type	= "image/x-macpaint"; break;
		case 'mads'		: $type	= "application/mads+xml"; break;
		case 'man'		: $type	= "application/x-troff-man"; break;
		case 'mar'		: $type	= "application/octet-stream"; break;
		case 'mathml'	: $type	= "application/mathml+xml"; break;
		case 'mbox'		: $type	= "application/mbox"; break;
		case 'me'		: $type	= "application/x-troff-me"; break;
		case 'mesh'		: $type	= "model/mesh"; break;
		case 'metalink'	: $type	= "application/metalink+xml"; break;
		case 'meta4'	: $type	= "application/metalink4+xml"; break;
		case 'mets'		: $type	= "application/mets+xml"; break;
		case 'mid'		: $type	= "audio/midi"; break;
		case 'midi'		: $type	= "audio/midi"; break;
		case 'mif'		: $type	= "application/vnd.mif"; break;
		case 'mods'		: $type	= "application/mods+xml"; break;
		case 'mov'		: $type	= "video/quicktime"; break;
		case 'movie'	: $type	= "video/x-sgi-movie"; break;
		case 'm1v'		: $type	= "video/mpeg"; break;
		case 'm2v'		: $type	= "video/mpeg"; break;
		case 'mp2'		: $type	= "audio/mpeg"; break;
		case 'mp2a'		: $type	= "audio/mpeg"; break;
		case 'mp21'		: $type	= "application/mp21"; break;
		case 'mp3'		: $type	= "audio/mpeg"; break;
		case 'mp3a'		: $type	= "audio/mpeg"; break;
		case 'mp4'		: $type	= "video/mp4"; break;
		case 'mp4s'		: $type	= "application/mp4"; break;
		case 'mpe'		: $type	= "video/mpeg"; break;
		case 'mpeg'		: $type	= "video/mpeg"; break;
		case 'mpg'		: $type	= "video/mpeg"; break;
		case 'mpg4'		: $type	= "video/mpeg"; break;
		case 'mpga'		: $type	= "audio/mpeg"; break;
		case 'mrc'		: $type	= "application/marc"; break;
		case 'mrcx'		: $type	= "application/marcxml+xml"; break;
		case 'ms'		: $type	= "application/x-troff-ms"; break;
		case 'mscml'	: $type	= "application/mediaservercontrol+xml"; break;
		case 'msh'		: $type	= "model/mesh"; break;
		case 'mxf'		: $type	= "application/mxf"; break;
		case 'mxu'		: $type	= "video/vnd.mpegurl"; break;
		case 'nc'		: $type	= "application/x-netcdf"; break;
		case 'oda'		: $type	= "application/oda"; break;
		case 'oga'		: $type	= "application/ogg"; break;
		case 'ogg'		: $type	= "application/ogg"; break;
		case 'ogx'		: $type	= "application/ogg"; break;
		case 'omdoc'	: $type	= "application/omdoc+xml"; break;
		case 'onetoc'	: $type	= "application/onenote"; break;
		case 'onetoc2'	: $type	= "application/onenote"; break;
		case 'onetmp'	: $type	= "application/onenote"; break;
		case 'onepkg'	: $type	= "application/onenote"; break;
		case 'opf'		: $type	= "application/oebps-package+xml"; break;
		case 'oxps'		: $type	= "application/oxps"; break;
		case 'p7c'		: $type	= "application/pkcs7-mime"; break;
		case 'p7m'		: $type	= "application/pkcs7-mime"; break;
		case 'p7s'		: $type	= "application/pkcs7-signature"; break;
		case 'p8'		: $type	= "application/pkcs8"; break;
		case 'p10'		: $type	= "application/pkcs10"; break;
		case 'pbm'		: $type	= "image/x-portable-bitmap"; break;
		case 'pct'		: $type	= "image/pict"; break;
		case 'pdb'		: $type	= "chemical/x-pdb"; break;
		case 'pdf'		: $type	= "application/pdf"; break;
		case 'pki'		: $type	= "application/pkixcmp"; break;
		case 'pkipath'	: $type	= "application/pkix-pkipath"; break;
		case 'pfr'		: $type	= "application/font-tdpfr"; break;
		case 'pgm'		: $type	= "image/x-portable-graymap"; break;
		case 'pgn'		: $type	= "application/x-chess-pgn"; break;
		case 'pgp'		: $type	= "application/pgp-encrypted"; break;
		case 'pic'		: $type	= "image/pict"; break;
		case 'pict'		: $type	= "image/pict"; break;
		case 'pkg'		: $type	= "application/octet-stream"; break;
		case 'png'		: $type	= "image/png"; break;
		case 'pnm'		: $type	= "image/x-portable-anymap"; break;
		case 'pnt'		: $type	= "image/x-macpaint"; break;
		case 'pntg'		: $type	= "image/x-macpaint"; break;
		case 'pot'		: $type	= "application/vnd.ms-powerpoint"; break;
		case 'potx'		: $type	= "application/vnd.openxmlformats-officedocument.presentationml.template"; break;
		case 'ppm'		: $type	= "image/x-portable-pixmap"; break;
		case 'pps'		: $type	= "application/vnd.ms-powerpoint"; break;
		case 'ppsx'		: $type	= "application/vnd.openxmlformats-officedocument.presentationml.slideshow"; break;
		case 'ppt'		: $type	= "application/vnd.ms-powerpoint"; break;
		case 'pptx'		: $type	= "application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
		case 'prf'		: $type	= "application/pics-rules"; break;
		case 'ps'		: $type	= "application/postscript"; break;
		case 'psd'		: $type	= "image/photoshop"; break;
		case 'qt'		: $type	= "video/quicktime"; break;
		case 'qti'		: $type	= "image/x-quicktime"; break;
		case 'qtif'		: $type	= "image/x-quicktime"; break;
		case 'ra'		: $type	= "audio/x-pn-realaudio"; break;
		case 'ram'		: $type	= "audio/x-pn-realaudio"; break;
		case 'ras'		: $type	= "image/x-cmu-raster"; break;
		case 'rdf'		: $type	= "application/rdf+xml"; break;
		case 'rgb'		: $type	= "image/x-rgb"; break;
		case 'rm'		: $type	= "application/vnd.rn-realmedia"; break;
		case 'rmi'		: $type	= "audio/midi"; break;
		case 'roff'		: $type	= "application/x-troff"; break;
		case 'rss'		: $type	= "application/rss+xml"; break;
		case 'rtf'		: $type	= "text/rtf"; break;
		case 'rtx'		: $type	= "text/richtext"; break;
		case 'sgm'		: $type	= "text/sgml"; break;
		case 'sgml'		: $type	= "text/sgml"; break;
		case 'sh'		: $type	= "application/x-sh"; break;
		case 'shar'		: $type	= "application/x-shar"; break;
		case 'sig'		: $type	= "application/pgp-signature"; break;
		case 'silo'		: $type	= "model/mesh"; break;
		case 'sit'		: $type	= "application/x-stuffit"; break;
		case 'skd'		: $type	= "application/x-koan"; break;
		case 'skm'		: $type	= "application/x-koan"; break;
		case 'skp'		: $type	= "application/x-koan"; break;
		case 'skt'		: $type	= "application/x-koan"; break;
		case 'sldx'		: $type	= "application/vnd.openxmlformats-officedocument.presentationml.slide"; break;
		case 'smi'		: $type	= "application/smil"; break;
		case 'smil'		: $type	= "application/smil"; break;
		case 'snd'		: $type	= "audio/basic"; break;
		case 'so'		: $type	= "application/octet-stream"; break;
		case 'spl'		: $type	= "application/x-futuresplash"; break;
		case 'spx'		: $type	= "audio/ogg"; break;
		case 'src'		: $type	= "application/x-wais-source"; break;
		case 'stk'		: $type	= "application/hyperstudio"; break;
		case 'sv4cpio'	: $type	= "application/x-sv4cpio"; break;
		case 'sv4crc'	: $type	= "application/x-sv4crc"; break;
		case 'svg'		: $type	= "image/svg+xml"; break;
		case 'swf'		: $type	= "application/x-shockwave-flash"; break;
		case 't'		: $type	= "application/x-troff"; break;
		case 'tar'		: $type	= "application/x-tar"; break;
		case 'tcl'		: $type	= "application/x-tcl"; break;
		case 'tex'		: $type	= "application/x-tex"; break;
		case 'texi'		: $type	= "application/x-texinfo"; break;
		case 'texinfo'	: $type	= "application/x-texinfo"; break;
		case 'tif'		: $type	= "image/tiff"; break;
		case 'tiff'		: $type	= "image/tiff"; break;
		case 'torrent'	: $type	= "application/x-bittorrent"; break;
		case 'tr'		: $type	= "application/x-troff"; break;
		case 'tsv'		: $type	= "text/tab-separated-values"; break;
		case 'txt'		: $type	= "text/plain"; break;
		case 'ustar'	: $type	= "application/x-ustar"; break;
		case 'vcd'		: $type	= "application/x-cdlink"; break;
		case 'vrml'		: $type	= "model/vrml"; break;
		case 'vsd'		: $type	= "application/vnd.visio"; break;
		case 'vss'		: $type	= "application/vnd.visio"; break;
		case 'vst'		: $type	= "application/vnd.visio"; break;
		case 'vsw'		: $type	= "application/vnd.visio"; break;
		case 'vxml'		: $type	= "application/voicexml+xml"; break;
		case 'wav'		: $type	= "audio/x-wav"; break;
		case 'wbmp'		: $type	= "image/vnd.wap.wbmp"; break;
		case 'wbmxl'	: $type	= "application/vnd.wap.wbxml"; break;
		case 'wm'		: $type	= "video/x-ms-wm"; break;
		case 'wml'		: $type	= "text/vnd.wap.wml"; break;
		case 'wmlc'		: $type	= "application/vnd.wap.wmlc"; break;
		case 'wmls'		: $type	= "text/vnd.wap.wmlscript"; break;
		case 'wmlsc'	: $type	= "application/vnd.wap.wmlscriptc"; break;
		case 'wmv'		: $type	= "video/x-ms-wmv"; break;
		case 'wmx'		: $type	= "video/x-ms-wmx"; break;
		case 'wrl'		: $type	= "model/vrml"; break;
		case 'xbm'		: $type	= "image/x-xbitmap"; break;
		case 'xdssc'	: $type	= "application/dssc+xml"; break;
		case 'xer'		: $type	= "application/patch-ops-error+xml"; break;
		case 'xht'		: $type	= "application/xhtml+xml"; break;
		case 'xhtml'	: $type	= "application/xhtml+xml"; break;
		case 'xla'		: $type	= "application/vnd.ms-excel"; break;
		case 'xlam'		: $type	= "application/vnd.ms-excel.addin.macroEnabled.12"; break;
		case 'xlc'		: $type	= "application/vnd.ms-excel"; break;
		case 'xlm'		: $type	= "application/vnd.ms-excel"; break;
		case 'xls'		: $type	= "application/vnd.ms-excel"; break;
		case 'xlsx'		: $type	= "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
		case 'xlsb'		: $type	= "application/vnd.ms-excel.sheet.binary.macroEnabled.12"; break;
		case 'xlt'		: $type	= "application/vnd.ms-excel"; break;
		case 'xltx'		: $type	= "application/vnd.openxmlformats-officedocument.spreadsheetml.template"; break;
		case 'xlw'		: $type	= "application/vnd.ms-excel"; break;
		case 'xml'		: $type	= "application/xml"; break;
		case 'xpm'		: $type	= "image/x-xpixmap"; break;
		case 'xsl'		: $type	= "application/xml"; break;
		case 'xslt'		: $type	= "application/xslt+xml"; break;
		case 'xul'		: $type	= "application/vnd.mozilla.xul+xml"; break;
		case 'xwd'		: $type	= "image/x-xwindowdump"; break;
		case 'xyz'		: $type	= "chemical/x-xyz"; break;
		case 'zip'		: $type	= "application/zip"; break;
		default			: $type	= "application/force-download";
	}

	return apply_filters( 'wps_deals_file_ctype', $type );
}
/**
 * Get File Extension
 * 
 * Handles to get file extension
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_get_file_extension( $file ) {
   $ext = explode( '.', $file );
   return end( $ext );
}
/**
 * File Chunked
 * 
 * Handles to check File chunked or not
 * 
 * @package Social Deals Engine
 * @since 1.0.0
 */
function wps_deals_readfile_chunked( $file, $retbytes = TRUE ) {

	$chunksize = 1 * (1024 * 1024);
	$buffer = '';
	$cnt = 0;

	$handle = fopen( $file, 'r' );
	if( $handle === FALSE ) return FALSE;

	while( !feof($handle) ) :
	   $buffer = fread( $handle, $chunksize );
	   echo $buffer;
	   ob_flush();
	   flush();

	   if ( $retbytes ) $cnt += strlen( $buffer );
	endwhile;

	$status = fclose( $handle );

	if( $retbytes AND $status ) return $cnt;

	return $status;
}