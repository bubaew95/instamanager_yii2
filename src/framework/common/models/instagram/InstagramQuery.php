<?php

namespace common\models\instagram;

use common\models\modules\UserModules;
use common\models\projects\Projects;

/**
 * This is the ActiveQuery class for [[InstagramModel]].
 *
 * @see InstagramModel
 */
class InstagramQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function projectInstagramAcc($id_project, $id_user)
    {
        //$id_user = \Yii::$app->user->identity->getId();
        return $this->innerJoinWith('project')
            ->where([Projects::tableName() . '.id' => (int) $id_project])
            ->andWhere(['id_user' => $id_user]);
    }

    /**
     * {@inheritdoc}
     * @return InstagramModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InstagramModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
