<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $category_title
 *
 * @property Categories $parent
 * @property Categories[] $categories
 * @property Items[] $items
 * @property Menus[] $menuses
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_title','showing_parent'], 'required'],
            [['parent_id','showing_parent'], 'integer'],
            [['category_title','category_text','category_text_ar','category_icon'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['parent_id' => 'category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'parent_id' => 'Parent ID',
            'category_title' => 'Category Title',
            'category_text' => 'Category Text',
            'category_text_ar' => 'Category Text Ar',
            'category_icon' => 'Category Icon',
            'showing_parent' =>'Showing Parent',
        ];
    }

    public function beforeSave($insert)
    {
        $this->updated_at = date('Y-m-d h:i:s',time());
        $this->updated_by = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['parent_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['category_id' => 'category_id']);
    }

    public function getFields()
    {
        return $this->hasMany(Fields::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuses()
    {
        return $this->hasMany(Menus::className(), ['category_id' => 'category_id']);
    }
}
