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
        $lang_id = Languages::findOne(['language_code' => \Yii::$app->language])->language_id;

        $menus = Menus::find()->where(['menu_position' => 'top','parent_id' => NULL])->all();

        global $main_menu_top;
        $main_menu_top = [];
        foreach ($menus as $menu)
        {
            $main_menu_top [] = $this->generateMenuItem($menu->menu_id);
        }

//        var_dump($main_menu_top);
//        die();
        return parent::beforeAction($action);
    }

    private function generateMenuItem($id)
    {
        $lang_id = Languages::findOne(['language_code' => \Yii::$app->language])->language_id;
        $menu = Menus::findOne(['menu_id' => $id]);
        $item = [];
        $item['id'] = $menu->menu_id;
        $item['hasChild'] = $menu->haveChilds();
        $item['title'] = $menu->menu_title;
        $menu_translate = $menu->getMenuLanguages()->where(['language_id' => $lang_id])->one();
        if ($menu_translate)
            $item['title'] = $menu_translate->title;
        if ($menu->haveChilds())
        {
            $item['children'] = [];
            foreach ($menu->getMenuses()->all() as $subMenu)
            {
                $item['children'][] = $this->generateMenuItem($subMenu->menu_id);
            }
        }
        return $item;
    }

}