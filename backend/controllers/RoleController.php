<?php

namespace backend\controllers;

use backend\models\Permissions;
use backend\models\RolePerm;
use Yii;
use backend\models\Role;
use backend\models\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\PermissionsSearch;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;


/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dataProvider = Permissions::find()->all();
        $res = [];
        foreach ($dataProvider as $data)
        {
            $res[$data['permission_page']][] = $data;
        }
        $checked = RolePerm::find()->where(['role_id' => $model->role_id])->all();
        $checked = ArrayHelper::map($checked, 'permission_id', 'permission_id');

        return $this->render('view', [
            'model' => $model,
            'checked' => $checked,
            'dataProvider' => $res,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataProvider = Permissions::find()->all();
        $res = [];
        foreach ($dataProvider as $data)
        {
            $res[$data['permission_page']][] = $data;
        }

        $model = new Role();
        $model->created_by = Yii::$app->user->id;
        $model->updated_by = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            foreach ($_POST['check_list'] as $row_id)
            {
                $assign = new RolePerm();
                $assign->created_by = Yii::$app->user->id;
                $assign->updated_by = Yii::$app->user->id;
                $assign->role_id = $model->role_id;
                $assign->permission_id = $row_id;
                $assign->save();
            }
            return $this->redirect(['view', 'id' => $model->role_id]);
        }
        else
        {
            $checked = RolePerm::find()->where(['role_id' => $model->role_id])->all();
            $checked = ArrayHelper::map($checked, 'permission_id', 'permission_id');
            return $this->render('create', [
                'model' => $model,
                'checked' => $checked,
                'dataProvider' => $res,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataProvider = Permissions::find()->all();
        $res = [];
        foreach ($dataProvider as $data)
        {
            $res[$data['permission_page']][] = $data;
        }
        $checked = RolePerm::find()->where(['role_id' => $model->role_id])->all();
        $checked = ArrayHelper::map($checked, 'permission_id', 'permission_id');

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            foreach ($_POST['check_list'] as $row_id)
            {
                if (!in_array($row_id, $checked))
                {
                    $assign = new RolePerm();
                    $assign->created_by = 1;
                    $assign->updated_by = 1;
                    $assign->role_id = $model->role_id;
                    $assign->permission_id = $row_id;
                    $assign->save();
                }
            }
            foreach ($checked as $check)
            {
                if (!in_array($check, $_POST['check_list']))
                {
                    $deleted = RolePerm::find()->where(['role_id' => $model->role_id, 'permission_id' => $check])->one();
                    $deleted->delete();
                }
            }


            return $this->redirect(['view', 'id' => $model->role_id]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
                'checked' => $checked,
                'dataProvider' => $res,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
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
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
