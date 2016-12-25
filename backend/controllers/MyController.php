<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\RolePerm;
use common\models\User;
use Yii;
use backend\models\Permissions;
use backend\models\PermissionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;




class MyController extends Controller
{

    public function beforeAction($action)
    {
        if (!(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'login') && Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
        }
        return true;
        $id = Yii::$app->user->id;
        if ($id != null) {
            $role = Admin::find()->where(['id' => $id])->one();
            $role = $role['role_id'];
            $query = RolePerm:: find()
                ->select(' * ')
                ->from('role_perm')
                ->leftJoin(' `role` ', ' `role`.`role_id` = `role_perm`.`role_id` ')
                ->leftJoin(' `permissions` ', '`permissions`.`permission_id`=`role_perm`.`permission_id`')
                ->where([' `permissions`.`permission_page` ' => YII::$app->controller->id, ' `permissions`.`permission_action` ' => YII::$app->controller->action->id, ' `role`.`role_id` ' => $role])
                ->all();
            // test the auth
            if ($query) {
                parent::beforeAction($action);
                return true;
            } else {
                throw new ForbiddenHttpException;
            }
        } else {
            throw new ForbiddenHttpException;
        }


    }
}