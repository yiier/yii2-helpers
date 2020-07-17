<?php

use yii\helpers\ArrayHelper;

if (!function_exists('data_get')) {
    /**
     * @param $array
     * @param $key
     * @param null $default
     * @return mixed|null
     * @throws Exception
     */
    function data_get($array, $key, $default = null)
    {
        return ArrayHelper::getValue($array, $key, $default);
    }
}

if (!function_exists('data_column')) {
    /**
     * @param $array
     * @param $name
     * @param bool $keepKeys
     * @return mixed|null
     */
    function data_column($array, $name, $keepKeys = true)
    {
        return ArrayHelper::getColumn($array, $name, $keepKeys);
    }
}
