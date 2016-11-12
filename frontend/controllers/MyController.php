<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 11/10/2016
 * Time: 6:44 AM
 */

namespace frontend\controllers;


use backend\models\Categories;
use backend\models\Menus;
use yii\web\Controller;

class MyController extends Controller
{
    public function beforeAction($action)
    {
        $main_menu_category = Categories::findOne(['category_title' => 'main menu']);
        $menus = Menus::find()->where(['category_id' => $main_menu_category->category_id , 'menu_position' => 'top'])->all();
        $this->view->params['main_menu_top'] = $menus;
        global $main_menu_top;
        $main_menu_top = $menus;
        return parent::beforeAction($action);
    }


}