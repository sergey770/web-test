<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $categ_id
 * @property string $categ_name
 * @property integer $inc_exp_id
 * @property string $categ_active_from
 * @property string $categ_active_to
 *
 * @property IncoExpenso $incExp
 * @property FamilyBudget[] $familyBudgets
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inc_exp_id'], 'integer'],
            [['categ_name'], 'string', 'max' => 50],
            [['categ_name', 'inc_exp_id'], 'required', 'message'=>'Поле обязательно к заполению'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categ_id' => 'Categ ID',
            'categ_name' => 'Categ Name',
            'inc_exp_id' => 'Inc Exp ID',
            'categ_active_from' => 'Categ Active From',
            'categ_active_to' => 'Categ Active To',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncExp()
    {
        return $this->hasOne(IncoExpenso::className(), ['inc_exp_id' => 'inc_exp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyBudgets()
    {
        return $this->hasMany(FamilyBudget::className(), ['categ_id' => 'categ_id']);
    }
    
    
    public function categIncoExpen()
    {
        $sql = 'select * from categories cat, inco_expenso ie where cat.inc_exp_id = ie.inc_exp_id order by categ_active_to';
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return $query;
    }
    
    
    public function sqlAactivDelete($id)
    {
        $sql = 'select categ_active_to from categories where categ_active_to is null and categ_id = '.$id;
        return $sql;
    }
    
    
    public function updateCateg($id)
    {
        $query = $this->updateAll(['categ_name' => $_POST['Categories']['categ_name']
                                ,'inc_exp_id' => $_POST['Categories']['inc_exp_id']
                                ,'categ_active_from' => date("Y-m-d")]
                                ,['categ_id'=>$id]);
        return $query;
    }
}
