<?php

namespace common\components;

use yii\web\NotFoundHttpException;

class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * @param $db = null
     * @param string $exceptionMessage = null Message for exception
     * @return array|null|ActiveRecord
     * @throws NotFoundHttpException
     * @see self::one()
     */
    public function oneOrException($db = null, $exceptionMessage = null)
    {
        $record = $this->one($db);
        if (!$record) {
            throw new NotFoundHttpException($exceptionMessage);
        }
        return $record;
    }

}