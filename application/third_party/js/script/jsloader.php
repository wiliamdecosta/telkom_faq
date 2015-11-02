<?php
echo "Ext.namespace('App.store', 'App.combo', 'App.form', 'App.grid', 'App.module', 'Tracking.store', 'Tracking.combo', 'Tracking.form', 'Tracking.grid', 'Tracking.module');\n";

// Open a known directory, and proceed to read its contents
$scriptDirs = array('store', 'combo', 'form', 'grid', 'module');
for ($i=0; $i < count($scriptDirs); $i++){
    if (is_dir($scriptDirs[$i])){
        if ($dh = opendir($scriptDirs[$i])) {
            while (($file = readdir($dh)) !== false) {
                if ($file[0] == '.') continue;

                if (substr($file, -3) != '.js') continue;
                include $scriptDirs[$i]."/".$file;
            }
            closedir($dh);

        }
    }
}
?>