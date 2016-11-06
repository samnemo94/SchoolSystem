<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "permissions".
 *
 * @property integer $permission_id
 * @property string $permission_page
 * @property string $permission_action
 * @property string $permission_description
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 *
 * @property RolePerm[] $rolePerms
 */
class Permissions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission_page', 'permission_action', 'permission_description', 'created_by', 'updated_by'], 'required'],
            [['permission_description'], 'string'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['permission_page', 'permission_action'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permission_id' => 'Permission ID',
            'permission_page' => 'Permission Page',
            'permission_action' => 'Permission Action',
            'permission_description' => 'Permission Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolePerms()
    {
        return $this->hasMany(RolePerm::className(), ['permission_id' => 'permission_id']);
    }
}
