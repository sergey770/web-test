<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Report extends Model
{
    public $active_from;
    public $active_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['active_from', 'active_to'], 'required'],
           // [['active_from', 'active_to'], 'date'],
        ];
    }
    
    
    public function ReportSql($active_from, $active_to)
    {
        $sql = $this->AciveSql($active_from, $active_to);
        $query = Yii::$app->db->createCommand($sql)->queryAll();

        return $query;
        
    }
    
    
    private function AciveSql($active_from, $active_to)
    {
        $sql = 'select 
                c.categ_name
            ,   ie.inc_exp_name
            ,   u.user_name
            ,   cm.cour_mon_name
            ,   sum(fb.summa) summa
            ,   case when cm.cour_mon_id = 1 then
        		  sum(fb.summa * 60)
        		else
        		  sum(fb.summa)   
        		end suma_rub
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
        	and fb.fam_bud_create > DATE_FORMAT("'.$active_from .'","%d.%m.%Y")
        	and fb.fam_bud_create < DATE_FORMAT("'.$active_to .'","%d.%m.%Y")
        group by c.categ_name 
        	, ie.inc_exp_name 
        	, u.user_name 
        	, cm.cour_mon_name
        order by fb.fam_bud_create';
        
        return $sql;
    }
    
    
    
    
    
}
