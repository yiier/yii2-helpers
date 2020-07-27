<?php

namespace yiier\helpers;

use Yii;
use yii\base\Component;

/**
 * Class RequestId
 * @package yiier\helpers
 * @property string $id
 */
class RequestId extends Component
{
    public $delimiter = '-';
    public $requestIdParamName = 'X_REQUEST_ID';
    public $requestIdHeaderName = 'X-Request-ID';

    /**
     * @return string
     */
    public function getId()
    {
        try {
            if ((!Yii::$app instanceof \yii\console\Application)
                && $requestId = ArrayHelper::getValue(Yii::$app->request->getHeaders(), $this->requestIdHeaderName)
            ) {
                $tmp = explode($this->delimiter, $requestId);
                if (count($tmp) < 2) {
                    $tmp = $this->genRequestId();
                }
                $tmp[1] = (int)$tmp[1] + 1;
                $requestId = sprintf('%s%s%04d', $tmp[0], $this->delimiter, $tmp[1]);
            } elseif (!$requestId = ArrayHelper::getValue(Yii::$app->params, $this->requestIdParamName)) {
                $requestId = $this->genRequestId();;
            }
            \Yii::$app->params[$this->requestIdParamName] = $requestId;
        } catch (\Exception $e) {
            Yii::error($e, __FUNCTION__);
            $requestId = null;
        }
        return $requestId;
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function genRequestId()
    {
        return sprintf('%s%s%04d', Security::generateRealUniqId(20), $this->delimiter, 0);
    }

}
