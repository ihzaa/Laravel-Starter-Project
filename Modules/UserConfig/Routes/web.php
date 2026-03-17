<?php

$dir = module_path('UserConfig', 'Routes/web');

if (!is_dir($dir)) {
    return;
}

$files = scandir($dir);
$dirs = [];

foreach ($files as $file) {
    if (!in_array($file, ['index.php', '.', '..'], true) && str_ends_with($file, '.php')) {
        require $dir.'/'.$file;
    }

    if (!in_array($file, ['.', '..'], true) && !str_ends_with($file, '.php')) {
        $dirs[] = $file;
    }
}

if ($dirs !== []) {
    readSubDir($dir, $dirs);
}
