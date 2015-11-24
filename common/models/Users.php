<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_login
 * @property string $user_password
 * @property string $user_active_from
 * @property string $user_active_to
 *
 * @property FamilyBudget[] $familyBudgets
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name'], 'required','message'=>'обязательно к заполнению'],
            //[['user_active_from', 'user_active_to'], 'safe'],
            //[['user_name', 'user_login', 'user_password'], 'string', 'max' => 50],
            [['user_name'], 'unique','message'=>'Имя должно быть уникальным']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_login' => 'User Login',
            'user_password' => 'User Password',
            'user_active_from' => 'User Active From',
            'user_active_to' => 'User Active To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyBudgets()
    {
        return $this->hasMany(FamilyBudget::className(), ['user_id' => 'user_id']);
    }
    
    
    public function allUsers()
    {
        $sql = 'select * from users order by user_active_to';
        $query = $this->findBySql($sql)->all();
        return $query;
    }
    
    
    public function sqlActivDelete($id)
    {
        $sql = 'select user_active_to from users where user_active_to is null and user_id = '.$id;
        return $sql;
    }
}
