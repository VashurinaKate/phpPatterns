<?php

function dirTree($folder) {
    $files = new DirectoryIterator($folder);
    foreach($files as $file) {
        if (($file == '.') || ($file == '..')) continue;
        $f0 = $folder.'/'.$file; // полный путь к файлу
        if (is_dir($f0)) {
            echo "<hr><b>".$file."</b><hr>";
            dirTree($f0); // содержимое текущей директории
        }
        else echo "<i>".$file."</i></br>"; // название файла
    }
}

dirTree("../"); // или из текущего: ./
