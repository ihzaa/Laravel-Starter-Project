<?php

#To Find Another Routes Files
// change base path to current folder
$dir   = base_path('routes/web/admin');

#Scan File To Dir
$files = scandir( $dir );

foreach ( $files as $file ) {
    if (!in_array($file, array( '.', '..', 'index.php' ))){
        require $dir . '/' . $file;
    }
};
