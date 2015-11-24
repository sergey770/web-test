<?php
namespace frontend\controllers;

use Yii;
use common\models\Categories;
use common\models\Users;
use common\models\IncoExpenso;
use common\models\CoursesMoney;
use common\models\FamilyBudget;
use app\models\AllTable;
use app\models\Report;
use yii\web\Controller;



/**
 * Site controller
 */
class ReportController extends Controller
{
    public function actionIndex()
    {
        $report = new Report;
        if ( $report->load(Yii::$app->request->post()) && $report->validate())
        {
            
            $active_from = $_POST['Report']['active_from'];
            $active_to = $_POST['Report']['active_to'];
            $query = $report -> ReportSql($active_from, $active_to);
            //return print_r($query);    
            return $this->render('report',['query' => $query]);
            
        }
        
        return $this->render('index',['report'=>$report]);
    }
    
    
    
    
    
    
}
