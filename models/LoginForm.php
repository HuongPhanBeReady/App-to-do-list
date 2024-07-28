<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user = false;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Email cannot be blank.'],
            ['email', 'email', 'message' => 'Email format is not valid.'],
            ['email', 'string', 'max' => 255],

            ['password', 'required', 'message' => 'Password cannot be blank.'],
            ['password', 'string', 'min' => 8, 'message' => 'Password should contain at least 8 characters.'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9@%&*]+$/', 'message' => 'Password can only contain a-z, A-Z, 0-9, and @%&*.'],

            ['verifyCode', 'captcha'],
            ['password', 'validatePassword'], // Thêm dòng này

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    public function validatePassword($attribute, $params)
    {
    
        if (!$this->hasErrors()) {
            $user = $this->getUser();
    
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }
    
    public function login()
    {   
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user !== null && $user->validatePassword($this->password)) {
                return Yii::$app->user->login($user);
            } else {
                $this->addError('password', 'Incorrect email or password.');
            }
        }
        return false;
    }
    protected function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
    
}