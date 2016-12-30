<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menus".
 *
 * @property integer $menu_id
 * @property integer $parent_id
 * @property integer $category_id
 * @property string $menu_position
 * @property integer $item_id
 * @property string $menu_title
 *
 * @property MenuLanguage[] $menuLanguages
 * @property Menus $parent
 * @property Menus[] $menuses
 * @property Categories $category
 * @property Items $item
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'category_id', 'item_id'], 'integer'],
            [[ 'menu_position', 'menu_title'], 'required'],
            [['menu_position'], 'string'],
            [['menu_title'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::className(), 'targetAttribute' => ['parent_id' => 'menu_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'parent_id' => 'Parent ID',
            'category_id' => 'Category ID',
            'menu_position' => 'Menu Position',
            'item_id' => 'Item ID',
            'menu_title' => 'Menu Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuLanguages()
    {
        return $this->hasMany(MenuLanguage::className(), ['menu_id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menus::className(), ['menu_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuses()
    {
        return $this->hasMany(Menus::className(), ['parent_id' => 'menu_id']);
    }

    public function haveChilds()
    {
        return sizeof($this->getMenuses()->all())>0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }
}
