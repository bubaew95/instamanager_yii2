<?php

namespace common\modules\shops\modules\v1\controllers;

use common\components\constants\Constants;
use common\models\shops\Shops;
use Yandex\Market\Content\Models\Shop;
use Yii;
use common\models\menu\Menu;
use common\modules\shops\modules\common\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use function GuzzleHttp\Promise\queue;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    private function shopId() : ?int
    {
        return Shops::find()->shopId(Constants::getProjectId());
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $searchModel->my_meny = $this->shopId();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $shop_id = $this->shopId();
        $model = new Menu();
        if ( ! empty(Yii::$app->request->post('Menu'))) {
            $post            = Yii::$app->request->post('Menu');
            $model->id_shop  = $shop_id;
            $model->icon     = $post['icon'];
            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if (empty($parent_id)) {
                $result = $model->makeRoot();
            } else {
                $parent = Menu::findOne($parent_id);
                $result = $model->appendTo($parent);
            }
            if($result){
                return $this->redirect(['/shops/menu']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ( ! empty(Yii::$app->request->post('Menu')))
        {
            $post            = Yii::$app->request->post('Menu');
            $model->icon     = $post['icon'];
            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if ($model->save())
            {
                if (empty($parent_id))
                {
                    if ( ! $model->isRoot())
                        $model->makeRoot();
                }
                else // move node to other root
                {
                    if ($model->id != $parent_id)
                    {
                        $parent = Menu::findOne($parent_id);
                        $model->appendTo($parent);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->isRoot())
            $model->deleteWithChildren();
        else
            $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
