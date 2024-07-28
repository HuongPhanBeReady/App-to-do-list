<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class UserImage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_image}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'name_file', 'path'], 'required'],
            [['user_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['name_file'], 'string', 'max' => 255],
            [['deleted_at'], 'safe'],
        ];
    }

    /**
     * Mark image as deleted instead of deleting it physically.
     */
    public function deleteImage()
    {
        $this->deleted_at = date('Y-m-d H:i:s');
        $this->save(false);
    }

    /**
     * Get user associated with this image.
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}

