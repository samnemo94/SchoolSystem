<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item_language".
 *
 * @property integer $item_language_id
 * @property integer $item_id
 * @property integer $language_id
 * @property string $item_title
 * @property string $item_description
 * @property string $item_short_description
 * @property string $item_image
 *
 * @property Items $item
 * @property Languages $language
 */
class ItemLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_image'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['item_id', 'language_id', 'item_title'], 'required'],
            [['item_id', 'language_id'], 'integer'],
            [['item_description', 'item_short_description'], 'string'],
            [['item_title'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_language_id' => 'Item Language ID',
            'item_id' => 'Item ID',
            'language_id' => 'Language ID',
            'item_title' => 'Item Title',
            'item_description' => 'Item Description',
            'item_short_description' => 'Item Short Description',
            'item_image' => 'Item Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['language_id' => 'language_id']);
    }
}
