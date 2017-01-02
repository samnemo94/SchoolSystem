<?php
namespace frontend\controllers;

use backend\models\Languages;
use common\models\Categories;
use common\models\User;
use backend\models\Role;
use common\models\Fields;
use common\models\Items;
use backend\models\Menus;
use common\models\Values;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends MyController
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMenu($id)
    {
        $menu = Menus::findOne(['menu_id' => $id]);
        if ($menu->category_id)
        {
            if ($menu->menu_title == 'See All Teachers' || $menu->menu_title == 'See All Students')
            {
                return $this->redirect(['members', 'id' => $menu->category_id]);
            }
            if ($menu->menu_title == 'View All informations' || $menu->menu_title == 'View All Events')
            {
                return $this->redirect(['category-table', 'id' => $menu->category_id]);
            }

            if ($menu->menu_title == 'Teachers And Subjects' || $menu->menu_title == 'Add information' || $menu->menu_title == 'Add event')
            {
                return $this->redirect(['insert', 'id' => $menu->category_id]);
            }

            if ($menu->menu_title == 'My Marks' || $menu->menu_title== 'Students Marks')
            {
                return $this->redirect(['marks', 'id' => $menu->category_id]);
            }

            return $this->redirect(['category', 'id' => $menu->category_id]);
        }

        if ($menu->menu_title == 'Home')
            return $this->redirect(['index']);


        if ($menu->item_id)
        {
            $this->redirect(['page', 'id' => $menu->item_id]);
        }
    }

    public function actionCategory($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;
        $cat = Categories::findOne(['category_id' => $id]);
        $columns = [];
        foreach ($cat->fields as $field) {
            if (yii::$app->language == 'en')
                $columns[]['title'] = $field->field_title;
            else
                $columns []['title'] = $field->field_title_ar;
        }
        $rows = [];
        $items = $cat->getItems()->where(['deleted' => '0'])->all();
        foreach ($items as $item) {
            $item_info = MyController::getItemInfo($item->item_id, $lang);
            $rows[$item->item_id] = $item_info;
        }
        if ($cat->category_title == 'faculty' || $cat->category_title == 'subject') {
            return $this->render('category_list_images', [
                'columns' => $columns,
                'rows' => $rows,
            ]);
        }
        if ($cat->category_title == 'teacher_subject') {

            if ( yii::$app->user->isTeacher) {
               $teacher = yii::$app->user->getIsTeacher();
                $mySubjects = [];
                foreach ($rows as $key => $row) {
                    if ($row['teacher_id']['value'] == $teacher)
                        $mySubjects[$row['teacher_id']['value']] = MyController::getItemInfo($row['subject_id']['value'], $lang);
                }
                return $this->render('category_list_images', [
                    'columns' => $columns,
                    'rows' => $mySubjects,
                ]);

            }
        }

//        return $this->render('category', [
//            'columns' => $columns,
//            'rows' => $rows,
//        ]);
        }

    public function actionMarks($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;
        $cat = Categories::findOne(['category_id' => $id]);
        $columns = [];
        foreach ($cat->fields as $field) {
            if (yii::$app->language == 'en')
                $columns[]['title'] = $field->field_title;
            else
                $columns []['title'] = $field->field_title_ar;
        }
        $rows = [];
        $items = $cat->getItems()->where(['deleted' => '0'])->all();
        foreach ($items as $item) {
            $item_info = MyController::getItemInfo($item->item_id, $lang);
            $rows[$item->item_id] = $item_info;
        }

        if ($cat->category_title == 'student_subject') {
            if (yii::$app->user->isStudent) {
                $stu = yii::$app->user->getIsStudent();
                $myMarks = [];
                foreach ($rows as $row) {
                    if ($row['student_id']['value'] == $stu) {
                        $sub_info = MyController::getItemInfo($row['subject_id']['value'], $lang);
                        $myMarks[$sub_info['title']['value']] = $row['exam_mark']['value'];
                    }
                }
                return $this->render('mymarks', [
                    'myMarks' => $myMarks
                ]);
            }
            else
                return $this->render('marks', [
                    'columns' => $columns,
                    'rows' => $rows,
                ]);
        }
    }




    public function actionCategoryTable($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;
        $cat = Categories::findOne(['category_id' => $id]);
        $columns = [];
        foreach ($cat->fields as $field)
        {
            if (yii::$app->language == 'en')
            $columns[]['title'] = $field->field_title;
            else
                $columns []['title']= $field->field_title_ar;
        }
        $rows = [];
        $items = $cat->getItems()->where(['deleted' => '0'])->all();
        foreach ($items as $item)
        {
            $item_info = MyController::getItemInfo($item->item_id, $lang);
            $rows[$item->item_id] = $item_info;
        }
        return $this->render('category-table', [
            'columns' => $columns,
            'rows' => $rows,
        ]);
    }

    public function actionMembers($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;

        $cat = Categories::findOne(['category_id' => $id]);
        $columns = [];
        foreach ($cat->fields as $field)
        {
            if (yii::$app->language == 'en')
                $columns[]['title'] = $field->field_title;
            else
                $columns []['title']= $field->field_title_ar;
        }
        $rows = [];
        $items = $cat->getItems()->where(['deleted' => '0'])->all();
        foreach ($items as $item)
        {
            $item_info = MyController::getItemInfo($item->item_id, $lang);
            $rows[$item->item_id] = $item_info;
        }
        return $this->render('members', [
            'columns' => $columns,
            'rows' => $rows,
        ]);
    }

