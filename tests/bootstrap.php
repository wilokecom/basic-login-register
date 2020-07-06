<?php
function isAlwaysTrue()
{
    return true;
}

function isHasOne($aAtts)
{
    return in_array(1, $aAtts);
}

function isHasTwo($aAtts)
{
    return in_array(2, $aAtts);
}

function isNotIncluded($aAtts)
{
    return in_array(100, $aAtts);
}

function isAlwaysFalse()
{
    return false;
}

require_once (__DIR__)."./../../vendor/autoload.php";
