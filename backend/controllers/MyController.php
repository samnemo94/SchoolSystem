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
use backend\models\Items;
use backend\models\Categories;

class MyController extends Controller
{

    public function beforeAction($action)
    {
        if (!(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'login') && Yii::$app->user->isGuest)
        {
            $this->redirect(['site/login']);
        }
        return true;
        $id = Yii::$app->user->id;
        if ($id != null)
        {
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
            if ($query)
            {
                parent::beforeAction($action);
                return true;
            }
            else
            {
                throw new ForbiddenHttpException;
            }
        }
        else
        {
            throw new ForbiddenHttpException;
        }


    }



    public static function getItemInfo($item_id, $lang_id)
    {
        $item = Items::findOne(['item_id' => $item_id]);
        $cat = Categories::findOne(["category_id" => $item->category_id]);
        $res = [];
        $res['item_id'] = $item_id;
        foreach ($cat->fields as $field)
        {
            $res[$field->field_title]['field_type'] = $field->field_type;
            $res[$field->field_title]['fk_table'] = $field->fk_table;
            $res[$field->field_title]['field_id'] = $field->field_id;


            $value = $field->has_translate ? $item->getValues()->where(['language_id' => $lang_id, 'field_id' => $field->field_id])->one() : $item->getValues()->where(['field_id' => $field->field_id])->one();
            $value = $value ? $value->value : '';
//            if ($value && $value != '' && $field->field_type == 'foreign_key')
//            {
//                $foreign_item = Items::findOne(['item_id' => $value]);
//                if ($foreign_item)
//                {
//                    $foreign_cat = $foreign_item->category_id;
//                    $foreign_field = Fields::findOne(['category_id' => $foreign_cat, 'field_title' => 'title']);
//                    if ($foreign_field)
//                    {
//                        $foreign_value = Values::findOne(['language_id' => $lang_id, 'field_id' => $foreign_field->field_id, 'item_id' => $foreign_item->item_id]);
//                        if ($foreign_value)
//                            $value = $foreign_value->value;
//                    }
//                }
//            }
            $res[$field->field_title]['value'] = $value;
        }
        return $res;
    }
}