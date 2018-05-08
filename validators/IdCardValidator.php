<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2018/05/08 16:21
 * description:
 */

namespace yiier\helpers\validators;

use yii\validators\Validator;

class IdCardValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!$this->validationFilterIdCard($model->$attribute)) {
            $this->addError($model, $attribute, $this->message ?: '请输入正确的身份证号码');
        }
    }

    private function validationFilterIdCard($idCard)
    {
        if (strlen($idCard) == 18) {
            return $this->idCardChecksum18($idCard);
        } elseif ((strlen($idCard) == 15)) {
            $idCard = $this->idCard15to18($idCard);
            return $this->idCardChecksum18($idCard);
        } else {
            return false;
        }
    }

    // 计算身份证校验码，根据国家标准GB 11643-1999
    private function idCardVerifyNumber($idCardBase)
    {
        if (strlen($idCardBase) != 17) {
            return false;
        }
        //加权因子
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        //校验码对应值
        $verifyNumberList = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $checksum = 0;
        for ($i = 0; $i < strlen($idCardBase); $i++) {
            $checksum += substr($idCardBase, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        $verifyNumber = $verifyNumberList[$mod];
        return $verifyNumber;
    }

    // 将15位身份证升级到18位
    private function idCard15to18($idCard)
    {
        if (strlen($idCard) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($idCard, 12, 3), ['996', '997', '998', '999']) !== false) {
                $idCard = substr($idCard, 0, 6) . '18' . substr($idCard, 6, 9);
            } else {
                $idCard = substr($idCard, 0, 6) . '19' . substr($idCard, 6, 9);
            }
        }
        $idCard = $idCard . $this->idCardVerifyNumber($idCard);
        return $idCard;
    }

    // 18位身份证校验码有效性检查
    private function idCardChecksum18($idCard)
    {
        if (strlen($idCard) != 18) {
            return false;
        }
        $idCardBase = substr($idCard, 0, 17);
        if ($this->idCardVerifyNumber($idCardBase) != strtoupper(substr($idCard, 17, 1))) {
            return false;
        } else {
            return true;
        }
    }
}