//this for ajax function for approve teachers
    public function actionActive()
    {
        $item = $_POST['key'];
        $item_model = $this->findItem($item);
        $cat = $item_model->category_id;
        $field = \backend\models\Fields::find()->where(['field_title' => 'is_active', 'category_id' => $cat])->one();
        $field = $field['field_id'];
        $value = Values::find()->where(['item_id' => $item, 'field_id' => $field])->one();
        if ($value)
        {
            if ($value['value'] == 1)
            {
                $model = $this->findValue($value['value_id']);
                $model->value = 0;
                $model->save(false);
            }
            else
            {
                $model = $this->findValue($value['value_id']);
                $model->value = 1;
                $model->save(false);
            }
        }
        else
        {
            $model = new Values();
            $model->item_id = $item;
            $model->field_id = $field;
            $model->language_id = Null;
            $model->value = 1;
            $model->save(false);
            $user = new User();
            $user->username = 'teacher' . $item;
            $user->email = 'teacher' . $item . '@gmail.com';
            $user->setPassword('teacher');
            $user->generateAuthKey();
            $teacher_role = Role::findOne(['role_name' => 'teacher']);
            $user->role_id = $teacher_role->role_id;
            $user->save(false);
            $model = new Values();
            $model->item_id = $item;
            $user_id_field = \backend\models\Fields::find()->where(['field_title' => 'user_id', 'category_id' => $cat])->one();
            $model->field_id = $user_id_field->field_id;
            $model->language_id = Null;
            $model->value = $user->id;
            $model->save(false);
        }
    }

    public function actionPage($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;

        $item = Items::findOne(['item_id' => $id]);

        $cat = $item->category;
        $parent = $cat->category_id;
        $childs = Categories::find()->where(['parent_id' => $parent,'showing_parent'=>'1'])->all();
        $childArray = [];
        foreach ($childs as $child)
        {
            $fields = \backend\models\Fields::find()->where(['category_id' => $child['category_id']])->all();
            foreach ($fields as $field)
            {
                if ($field['field_type'] == 'foreign_key' && $field['fk_table'] == $parent)
                    $f = $field['field_id'];
            }

            $myItems = \backend\models\Items::find()->where(['category_id' => $child['category_id']])->all();
            $secondArray = [];
            foreach ($myItems as $myItem)
            {
                $values = Values::find()->where(['item_id' => $myItem['item_id'], 'field_id' => $f])->all();
                foreach ($values as $vv)
                {
                    if ($vv['value'] == $id)
                    {
                        $itemInfo = MyController::getItemInfo($myItem['item_id'], $lang);
                        $secondArray[$myItem['item_id']] = $itemInfo;
                    }
                }
            }
            array_push($childArray, array($child['category_title'] => [ 'id'=>$child['category_id'],'data'=>$secondArray]));
        }

        $columns = [];
        foreach ($cat->fields as $field)
        {
            if (yii::$app->language == 'en')
                $columns[]['title'] = $field->field_title;
            else
                $columns []['title']= $field->field_title_ar;        }

        $row = MyController::getItemInfo($id, $lang);

        if ($cat->category_title == 'subject')
        {
            if (!Yii::$app->user->isGuest)
            {
                if (Yii::$app->user->isStudent)
                {
                    $is_registered = false;
                    $is_exam = false;
                    $student_subject = Categories::findOne(['category_title'=>'student_subject']);
                    $student_subject_item = MyController::getFilteredItems($student_subject->category_id,['subject_id'=>$id,'student_id'=>Yii::$app->user->isStudent],null);
                    foreach ($student_subject_item as $items)
                    {
                        $is_registered = true;
                    }
                    if ( $is_registered )
                    {
                        foreach ($student_subject_item as $items)
                        {
                            $student_subject_item_id = $item['item_id'];
                            break;
                        }
                        $cat2 = Categories::findOne(['category_title'=>'exam']);
                        $exam = MyController::getFilteredItems($cat2->category_id,['subject_id'=>$id],Null);
                        if($exam) {
                            foreach ($exam as $e) {
                                $exam_item_id = $e['item_id'];
                                break;
                            }
                            $exam = MyController::getItemInfo($exam_item_id, Null);
                            $exam_date = $exam['exam_date']['value'];
                            $field = Fields::findOne(['field_title' => 'exam_mark']);
                            $value = Values::findOne(['item_id'=>$student_subject_item_id ,'field_id'=>$field->field_id ]);
                            if ($exam_date == '2017-02-01' && empty($value))
                                $is_exam = true;
                        }

                    }
                    return $this->render('page_subject_student', [
                        'item' => $row,
                        'childs' => $childArray,
                        'is_registered' => $is_registered,
                        'is_exam' => $is_exam,
                        'student_subject_category' => $student_subject->category_id
                    ]);
                }
                if (Yii::$app->user->isTeacher)
                {
                    $is_registered = false;
                    $teacher_subject = Categories::findOne(['category_title' => 'teacher_subject']);
                    $teacher_subject_item = MyController::getFilteredItems($teacher_subject->category_id, ['subject_id' => $id, 'teacher_id' => Yii::$app->user->isTeacher], null,'d');
                    foreach ($teacher_subject_item as $items)
                    {
                        $is_registered = true;
                    }
                    return $this->render('page_subject_teacher', [
                        'item' => $row,
                        'childs' => $childArray,
                        'is_registered' => $is_registered,
                        'student_subject_category' => $teacher_subject->category_id
                    ]);
                }
                return $this->render('page_subject', [
                    'item' => $row, 'childs' => $childArray
                ]);
            }
        }
        if ($cat->category_title == 'exam')
        {
            $template = MyController::getItemInfo($row['template_id']['value'],$lang);
            return $this->render('page_exam', [
                'item' => $row,
                'template'=>$template,
                'childs' => $childArray
            ]);
        }
        if ($cat->category_title == 'exam_questions')
        {
            return $this->render('page_question', [
                'item' => $row,
            ]);
        }
        if ($cat->category_title == 'exam_template')
        {
            return $this->render('page_exam_template', [
                'item' => $row,
                'childs' => $childArray
            ]);
        }
        if ($cat->category_title == 'questions_template')
        {
            $question = MyController::getItemInfo($row['question_id']['value'],$lang);
            return $this->render('page_questions_template', [
                'item' => $row,
                'question' => $question
            ]);
        }
        return $this->render('page', [
            'item' => $row, 'childs' => $childArray]);
    }

    public function actionExam($id)
    {
        $langg = \backend\models\Languages::findOne(['language_code' => Yii::$app->language])->language_id;
        $student = Yii::$app->user->isStudent;
        $subject = $id;
        $subject_info = MyController::getItemInfo($subject , $langg);
//        $subject_title = $subject_info['title']['value'];
        $is_tody = false;
        $cat = Categories::findOne(['category_title'=>'student_subject']);
        $stu_sub_item_info =  MyController::getFilteredItems($cat->category_id, ['student_id'=>$student,'subject_id'=>$subject],$langg);
        foreach ($stu_sub_item_info as $stu)
        {
            $stu_sub_item_id = $stu['item_id'];
            break;
        }
        $cat2 = Categories::findOne(['category_title'=>'exam']);
        $exam = MyController::getFilteredItems($cat2->category_id,['subject_id'=>$subject],$langg);
        if($exam) {
            foreach ($exam as $e) {
                $exam_item_id = $e['item_id'];
                break;
            }
            $exam = MyController::getItemInfo($exam_item_id,$langg);
            $exam_date = $exam['exam_date']['value'];
            if ( $exam_date ==  date('d-m-y'))
                $is_tody = true;
            $exam_template_id = $exam['template_id']['value'];
            $cat3 = Categories::findOne(['category_title'=> 'questions_template']);
            $template_info = MyController::getFilteredItems($cat3->category_id,['template_id'=>$exam_template_id],$langg);
           $ques_ids = [];
            foreach ($template_info as $t) {
               $ques_ids[$t['item_id']] = $t['question_id']['value'];
            }
            $questions = [];
            foreach ($ques_ids as $ques)
            {
                $ques_info = MyController::getItemInfo( $ques , $langg);
                $questions[$ques] = $ques_info;
            }
            $count = 0;
            if (!empty( $_POST)){
                foreach ($questions as $question) {
                 $answer =   $_POST[$question['item_id']];
                    if( $answer == $question['answer']['value']){
                        $count = $count +1 ;
                    }
                }
                $value = new Values();
                $value->item_id = $stu_sub_item_id;
                $value->field_id = Fields::findOne(['field_title'=>'exam_mark'])->field_id;
                $value->language_id = NULL;
                $value->value = $count;
                $value->save(false);
                return $this->redirect(['index']);

            }
            else{
            return $this->render('exam', [
                'questions'=>$questions,
                'subject_info'=> $subject_info
                //'is_tody'=> $is_tody,
            ]);}
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        else
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail(Yii::$app->params['adminEmail']))
            {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            }
            else
            {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        }
        else
        {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($user = $model->signup())
            {
                if (Yii::$app->getUser()->login($user))
                {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSignupTeacher()
    {
        $id = Categories::find()->where(['category_title' => 'teachers'])->one();
        $id = $id['category_id'];
        $this->redirect(['insert', 'id' => $id]);
    }


    public function actionUpdateUser()
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;
        $student_cat = Categories::findOne(['category_title' => 'students']);
        if (!$student_cat)
            return null;
        $student = MyController::getFilteredItems($student_cat->category_id, ['user_id' => Yii::$app->user->id], $lang);
        foreach ($student as $std)
        {
            return $this->redirect(['update-row', 'id' => $std['item_id']]);
        }
        $teacher_cat = Categories::findOne(['category_title' => 'teachers']);
        if (!$teacher_cat)
            return null;
        $teacher = MyController::getFilteredItems($teacher_cat->category_id, ['user_id' => Yii::$app->user->id], $lang);
        foreach ($teacher as $std)
        {
            return $this->redirect(['update-row', 'id' => $std['item_id']]);
        }
        return true;
    }

    public function actionUpdateRow($id)
    {
        $item = $this->findItem($id);

        $fields = Fields::find()->where(['category_id' => $item['category_id']])->all();
        $items = [];
        foreach ($fields as $field1)
        {
            if ($field1['field_type'] == 'foreign_key')
            {
                $fk = $field1['fk_table'];
                $items[$fk] = Items::find()->where(['category_id' => $fk])->all();
            }
        }

        if (!empty($_POST))
        {
            $langs = Languages::find()->all();
            foreach ($fields as $field)
            {
                if ($field->has_translate)
                {
                    foreach ($langs as $lang)
                    {
                        $post = $field['field_title'] . $lang->language_code;
                        if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                        {
                            $val = Values::findOne(['field_id' => $field->field_id, 'item_id' => $item->item_id, 'language_id' => $lang->language_id]);
                            if (!$val)
                            {
                                $val = new Values();
                                $val->item_id = $item->item_id;
                                $val->field_id = $field['field_id'];
                                $val->language_id = $lang->language_id;
                            }
                            switch ($field['field_type'])
                            {
                                case 'image' :
                                    $imagename = $_FILES[$post]["name"];
                                    $folder = "../../common/web/uploads/";
                                    $new_name = time() . $imagename;
                                    move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                    $val->value = $folder . $new_name;
                                    break;
                                case 'file':
                                    $filename = $_FILES[$post]["name"];
                                    $folder = "../../common/web/uploads/";
                                    $new_name = time() . $filename;
                                    move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                    $val->value = $folder . $new_name;
                                    break;
                                default :
                                    $val->value = $_POST[$post];
                            }
                            $val->save(false);
                        }
                    }
                }
                else
                {
                    $post = $field['field_title'];
                    if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                    {
                        $val = Values::findOne(['field_id' => $field->field_id, 'item_id' => $item->item_id]);
                        if (!$val)
                        {
                            $val = new Values();
                            $val->item_id = $item->item_id;
                            $val->field_id = $field['field_id'];
                            $val->language_id = null;
                        }
                        switch ($field['field_type'])
                        {
                            case 'image' :
                                $imagename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $imagename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                break;
                            case 'file':
                                $filename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $filename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                break;
                            default :
                                $val->value = $_POST[$post];
                        }
                        $val->save(false);
                    }
                }
            }

            return $this->goHome();
        }
        else
        {
            $langs = Languages::find()->all();
            $values = $item->getValues()->all();
            $values_all = [];
            foreach ($fields as $field)
            {
                if ($field->has_translate)
                {
                    foreach ($langs as $lang)
                    {
                        $values_all[$field->field_id][$lang->language_code] = '';
                    }
                }
                else
                {
                    $values_all[$field->field_id]['0'] = '';
                }
            }
            foreach ($values as $value)
            {
                $values_all[$value->field_id][$value->getLanguage()->one() ? $value->getLanguage()->one()->language_code : '0'] = $value->value;
            }
            return $this->render('update-row', [
                'values' => $values_all,
                'id' => $id,
                'fields' => $fields,
                'items' => $items,
                'langs' => $langs
            ]);
        }

    }


    public function actionInsert($id, $fk_id = '')
    {
        $fields = Fields::find()->where(['category_id' => $id])->all();
        $category = Categories::findOne(['category_id' => $id]);

        $items = [];
        foreach ($fields as $field1)
        {
            if ($field1['field_type'] == 'foreign_key')
            {
                $fk = $field1['fk_table'];
                $items[$field1['fk_table']] = Items::find()->where(['category_id' => $fk])->all();

                $fk_category = Categories::findOne(['category_id' => $fk]);
                if ($fk_category->parent->category_id == $category->parent->category_id)
                {
                    $fk_fields = Fields::find()->where(['category_id' => $fk])->all();
                    $remote_field_name = '';
                    foreach ($fk_fields as $field_fk)
                    {
                        if ($field_fk['field_type'] == 'foreign_key' && $field_fk['fk_table'] == $fk_category->parent->category_id)
                        {
                            $remote_field_name = $field_fk['field_title'];
                        }
                    }
                    if ($remote_field_name != '')
                    {
                        $filterd_items_info = MyController::getFilteredItems($fk,[$remote_field_name=>$fk_id],null);
                        $ids = [];
                        foreach ($filterd_items_info as $f_i_i)
                        {
                            $ids[]=$f_i_i['item_id'];
                        }
                        $filt = [];
                        foreach ($items[$field1['fk_table']] as $it)
                        {
                            if (in_array($it->item_id,$ids))
                                $filt [] = $it;
                        }
                        $items[$field1['fk_table']] = $filt;
                    }
                }
            }
        }

        if (!empty($_POST))
        {
            $item = new Items();
            $item->category_id = $id;
            $item->created_at = date('Y-m-d H:i:s');
            $item->created_by = 1;
            $item->save(false);
            $langs = Languages::find()->all();
            $language_code = array();
            foreach ($langs as $lang)
            {
                array_push($language_code, $lang['language_code']);
            }
            array_push($language_code, "");
            foreach ($language_code as $lang)
            {
                foreach ($fields as $field)
                {
                    $post = $field['field_title'] . $lang;
                    if (!empty($_POST[$post]) || !empty($_FILES[$post]))
                    {
                        $val = new Values();
                        $val->item_id = $item->item_id;
                        $val->field_id = $field['field_id'];
                        if ($lang != "")
                        {
                            $langsID = Languages::find()->where(['language_code' => $lang])->one();
                            $val->language_id = $langsID ? $langsID['language_id'] : null;
                        }
                        else
                        {
                            $val->language_id = null;
                        }
                        switch ($field['field_type'])
                        {
                            case 'image' :
                                $imagename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $imagename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                $val->save(false);
                                break;
                            case 'file':
                                $filename = $_FILES[$post]["name"];
                                $folder = "../../common/web/uploads/";
                                $new_name = time() . $filename;
                                move_uploaded_file($_FILES[$post]["tmp_name"], $folder . $new_name);
                                $val->value = $folder . $new_name;
                                $val->save(false);
                                break;
                            default :
                                $val->value = $_POST[$post];
                                $val->save(false);
                        }
                    }
                }
            }

            if ($fk_id)
            {
                if ($category->parent_id)
                {
                    $parent = $category->parent;
                    $fk_field = Fields::findOne(['category_id' => $id, 'fk_table' => $parent->category_id]);
                    $val = new Values();
                    $val->item_id = $item->item_id;
                    $val->field_id = $fk_field['field_id'];
                    $val->language_id = null;
                    $val->value = $fk_id;
                    $val->save();
                }
            }

            return $this->goHome();
        }
        else
            return $this->render('insert', [
                'fields' => $fields,
                'id' => $id,
                'items' => $items,
                'langs' => Languages::find()->all(),
                'fk_id' => $fk_id
            ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    protected function findValue($id)
    {
        if (($model = Values::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findItem($id)
    {
        if (($model = Items::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
