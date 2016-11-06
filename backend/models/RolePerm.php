<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "role_perm".
 *
 * @property integer $role_perm_id
 * @property integer $role_id
 * @property integer $permission_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 *
 * @property Role $role
 * @property Permissions $permission
 */
class RolePerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_perm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id', 'created_by', 'updated_by'], 'required'],
            [['role_id', 'permission_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'role_id']],
            [['permission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Permissions::className(), 'targetAttribute' => ['permission_id' => 'permission_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_perm_id' => 'Role Perm ID',
            'role_id' => 'Role ID',
            'permission_id' => 'Permission ID',
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
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(Permissions::className(), ['permission_id' => 'permission_id']);
    }
}
