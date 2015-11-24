<?php

namespace app\models;

use Yii;


class AllTable extends \yii\db\ActiveRecord
{
    public function select()
    {
        $sql = $this -> sql_index();
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        return $query;
    }
    
    private function sql_index()
    {
        $sql = 'select 
                        fb.fam_bud_id
                    ,   c.categ_name
                    ,   ie.inc_exp_name
                    ,   u.user_name
                    ,   fb.fam_bud_create
                    ,   cm.cour_mon_name
                    ,   fb.summa
                from 
                        categories c
                	,	courses_money cm
                	,	family_budget fb
                	,	inco_expenso ie
                	,	users u
                where fb.user_id = u.user_id
                	and fb.categ_id = c.categ_id
                	and c.inc_exp_id = ie.inc_exp_id
                	and fb.cour_mon_id = cm.cour_mon_id
                order by fb.fam_bud_create';
        return $sql;
    }
    
    
    public function CountFamilyBudget($id)
    {
        $sql = 'select fb.cour_mon_id from family_budget fb where fb.fam_bud_id = '.$id;
        
        return $count;
    }
    
    
}
