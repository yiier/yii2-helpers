<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2015/12/31 16:21
 * description:
 */

namespace yiier\helpers\validators;

use yii\validators\Validator;

class ArrayValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!is_array($model->$attribute)) {
            $this->addError($model, $attribute, $this->message ?: $attribute . '必须是一个数组');
        }
    }
}