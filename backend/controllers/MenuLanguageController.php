<?php

namespace backend\controllers;

use Yii;
use backend\models\MenuLanguage;
use backend\models\MenuLanguageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuLanguageController implements the CRUD actions for MenuLanguage model.
 */
class MenuLanguageController extends Controller
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
     * Creates a new MenuLanguage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($menu_id)
    {
        $model = new MenuLanguage();
        $model->menu_id = $menu_id;
        if ($model->load(Yii::$app->request->post()))
        {
            $menu = $model->menu;
            if (!$menu->getMenuLanguages()->where(['language_id' => $model->language_id])->all())
            {
                $model->save();
                return $this->redirect(['/menus/view', 'id' => $menu_id]);
            }
            else
            {
                Yii::$app->getSession()->setFlash('error', [
                    'message' => 'Translation to this language already exist',
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing MenuLanguage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['/menu/view', 'id' => $model->menu_id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuLanguage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $menu = $model->menu;
        $model->delete();

        return $this->redirect(['/menus/view', 'id' => $menu->menu_id]);
    }

    /**
     * Finds the MenuLanguage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuLanguage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuLanguage::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
