<?php
        function is_mime ($path, $mime)
        {
            if ( ! file_exists ( $path ) ) {
                print_r('no exist');
                return false;
            }

        	$file = file ( $path );
            $mimeOrig = mime_content_type( $path );
            

            if(strstr($mimeOrig, $mime)) {
                return true;
            }

            return false;
        }


        function is_image ($path) {
            return is_mime ($path, 'image/');
        }

?>