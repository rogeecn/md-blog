<?php
namespace common\extend;

use yii\web\Response;

class ContentNegotiator extends \yii\filters\ContentNegotiator
{
 public function behaviors()
  {
      return [
          [
              'class' => \yii\filters\ContentNegotiator::className(),
              'formats' => [
                  'application/json' => Response::FORMAT_JSON,
              ],
          ],
      ];
  }
}