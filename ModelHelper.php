<?php
/**
 * author     : forecho <caizh@chexiu.cn>
 * createTime : 2015/12/31 17:51
 * description:
 */

namespace common\helpers;

class ModelHelper
{
    /**
     * 批量插入数据保存
     * @param $tableName
     * @param array $rows
     * @return int
     * @throws \yii\db\Exception
     */
    public static function saveAll($tableName, $rows = [])
    {
        return \Yii::$app->db->createCommand()
            ->batchInsert($tableName, array_keys(array_values($rows)[0]), $rows)
            ->execute();
    }
}