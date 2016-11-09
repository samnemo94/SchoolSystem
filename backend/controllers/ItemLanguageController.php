<?php

namespace backend\controllers;

use Yii;
use backend\models\ItemLanguage;
use backend\models\ItemLanguageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ItemLanguageController implements the CRUD actions for ItemLanguage model.
 */
class ItemLanguageController extends MyController
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
     * Displays a single ItemLanguage model.
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
     * Creates a new ItemLanguage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($item_id)
    {
        $model = new ItemLanguage();
        $model->item_id = $item_id;
        if ($model->load(Yii::$app->request->post()))
        {
            $item = $model->item;
            if (!$item->getItemLanguages()->where(['language_id' => $model->language_id])->all())
            {
                $model->item_image = UploadedFile::getInstance($model, 'item_image');
                $extension = $model->item_image->extension;
                $name = 'items_photos/' . $model->item_language_id . strtotime("now") . '.' . $extension;
                $model->item_image->saveAs($name);
                $model->item_image = $name;
                $model->save();
                return $this->redirect(['/items/view', 'id' => $item_id]);
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
     * Updates an existing ItemLanguage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $old_photo = $model->item_image;
        if ($model->load(Yii::$app->request->post()))
        {
            $name = '';
            $upload_image = UploadedFile::getInstance($model, 'item_image');
            if (!empty($upload_image))
            {
                if (file_exists($old_photo))
                {
                    unlink($old_photo);
                }
                $extension = $upload_image->extension;
                $name = 'items_photos/' . $model->item_language_id . strtotime("now") . '.' . $extension;
                $model->item_image = $name;
            }

            if ($model->save())
            {
                $upload_image->saveAs($name);
            };
            return $this->redirect(['view', 'id' => $model->item_language_id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ItemLanguage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $item = $model->item;
        $model->delete();

        return $this->redirect(['/items/view', 'id' => $item->item_id]);
    }

    /**
     * Finds the ItemLanguage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemLanguage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemLanguage::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
