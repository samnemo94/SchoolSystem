<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 11/10/2016
 * Time: 6:44 AM
 */

namespace frontend\controllers;

use yii;
use backend\models\Categories;
use backend\models\Items;
use backend\models\Languages;
use backend\models\Menus;
use common\models\Fields;
use common\models\Values;
use yii\web\Controller;
use common\models\User;

class MyController extends Controller
{
    public function beforeAction($action)
    {
        $lang_id = Languages::findOne(['language_code' => \Yii::$app->language])->language_id;

        $menus = Menus::find()->where(['menu_position' => 'top', 'parent_id' => NULL])->all();

        global $main_menu_top;
        $main_menu_top = [];
        foreach ($menus as $menu)
        {
            $main_menu_top [] = $this->generateMenuItem($menu->menu_id);
        }

        $id = yii::$app->getUser()->id;
        $role = User::roleFind($id);
        switch ($role){
            case 1:
                $left_menus = Menus::find()->where(['menu_position' => 'left', 'parent_id' => NULL,'menu_for'=>'Admin'])->all();
                global $main_menu_left;
                $main_menu_left = [];
                foreach ($left_menus as $menu)
                {
                    $main_menu_left [] = $this->generateMenuItem($menu->menu_id);
                }
                break;
            case 2:
                $left_menus = Menus::find()->where(['menu_position' => 'left', 'parent_id' => NULL,'menu_for'=>'Student'])->all();
                global $main_menu_left;
                $main_menu_left = [];
                foreach ($left_menus as $menu)
                {
                    $main_menu_left [] = $this->generateMenuItem($menu->menu_id);
                }
                break;
            case 3:
                $left_menus = Menus::find()->where(['menu_position' => 'left', 'parent_id' => NULL,'menu_for'=>'Teacher'])->all();
                global $main_menu_left;
                $main_menu_left = [];
                foreach ($left_menus as $menu)
                {
                    $main_menu_left [] = $this->generateMenuItem($menu->menu_id);
                }
                break;
            default :
                $left_menus = Menus::find()->where(['menu_position' => 'left', 'parent_id' => NULL,'menu_for'=>'Null'])->all();
                global $main_menu_left;
                $main_menu_left = [];
                foreach ($left_menus as $menu)
                {
                    $main_menu_left [] = $this->generateMenuItem($menu->menu_id);
                }
                break;

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
        $item['is_private'] = $menu->is_private;
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

    /**
     * @param $category_id
     * @param $filters
     * @param $lang_id
     * @return array
     */
    public static function getFilteredItems($category_id, $filters, $lang_id)
    {
        $items = Items::findAll(['category_id' => $category_id, 'deleted' => '0']);

        $res = [];
        foreach ($items as $item)
        {
            $info = MyController::getItemInfo($item->item_id, $lang_id);
            $valid = true;
            foreach ($filters as $key => $value)
            {
                if (array_key_exists($key, $info))
                {
                    if (strcmp($info[$key]['value'], $value) != 0)
                    {
                        $valid = false;
                        break;
                    }
                }
                else
                {
                    $valid = false;
                    break;
                }
            }
            if ($valid)
                $res[] = $info;
        }
        return $res;
    }

}