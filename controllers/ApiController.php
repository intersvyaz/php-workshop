<?php
namespace app\controllers;

use app\models\SaveEvent;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * @return SaveEvent
     */
    public function actionIndex()
    {
        $model = new SaveEvent();
        $model->load(Yii::$app->request->bodyParams, '');

        return $model->save();
    }
}
