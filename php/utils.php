<?php
function toDataArray($array, $row)
{
    $arr = [];
    foreach ($array as $armure)
        foreach ($armure as $key => $value)
            if ($key === $row)
                $arr[] = $value;
    return $arr;
}
