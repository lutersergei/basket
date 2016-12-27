<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use yii\base\Response;
use yii\filters\AccessControl;
use yii\mongodb\Query;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\ResetPasswordForm;
use app\models\PasswordResetRequestForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
                    'logout' => ['post'],
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
     * Displays basket page.
     *
     * @param null $category_id
     * @param null $subcategory_id
     * @return mixed|string
     */
    public function actionIndex($category_id = null, $subcategory_id = null)
    {
        if ($subcategory_id)
        {
            //If GET request includes category and subcategory
            $subcategory_id = (int) $subcategory_id;
            $subcategory = Category::find()
                ->where(["subList.id" => $subcategory_id])
                ->select([
                    'subList' =>
                        ['$elemMatch' =>
                            ['id' => $subcategory_id]]])
                ->asArray()
                ->one();

            if($products = $subcategory['subList'][0]['productList'])
            {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return $products;
            }
            else die('NOOO'); //TODO бросить эксепшн Нет такой подкатегори, вы ошиблись адресом

//            $keyOfSubcategory = $this->findKeyOfSubcategory($subcategories, $subcategory_id);
//                var_dump($subCategories['subList'][$keyOfCategory]);
//                die();
//            $products = $subcategories[$keyOfSubcategory];
//            return $products;

        }
        if ($category_id)
        {
            //If GET request includes only category
            $category_id = (int) $category_id;
            $category = Category::find()
                ->where(['id' => $category_id])
                ->select(['subList.id' => 1, 'subList.name' => 1])
                ->asArray()
                ->one();
            if ($subcategories = $category['subList'])
            {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return $subcategories;
            }
            else die('NOOO'); //TODO бросить эксепшн Нет такой категори, вы ошиблись адресом
        }
//        $query = new Query();
//        $query->select(['id', 'name', 'pictureName'])->from('category')->where('status=1');
//        $categories = $query->all();
//
        $categories = Category::find()->select(['id', 'name', 'pictureName'])->asArray()->all();

//        $categories = Category::find()->where([
//            'subList' => [
//                '$elemMatch' => [
//                    'name' => 'Молоко'
//                ]
//            ]
//        ])->asArray()->all();
//        var_dump($categories);
//        die();
        return $this->render('products', [
           'categories' => $categories
        ]);
    }

    public function findKeyOfSubcategory($catList, $subcat)
    {
//        var_dump($catList, $subcat);

        foreach ($catList as $key=>$value)
        {
            if ($value['id'] === $subcat) return $key;
        }
//        die();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
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
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
