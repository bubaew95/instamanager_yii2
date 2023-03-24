<?php

namespace common\models\modules;

/**
 * This is the ActiveQuery class for [[Modules]].
 *
 * @see Modules
 */
class ModulesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function userConnectModuleIds(int $id_project) : array
    {
        return $this->innerJoinWith('userModules')
            ->select([Modules::tableName() . '.id'])
            ->where(['id_project' => (int) $id_project])
            ->column();
    }

    public function isConnectModules($ids) : array
    {
        return $this->andWhere(['in', Modules::tableName() . '.id', $ids])->all();
    }

    public function notConnectModule($ids) : array
    {
        return $this->andWhere(['not in', Modules::tableName() . '.id', $ids])->all();
    }

    /**
     * {@inheritdoc}
     * @return Modules[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Modules|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
