<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 11/10/2016
 * Time: 6:44 AM
 */

namespace frontend\controllers;


use backend\models\Categories;
use backend\models\Languages;
use backend\models\Menus;
use yii\web\Controller;

class MyController extends Controller
{
    public function beforeAction($action)
    {
        $lang_id = Languages::findOne(['language_code'=>\Yii::$app->language])->language_id;
        $main_menu_category = Categories::findOne(['category_title' => 'main menu']);
        $menus = Menus::find()->where(['category_id' => $main_menu_category->category_id , 'menu_position' => 'top'])->all();
        $res = [];
        foreach ($menus as $menu)
        {
            $menu->menu_title = $menu->getMenuLanguages()->where(['language_id'=>$lang_id])->one()->title;
        }
        global $main_menu_top;
        $main_menu_top = $menus;

//        var_dump($main_menu_top);
//        die();
        return parent::beforeAction($action);
    }


}