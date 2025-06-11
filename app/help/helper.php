<?php

/* get id object */
function object_id($object)
{
    return $object == null ? $id = '' : $id = $object->id;
}

/*get value field*/

function field_value($object , $key)
{
    if ($object == null){
        return old($key);
    }
    if (!property_exists($object, $key)) {
        return $object->$key;
    }
}


function field_value2($object , $key)
{
    if ($object == null){
        return old($key);
    }
    if (property_exists($object, $key)) {
        return $object->$key;
    }
}

function getLang(): array
{
    return [
        [
            'lang_symbol' => 'ar',
            'name' => 'arabic',
            'dir' => 'rtl',
        ],

        [
            'lang_symbol' => 'en',
            'name' => 'english',
            'dir' => 'ltr',
        ],
    ];
}
