<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fields".
 *
 * @property integer $field_id
 * @property string $field_title
 * @property integer $category_id
 * @property string $field_type
 * @property string $fk_table
 * @property integer $has_translate
 *
 * @property Categories $category
 * @property Values[] $values
 */
class Fields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_title', 'category_id', 'field_type', 'fk_table', 'has_translate'], 'required'],
            [['category_id', 'has_translate'], 'integer'],
            [['field_type'], 'string'],
            [['field_title', 'fk_table','field_title_ar'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'field_id' => 'Field ID',
            'field_title' => 'Field Title',
            'field_title_ar'=> 'Field Title Arabic',
            'category_id' => 'Category ID',
            'field_type' => 'Field Type',
            'fk_table' => 'Fk Table',
            'has_translate' => 'Has Translate',
        ];
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
    public function getValues()
    {
        return $this->hasMany(Values::className(), ['field_id' => 'field_id']);
    }
}
