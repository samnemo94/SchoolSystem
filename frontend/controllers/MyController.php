<?php
/**
 * Created by PhpStorm.
 * User: like-
 * Date: 11/10/2016
 * Time: 6:44 AM
 */

namespace frontend\controllers;


use backend\models\Categories;
use backend\models\Items;
use backend\models\Languages;
use backend\models\Menus;
use common\models\Fields;
use common\models\Values;
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

    public function getItemInfo($item_id,$lang_id)
    {
        $item = Items::findOne(['item_id' => $item_id]);
        $cat = Categories::findOne(["category_id" => $item->category_id]);
        $res = [];
        $res['item_id'] = $item_id;
        foreach ($cat->fields as $field)
        {
            $res[$field->field_title]['field_type'] = $field->field_type;
            $res[$field->field_title]['fk_table'] = $field->fk_table;

            $value = $field->has_translate ? $item->getValues()->where(['language_id' => $lang_id, 'field_id' => $field->field_id])->one() : $item->getValues()->where(['field_id' => $field->field_id])->one();
            $value = $value ? $value->value : '';
            if ($value && $value != '' && $field->field_type == 'foreign_key')
            {
                $foreign_item = Items::findOne(['item_id' => $value]);
                if ($foreign_item)
                {
                    $foreign_cat = $foreign_item->category_id;
                    $foreign_field = Fields::findOne(['category_id' => $foreign_cat, 'field_title' => 'title']);
                    if ($foreign_field)
                    {
                        $foreign_value = Values::findOne(['language_id' => $lang_id, 'field_id' => $foreign_field->field_id, 'item_id' => $foreign_item->item_id]);
                        if ($foreign_value)
                            $value = $foreign_value->value;
                    }
                }
            }
            $res[$field->field_title]['value'] = $value;
        }
        return $res;
    }

}