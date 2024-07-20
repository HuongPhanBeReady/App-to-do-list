<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\captcha\Captcha;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $fullname;
    public $email;
    public $password;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fullname', 'trim'],
            ['fullname', 'required', 'message' => 'Full name cannot be blank.'],
            ['fullname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Email cannot be blank.'],
            ['email', 'email', 'message' => 'Email format is not valid.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'message' => 'Password cannot be blank.'],
            ['password', 'string', 'min' => 8, 'message' => 'Password should contain at least 8 characters.'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9@%&*]+$/', 'message' => 'Password can only contain a-z, A-Z, 0-9, and @%&*.'],


            ['re_password', 'required', 'message' => 'Please confirm your password.'],
            ['re_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->fullname = $this->fullname;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_INACTIVE; 
        $user->created_at = time(); 
        $user->updated_at = time(); 
        if ($user->save()) {
            return Yii::$app->response->redirect(['site/signup-success']);
        }
    
        return null;
    }
}