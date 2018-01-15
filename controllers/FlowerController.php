<?php

namespace app\controllers;

use Yii;
use app\models\Flower;
use app\models\Keyword;
use app\models\FlowerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
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
        $flower = new Flower();
        $keywords = $flower->getKeywords()->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'keywords' => $keywords,
        ]);
    }

    /**
     * Creates a new Flower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $flower = new Flower();
        $keywords = $flower->getKeywords()->all();

        $keywordsId = [];
        $keywordsString = [];

        foreach ($keywords as $key) {
            array_push($keywordsId, $key->id);
            array_push($keywordsString, $key->title);
        }
        
        if ($flower->load(Yii::$app->request->post()) && $flower->save()) {
            foreach (Yii::$app->request->post('keywords') as $keywordTag) {
                $keyword = new keyword();
                $keyword->title = $keywordTag;
                $keyword->save();
                $flower->link('keywords', $keyword);
            }
            return $this->redirect(['view',
             'id' => $flower->id,
             'keywords' => $keywords,
         ]);
        } else {
            return $this->render('create', [
                'model' => $flower,
                'keywordsId' => $keywordsId,
                'keywordsString' => $keywordsString,
            ]);
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
        $keywords = $model->getKeywords()->all();
        $keywordsId = [];
        $keywordsString = [];

        foreach ($keywords as $key) {
            array_push($keywordsId, $key->id);
            array_push($keywordsString, $key->title);
        }
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach (Yii::$app->request->post('keywords') as $keywordTag) {
                $keyword = new keyword();
                $keyword->title = $keywordTag;
                $keyword->save();
                $model->link('keywords', $keyword);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'keywordsId' => $keywordsId,
                'keywordsString' => $keywordsString,
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
