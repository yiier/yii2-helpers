<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2017/7/28 15:31
 * description:
 */
namespace yiier\helpers;

class Migration extends \yii\db\Migration
{
    /**
     * 创建表选项
     * @var string
     */
    public $tableOptions = null;

    /**
     * 是否事务性存储表, 则创建为事务性表. 默认使用
     * @var bool
     */
    public $useTransaction = true;


    public function init()
    {
        parent::init();

        if ($this->db->driverName === 'mysql') { //Mysql 表选项
            $engine = $this->useTransaction ? 'InnoDB' : 'MyISAM';
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=' . $engine;
        }
    }
}
