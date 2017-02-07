<?php
namespace frontend\models;

use backend\models\Role;
use common\models\Categories;
use common\models\Fields;
use common\models\Items;
use common\models\Values;
use yii\base\Model;
use common\models\User;
use yii\rbac\Item;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $firstName;
    public $lastName;
    public $age;
    public $address;
    public $year;
    public $phone;
    public $photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['firstName', 'required'],

            ['lastName', 'required'],

            ['age', 'required'],

            ['address', 'required'],

            ['year', 'required'],

            ['phone', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate())
        {
            return null;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $student_role = Role::findOne(['role_name' => 'student']);
        if (!$student_role)
        {
            $transaction->rollBack();
            return null;
        }
        $user->role_id = $student_role->role_id;

        if (!$user->save())
        {
            $transaction->rollBack();
            return null;
        }

        $item = new Items();
        $students_cat = Categories::findOne(['category_title' => 'students']);
        if (!$students_cat)
        {
            $transaction->rollBack();
            return null;
        }
        $item->category_id = $students_cat->category_id;
        $item->created_at = date('Y-m-d H:i:s');
        $item->updated_at = date('Y-m-d H:i:s');
        $item->created_by = $user->id;
        $item->updated_by = $user->id;
        $item->save(false);

        $first_name_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'first_name']);
        if (!$first_name_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $first_name_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->firstName;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $last_name_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'last_name']);
        if (!$last_name_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $last_name_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->lastName;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $age_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'age']);
        if (!$age_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $age_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->age;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $address_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'address']);
        if (!$address_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $address_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->address;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $year_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'year']);
        if (!$year_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $year_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->year;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $phone_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'phone']);
        if (!$phone_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $phone_field->field_id;
        $val->language_id = null;
        $val->value = ''.$this->phone;
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $phone_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'is_active']);
        if (!$phone_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $phone_field->field_id;
        $val->language_id = null;
        $val->value = '1';
        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $photo_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'photo']);
        if (!$photo_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $photo_field->field_id;
        $val->language_id = null;
        //$val->value = ''.$this->photo;

        $imagename = $_FILES["SignupForm"]["name"];
        $folder = "../../common/web/uploads/";
        $new_name = time() . $imagename['photo'];
        move_uploaded_file($_FILES["SignupForm"]["tmp_name"]['photo'], $folder . $new_name);
        $val->value = $folder . $new_name;


        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }


        $user_id_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'user_id']);
        if (!$user_id_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $user_id_field->field_id;
        $val->language_id = null;
        $val->value = ''.$user->id;

        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $user_id_field = Fields::findOne(['category_id' => $students_cat->category_id, 'field_title' => 'user_id']);
        if (!$user_id_field)
        {
            $transaction->rollBack();
            return null;
        }
        $val = new Values();
        $val->item_id = $item->item_id;
        $val->field_id = $user_id_field->field_id;
        $val->language_id = null;
        $val->value = ''.$user->id;

        if (!$val->save())
        {
            $transaction->rollBack();
            return null;
        }

        $transaction->commit();
        return $user;
    }
}
