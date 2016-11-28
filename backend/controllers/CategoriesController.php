<?php

namespace backend\controllers;

use backend\models\Fields;
use backend\models\Items;
use backend\models\Languages;
use backend\models\Values;
use Yii;
use backend\models\Categories;
use backend\models\CategoriesSearch;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;


/**
 * CategoriesController implements the CRUD actions for categories model.
 */
class CategoriesController extends MyController
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
     * Lists all categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();
        $model->created_by = Yii::$app->user->id;
        $model->created_at = date('Y-m-d H:i:s');
        $modelsFields = [new Fields ];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelsFields = Model::createMultiple(Fields::classname());
            Model::loadMultiple($modelsFields, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsFields) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsFields as $modelFields) {
                            $modelFields->category_id = $model->category_id;
                            if (! ($flag = $modelFields->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsFields' => (empty($modelsFields)) ? [new Fields] : $modelsFields,
                //'fields_model' => $fields_model,
            ]);
        }
    }

    /**
     * Updates an existing categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsFields = $model->fields;

        if ($model->load(Yii::$app->request->post()) ) {
            $oldIDs = ArrayHelper::map($modelsFields, 'field_id', 'field_id');
            $modelsFields = Model::createMultiple(Fields::classname(), $modelsFields);
            Model::loadMultiple($modelsFields, Yii::$app->request->post());
           $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsFields, 'field_id', 'field_id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsFields) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Fields::deleteAll(['field_id' => $deletedIDs]);
                        }
                        foreach ($modelsFields as $modelFields) {
                            $modelFields->category_id = $model->category_id;
                            if (! ($flag = $modelFields->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        $model->updated_at = date('Y-m-d H:i:s');
                        $model->updated_by = Yii::$app->user->id;
                        $model->save(false);
                        $dataFields = Fields::find()->where(['category_id'=>$id])->all();
                        $dataItems = Items::find()->where(['category_id'=>$id])->all();
                        return $this->render('view',['model' => $model,'dataItems'=>$dataItems,'dataFields'=>$dataFields]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else {
            return $this->render('update', [
                'model' => $model,
                'modelsFields' => (empty($modelsFields)) ? [new Fields] : $modelsFields
            ]);
        }
    }

    /**
     * Deletes an existing categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model =  $this->findModel($id);
        $model->deleted = 1;
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Yii::$app->user->id;
        $model->save(false);
        return $this->redirect(['index']);
    }

    public function actionView($id){
        $model = $this->findModel($id);
      $dataFields = Fields::find()->where(['category_id'=>$id])->all();
      $dataItems = Items::find()->where(['category_id'=>$id])->all();
        return $this->render('view',['model' => $model,'dataItems'=>$dataItems,'dataFields'=>$dataFields]);
    }


    public function actionInsert($id){
        $model = $this->findModel($id);
        $items  = Items::find()->where(['category_id'=>$id])->all();
            $dataProvider = new ActiveDataProvider([
                'query' => Fields::find()->where(['category_id' => $id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            $fields = Fields::find()->where(['category_id' => $id])->all();
            foreach ($fields as $field1) {
                if ($field1['field_type'] == 'foreign_key') {
                    $fk = $field1['fk_table'];
                    $items = Items::find()->where(['category_id' => $fk])->all();
                }
            }
        if (!empty($_POST)) {
            $item = new Items();
            $item->category_id = $id;
            $item->created_at = date('Y-m-d H:i:s');
            $item->created_by = Yii::$app->user->id;
            $item->save(false);
            foreach ($fields as $field) {
                $post = $field['field_title'];
                if (!empty($_POST[$post]) || !empty($_FILES[$post])) {
                    switch ($field['field_type']) {
                        case 'image' :
                            echo $_FILES[$post]["name"];
                            $val = new Values();
                            $val->item_id = $item->item_id;
                            $val->field_id = $field['field_id'];
                            $val->language_id = 8;
                            $imagename = $_FILES[$post]["name"];
                            $folder = "../../common/web/uploads/";
                            $new_name = time().$imagename;
                            move_uploaded_file($_FILES[$post]["tmp_name"], $folder.$new_name);
                            $val->value = $folder.$new_name;
                            $val->save(false);
                            break;
                        case 'file':
                            $val = new Values();
                            $val->item_id = $item->item_id;
                            $val->field_id = $field['field_id'];
                            $val->language_id = Languages::find()->one()->language_id;
                            $filename = $_FILES[$post]["name"];
                            $folder = "../../common/web/uploads/";
                            $new_name = time().$filename;
                            move_uploaded_file($_FILES[$post]["tmp_name"], "$folder" .$new_name);
                            $val->value = $folder.$new_name;
                            $val->save(false);
                            break;
                        default :
                            $val = new Values();
                            $val->item_id = $item->item_id;
                            $val->field_id = $field['field_id'];
                            $val->language_id = Languages::find()->one()->language_id;
                            $val->value = $_POST[$post];
                            $val->save(false);
                    }
                }
            }
            $dataFields = Fields::find()->where(['category_id'=>$id])->all();
            $dataItems = Items::find()->where(['category_id'=>$id])->all();
            return $this->render('view',['model' => $model,'dataItems'=>$dataItems,'dataFields'=>$dataFields]);
        }
        else
       return $this->render('insert',['fields'=> $fields,'id'=>$id,'items'=>$items]);
    }

    public function actionUpdateRow($id,$id2){
        $item =$this->findItem($id);
        $fields = Fields::find()->where(['category_id'=>$item['category_id']])->all();
        foreach ($fields as $field1){
            if ($field1['field_type'] == 'foreign_key' )
            {
                $fk = $field1['fk_table'];
                $items  = Items::find()->where(['category_id'=>$fk])->all();
            }
            else $items = Null;
        }

        $values  = Values::find()->leftJoin('`fields`','`fields`.`field_id`=`values`.`field_id`')
        ->where(['item_id'=>$id])->all();
        if (!empty($_POST)){
            foreach ($values as $value) {
                $field = Fields::find()->where(['field_id' => $value['field_id']])->one();
                $type = $field['field_type'];
                $post = $field['field_title'];
                if (!empty($_POST[$post]) || !empty($_FILES[$post])) {
                    switch ($type) {
                        case 'image' :
                            $imagename = $_FILES[$post]["name"];
                            $folder = "/xampp/htdocs/SchoolSystem/backend/web/img/uploads/";
                            move_uploaded_file($_FILES[$post]["tmp_name"], "$folder" . $_FILES[$post]["name"]);
                            $value->value = $imagename;
                            $value->save(false);
                            break;
                        case 'file':
                            $filename = $_FILES[$post]["name"];
                            $folder = "/xampp/htdocs/SchoolSystem/backend/web/files/uploads/";
                            move_uploaded_file($_FILES[$post]["tmp_name"], "$folder" . $_FILES[$post]["name"]);
                            $value->value = $filename;
                            $value->save(false);
                            break;
                        default :
                            $value->value = $_POST[$post];
                            $value->save(false);
                    }
                }
            }
            $item->updated_at = date('Y-m-d H:i:s');
            $item->updated_by = Yii::$app->user->id;
            $item->save(false);
            $model = $this->findModel($id2);
            $dataFields = Fields::find()->where(['category_id'=>$id2])->all();
            $dataItems = Items::find()->where(['category_id'=>$id2])->all();
            return $this->render('view',['model' => $model,'dataItems'=>$dataItems,'dataFields'=>$dataFields]);
        }
        else
        return $this->render('update-row',['values'=>$values,'id'=>$id,'fields'=>$fields,'items'=>$items,'id2'=>$id2]);
    }

    public function actionDeleteRow($id){
        $item =  $this->findItem($id);
        $item->deleted = 1;
        $item->deleted_at = date('Y-m-d H:i:s');
        $item->deleted_by = Yii::$app->user->id;
        $item->save(false);
        $id2 = Categories::find()->where(['category_id'=>$item['category_id']])->one();
        $id2 = $id2['category_id'];
        $model = $this->findModel($id2);
        $dataFields = Fields::find()->where(['category_id'=>$id2])->all();
        $dataItems = Items::find()->where(['category_id'=>$id2])->all();
        return $this->render('view',['model' => $model,'dataItems'=>$dataItems,'dataFields'=>$dataFields]);

    }


    /**
     * Finds the categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findItem($id){
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
