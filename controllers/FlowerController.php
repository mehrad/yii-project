<?php

namespace app\controllers;

use Yii;
use app\models\Flower;
use app\models\Keyword;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\FlowerSearch;
use yii\web\NotFoundHttpException;
/**
 * FlowerController implements the CRUD actions for Flower model.
 */
class FlowerController extends Controller
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

    /**
     * Lists all Flower models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FlowerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Flower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionCreate()
    {

        $flower = new Flower();
        if ($flower->load(Yii::$app->request->post()) && $flower->save()) {
            return $this->redirect(['view', 'id' => $flower->id]);
        } else {
            return $this->render('create', ['model' => $flower]);
        }
    }

    /**
     * Updates an existing Flower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Flower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionDeleteimage($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception("DUFUQ NOT AjAX?!");
        }
        return $this->findModel($id)->deleteFile();
    }

    /**
     * Finds the Flower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Flower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flower::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
