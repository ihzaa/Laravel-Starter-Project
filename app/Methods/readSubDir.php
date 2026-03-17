<?php
if (!function_exists('readSubDir')) {
    function readSubDir($dir, array $subDirs)
    {
        foreach ($subDirs as $d) {
            $subDir = $dir.'/'.$d;

            if (!is_dir($subDir)) {
                continue;
            }

            $files = scandir($subDir);
            $dirs = [];
            foreach ($files as $file) {
                if (!in_array($file, ['index.php', '.', '..'], true) && str_ends_with($file, '.php')) {
                    require $subDir.'/'.$file;
                }
                if (!in_array($file, ['.', '..'], true) && !str_ends_with($file, '.php')) {
                    $dirs[] = $file;
                }
            }

            if ($dirs !== []) {
                readSubDir($subDir, $dirs);
            }
        }
    }
}
