<?php

namespace common\models\projects;

use common\models\users\UserToTarifs;

/**
 * This is the ActiveQuery class for [[Projects]].
 *
 * @see Projects
 */
class ProjectsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function userProject()
    {
        $id_user = \Yii::$app->user->identity->getId();
        return $this->andWhere([UserToTarifs::tableName().'.id_user' => $id_user]);
    }

    /**
     * {@inheritdoc}
     * @return Projects[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Projects|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
