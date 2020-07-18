<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2017/7/28 15:31
 * description:
 */

namespace yiier\helpers;

class ResponseHandler
{
    public $event;
    public $successMessage;

    /**
     * 返回数据统一处理
     */
    public function formatResponse()
    {
        $response = $this->event->sender;
        if ($response->data !== null) {
            if (isset($response->data['code']) && isset($response->data['message'])) {
                $response->data = [
                    'code' => $response->data['code'] ?: $response->statusCode,
                    'data' => isset($response->data['data']) ? $response->data['data'] : null,
                    'message' => $response->data['message'],
                ];
            } elseif ($response->format != 'html' && !isset($response->data['message'])) {
                $response->data = [
                    'code' => 0,
                    'data' => $response->data,
                    'message' => $this->successMessage ?: \Yii::t('app', 'Success Message'),
                ];
            } elseif (isset($response->data['message']) && $response->data['message'] != "" && !isset($response->data['code'])) {
                $message = $response->data['message'];
                unset($response->data['message']);
                $response->data = [
                    'code' => 0,
                    'data' => isset($response->data[0]) ? $response->data[0] : $response->data,
                    'message' => $message,
                ];
            }
        }
    }
}
