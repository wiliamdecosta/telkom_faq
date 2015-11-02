<?php

function getVarClean($name, $type = '', $defaultValue = NULL)
{
    $var = getVar($name);
    $var = cleanVar($var);

    if ($var == '' && $defaultValue !== NULL){
        return $defaultValue;
    }

    if (!isset($type)) return $var;

    switch ($type) {
        case 'bool':
            if (is_bool($var)) return $var;
            break;
        case 'str':
        case 'string':
            if (is_string($var)) return $var;
            break;
        case 'object':
            if (is_object($var)) return $var;
            break;
        case 'array':
            if (is_array($var)) return $var;
            break;
        case 'float':
        case 'int':
        case 'numeric':
            if (is_numeric($var)) return $var;
            break;
        default:
            return $var;
    }

    if (isset($defaultValue)) return $defaultValue;

    return '';
}

function cleanVar($var)
{
    $search = array('|</?\s*SCRIPT[^>]*>|si',
                    '|</?\s*FRAME[^>]*>|si',
                    '|</?\s*OBJECT[^>]*>|si',
                    '|</?\s*META[^>]*>|si',
                    '|</?\s*APPLET[^>]*>|si',
                    '|</?\s*LINK[^>]*>|si',
                    '|</?\s*IFRAME[^>]*>|si',
                    '|STYLE\s*=\s*"[^"]*"|si');
    // short open tag <  followed by ? (we do it like this otherwise our qa tests go bonkers)
    $replace = array('');
    // Clean var
    $var = preg_replace($search, $replace, $var);

    return $var;
}

function getVar($name, $allowOnlyMethod = NULL)
{
    if ($allowOnlyMethod == 'GET') {
        if (isset($_GET[$name])) {
            // Then check in $_GET
            $value = $_GET[$name];
        } else {
            // Nothing found, return void
            return;
        }
    } elseif ($allowOnlyMethod == 'POST') {
        if (isset($_POST[$name])) {
            // First check in $_POST
            $value = $_POST[$name];
        } else {
            // Nothing found, return void
            return;
        }
    } else {
        if (isset($_POST[$name])) {
            // Then check in $_POST
            $value = $_POST[$name];
        } elseif (isset($_GET[$name])) {
            // Then check in $_GET
            $value = $_GET[$name];
        } else {
            // Nothing found, return void
            return;
        }
    }

    if (get_magic_quotes_gpc()) {
        $value = __stripslashes($value);
    }
    return $value;
}

function __stripslashes($value)
{
    $value = is_array($value) ? array_map(array('self','__stripslashes'), $value) : stripslashes($value);
    return $value;
}

?>