<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $language_id
 * @property string $language_name
 *
 * @property ItemLanguage[] $itemLanguages
 * @property MenuLanguage[] $menuLanguages
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_name'], 'required'],
            [['language_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'language_id' => 'Language ID',
            'language_name' => 'Language Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemLanguages()
    {
        return $this->hasMany(ItemLanguage::className(), ['language_id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuLanguages()
    {
        return $this->hasMany(MenuLanguage::className(), ['language_id' => 'language_id']);
    }
}
