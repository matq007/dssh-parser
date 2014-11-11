<?php

$config = parse_ini_file('dssh.conf', true);
$path   = $config["directory"]["path"];
$hidden = $config["directory"]["hidden"] == "true" ? true : false;

function listDir($dir, $show)
{
    echo "<ul>";

    $current = scandir($dir);
    foreach ($current as $key => $value)
    {
        if (!in_array($value, array(".","..")))
        {
            if($value[0] == "." && !$show)
            {
                continue;
            }
            else
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    echo "<ul>";
                    echo "<li class=\"folder\"><span class=\"glyphicon glyphicon-folder-close\"></span>&nbsp;"
                            . $value . "</li>";
                    listDir($dir . DIRECTORY_SEPARATOR . $value, $show);
                    echo "</ul>";
                }
                else
                {
                    if($value[0] == "." && !$show)
                        continue;
                    else
                        echo "<li class=\"file\" value=\"$dir/$value\">
                                <span class=\"glyphicon glyphicon-file\"></span>&nbsp;"
                            . $value . "</li>";
                }
            }
        }
    }

    echo "</ul>";
}

