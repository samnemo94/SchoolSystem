<?php
namespace frontend\controllers;

use backend\models\Languages;
use common\models\Categories;
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
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends MyController
{
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
        foreach ($cat->fields as $field)
        {
            $columns[]['title'] = $field->field_title;
        }

        $rows = [];
        $items = $cat->getItems()->where(['deleted'=>'0'])->all();
        foreach ($items as $item)
        {
            $item_info = $this->getItemInfo($item->item_id,$lang);
            $rows[$item->item_id] = $item_info;
        }

        if ($cat->category_title == 'faculty' || $cat->category_title == 'subject')
        {
            return $this->render('category_list_images', [
                'columns' => $columns,
                'rows' => $rows,
            ]);
        }
        return $this->render('category', [
            'columns' => $columns,
            'rows' => $rows,
        ]);
    }

    public function actionPage($id)
    {
        $lang = Languages::findOne(['language_code' => Yii::$app->language])->language_id;

        $item = Items::findOne(['item_id' => $id]);

        $cat = $item->category;
        $parent = $cat->category_id;
        $childs = Categories::find()->where(['parent_id' =>$parent])->all();
        foreach ($childs as $child) {
            echo $child['category_title'].' :';
            $items=  \backend\models\Items::find()->where(['category_id'=>$child['category_id']])->all();
            foreach ($items as $item){
                print_r($this->getItemInfo($item['item_id'],$lang)) ;
                echo '<br>';
//                $infos [] = $this->getItemInfo($item['item_id'],$lang) ;
//                echo '</br>';
//                foreach ($infos as $key => $value) {
//
//                }
//                echo '<br>';
            }
        }
      /* $columns = [];
        foreach ($cat->fields as $field)
        {
            $columns[]['title'] = $field->field_title;
        }

        $row = $this->getItemInfo($id,$lang);

        if ($cat->category_title == 'subject')
        {
            return $this->render('page_subject', [
                'item' => $row,
            ]);
        }

        return $this->render('page', [
            'item' => $row]*/
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
}
