<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_language".
 *
 * @property integer $menu_language_id
 * @property integer $menu_id
 * @property integer $language_id
 * @property string $title
 *
 * @property Menus $menu
 * @property Languages $language
 */
class MenuLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'language_id', 'title'], 'required'],
            [['menu_id', 'language_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::className(), 'targetAttribute' => ['menu_id' => 'menu_id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_language_id' => 'Menu Language ID',
            'menu_id' => 'Menu ID',
            'language_id' => 'Language ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::className(), ['menu_id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['language_id' => 'language_id']);
    }
}
