<?php

namespace backend\controllers;

use backend\models\Fields;
use backend\models\Items;
use backend\models\Languages;
use backend\models\Values;
use Yii;
use backend\models\Categories;
use backend\models\CategoriesSearch;
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
        $modelsFields = [new Fields];
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $modelsFields = Model::createMultiple(Fields::classname());
            Model::loadMultiple($modelsFields, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsFields) && $valid;

            if ($valid)
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try
                {
                    if ($flag = $model->save(false))
                    {
                        foreach ($modelsFields as $modelFields)
                        {
                            $modelFields->category_id = $model->category_id;
                            if (!($flag = $modelFields->save(false)))
                            {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag)
                    {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e)
                {
                    $transaction->rollBack();
                }
            }
        }
        else
        {
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

        if ($model->load(Yii::$app->request->post()))
        {
            $oldIDs = ArrayHelper::map($modelsFields, 'field_id', 'field_id');

            $modelsFieldsNew = Model::createMultiple(Fields::classname(), $modelsFields);
            Model::loadMultiple($modelsFieldsNew, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsFieldsNew, 'field_id', 'field_id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsFieldsNew) && $valid;

            if ($valid)
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try
                {
                    if ($flag = $model->save(false))
                    {
                        if (!empty($deletedIDs))
                        {
                            Fields::deleteAll(['field_id' => $deletedIDs]);
                        }
                        foreach ($modelsFieldsNew as $modelFields)
                        {
                            $modelFields->category_id = $model->category_id;

                            if (!($flag = $modelFields->save(false)))
                            {
                                $transaction->rollBack();
                                break;
                            }
                            $oldId = '';
                            foreach ($modelsFields as $mod)
                            {
                                if ($mod->field_title == $modelFields->field_title)
                                {
                                    $oldId = $mod->field_id;
                                    break;
                                }
                            }
                            Values::updateAll(['field_id'=>$modelFields->field_id],['field_id'=>"$oldId"]);
                        }
                    }
                    if ($flag)
                    {
                        $transaction->commit();
                        $model->updated_at = date('Y-m-d H:i:s');
                        $model->updated_by = Yii::$app->user->id;
                        $model->save(false);
                        return $this->redirect(['view', 'id' => $id]);
                    }
                } catch (Exception $e)
                {
                    $transaction->rollBack();
                }
            }
        }
        else
        {
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
        $model = $this->findModel($id);
        $model->deleted = 1;
        $model->deleted_at = date('Y-m-d H:i:s');
        $model->deleted_by = Yii::$app->user->id;
        $model->save(false);
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {

        $model = $this->findModel($id);
        $dataFields = Fields::find()->where(['category_id' => $id])->all();
        $dataItems = Items::find()->where(['category_id' => $id])->all();
        return $this->render('view', [
            'model' => $model,
            'dataItems' => $dataItems,
            'dataFields' => $dataFields,
            'langs' => Languages::find()->all()
        ]);
    }


    public function actionInsert($id)
    {
        $fields = Fields::find()->where(['category_id' => $id])->all();
        $items =[];
        foreach ($fields as $field1)
        {
            if ($field1['field_type'] == 'foreign_key')
            {
                $fk = $field1['fk_table'];
                $items[$field1->fk_table] = Items::find()->where(['category_id' => $fk])->all();
            }

        }
        if (!empty($_POST))
        {
            $item = new Items();
            $item->category_id = $id;
            $item->created_at = date('Y-m-d H:i:s');
            $item->created_by = Yii::$app->user->id;
            $item->save(false);
            $langs = Languages::find()->all();
            $language_code = array();
            foreach ($langs as $lang)
            {
                array_push($language_code, $lang['language_code']);
            }
            array_push($language_code, "");
            foreach ($language_code as $lang)
            {
                foreach ($fields as $field)
                {
                    $post = $field['field_title'] . $lang;
                    if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                    {
                        $val = new Values();
                        $val->item_id = $item->item_id;
                        $val->field_id = $field['field_id'];
                        if ($lang != "")
                        {
                            $langsID = Languages::find()->where(['language_code' => $lang])->one();
                            $val->language_id = $langsID ? $langsID['language_id'] : null;
                        }
                        else
                        {
                            $val->language_id = null;
                        }
                        switch ($field['field_type'])
                        {
                            case 'image' :
                                $imagename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $imagename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                $val->save(false);
                                break;
                            case 'file':
                                $filename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $filename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                $val->save(false);
                                break;
                            default :
                                $val->value = $_POST[$post];
                                $val->save(false);
                        }
                    }
                }
            }

            return $this->redirect(['view', 'id' => $id]);
        }

        else
            return $this->render('insert', [
                'fields' => $fields,
                'id' => $id,
                'items' => $items,
                'langs' => Languages::find()->all(),
            ]);
    }






    public function actionUpdateRow($id)
    {
        $item = $this->findItem($id);

        $fields = Fields::find()->where(['category_id' => $item['category_id']])->all();
        $items =[];
        foreach ($fields as $field1)
        {
            if ($field1['field_type'] == 'foreign_key')
            {
                $fk = $field1['fk_table'];
                $items[$fk] = Items::find()->where(['category_id' => $fk])->all();
            }
        }

        if (!empty($_POST))
        {
            $langs = Languages::find()->all();
            foreach ($fields as $field)
            {
                if ($field->has_translate)
                {
                    foreach ($langs as $lang)
                    {
                        $post = $field['field_title'] . $lang->language_code;
                        if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                        {
                            $val = Values::findOne(['field_id'=>$field->field_id,'item_id'=>$item->item_id,'language_id'=>$lang->language_id]);
                            if (!$val)
                            {
                                $val = new Values();
                                $val->item_id = $item->item_id;
                                $val->field_id = $field['field_id'];
                                $val->language_id = $lang->language_id;
                            }
                            switch ($field['field_type'])
                            {
                                case 'image' :
                                    if ($_FILES[$post]["name"] != '')
                                    {
                                        $imagename = $_FILES[$post]["name"];
                                        $folder = "../../common/web/uploads/";
                                        $new_name = time() . $imagename;
                                        move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                        $val->value = $folder . $new_name;
                                    }
                                    break;
                                case 'file':
                                    if ($_FILES[$post]["name"] != '')
                                    {
                                        $filename = $_FILES[$post]["name"];
                                        $folder = "../../common/web/uploads/";
                                        $new_name = time() . $filename;
                                        move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                        $val->value = $folder . $new_name;
                                    }
                                    break;
                                default :
                                    $val->value = $_POST[$post];
                            }
                            $val->save(false);
                        }
                    }
                }
                else
                {
                    $post = $field['field_title'];
                    if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                    {
                        $val = Values::findOne(['field_id'=>$field->field_id,'item_id'=>$item->item_id]);
                        if (!$val)
                        {
                            $val = new Values();
                            $val->item_id = $item->item_id;
                            $val->field_id = $field['field_id'];
                            $val->language_id = null;
                        }
                        switch ($field['field_type'])
                        {
                            case 'image' :
                                if ($_FILES[$post]["name"] != '')
                                {
                                    $imagename = $_FILES[$post]["name"];
                                    $folder = "../../common/web/uploads/";
                                    $new_name = time() . $imagename;
                                    move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                    $val->value = $folder . $new_name;
                                }
                                break;
                            case 'file':

                                if ($_FILES[$post]["name"] != '')
                                {
                                    $filename = $_FILES[$post]["name"];
                                    $folder = "../../common/web/uploads/";
                                    $new_name = time() . $filename;
                                    move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                    $val->value = $folder . $new_name;
                                }
                                break;
                            default :
                                $val->value = $_POST[$post];
                        }
                        $val->save(false);
                    }
                }
            }

            return $this->redirect(['view', 'id' => $item->category_id]);
        }
        else
        {
            $langs = Languages::find()->all();
            $values = $item->getValues()->all();
            $values_all = [];
            foreach ($fields as $field)
            {
                if ($field->has_translate)
                {
                    foreach ($langs as $lang)
                    {
                        $values_all[$field->field_id][$lang->language_code] = '';
                    }
                }
                else
                {
                    $values_all[$field->field_id]['0'] = '';
                }
            }
            foreach ($values as $value)
            {
                $values_all[$value->field_id][$value->getLanguage()->one() ? $value->getLanguage()->one()->language_code : '0'] = $value->value;
            }
            return $this->render('update-row', [
                'values' => $values_all,
                'id' => $id,
                'fields' => $fields,
                'id' => $id,
                'items' => $items,
                'langs' =>$langs
            ]);
        }
    }

    public function actionDeleteRow($id)
    {
        $item = $this->findItem($id);
        $item->deleted = 1;
        $item->deleted_at = date('Y-m-d H:i:s');
        $item->deleted_by = Yii::$app->user->id;
        $item->save(false);
        $this->redirect(['view', 'id' => $item['category_id']]);
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
        if (($model = Categories::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findItem($id)
    {
        if (($model = Items::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
