<?php
namespace frontend\controllers;

use Yii;
use common\models\Categories;
use common\models\Users;
use common\models\IncoExpenso;
use common\models\CoursesMoney;
use common\models\FamilyBudget;
use app\models\AllTable;
use yii\web\Controller;



/**
 * Site controller
 */
class MainController extends Controller
{
    
    public function actionIndex()
    {
        $sql = new AllTable;
        $query = $sql->select();
        return $this->render('index',['query'=>$query]);
    }
    
    
    public function actionCreate()
    {
        $famil_bud = new FamilyBudget;
        
        
        if($famil_bud->load(Yii::$app->request->post()) && $famil_bud->validate())
        {
            //return print_r($_POST);
            $famil_bud['fam_bud_create'] = date("Y-m-d");
            
            // проверяем расходы или доходs
            $query = $famil_bud -> IncoExpens($_POST['FamilyBudget']['categ_id']);
            
            if ( $query == 5)
            {
                $famil_bud['summa'] = -$_POST['FamilyBudget']['summa'];
            } 
            
            $famil_bud->save();
            return $this->redirect('index');
        }
        
        $users = new Users;
        $categ = new Categories;
        $inco_exp = new IncoExpenso;
        $mony = new CoursesMoney;
        
        
        $users = $users->find()->where('user_active_to is null')->all();
        //$categ = $categ->find()->all();
        $categ = $categ->find()->where('categ_active_to is null')->all();
        $inco_exp = $inco_exp->find()->all();
        $mony = $mony->find()->all();
        
        
        return $this->render('create',[ 'users' => $users
                                        , 'categ' => $categ
                                        , 'inco_exp' => $inco_exp
                                        , 'mony' => $mony
                                        , 'famil_bud' => $famil_bud]);
    }
    
    
    public function actionUpdate($id)
    {
        $id = (int)$id;
        if (empty($id))
        {
            return $this->redirect('index');
        }
        
        $famil_bud = new FamilyBudget;
        
        $sql = $famil_bud->findOne($id);
        
        if($famil_bud->load(Yii::$app->request->post()) && $sql->validate())
        {
            $sql->updateAll([
                            'categ_id' => $_POST['FamilyBudget']['categ_id']
                            ,'summa' => $_POST['FamilyBudget']['summa']
                            ,'cour_mon_id' => $_POST['FamilyBudget']['cour_mon_id']
                            ,'user_id' => $_POST['FamilyBudget']['user_id']
                            ],['fam_bud_id'=>$id]);

            return $this->redirect('index');
        }
        
        $users = new Users;
        $categ = new Categories;
        $inco_exp = new IncoExpenso;
        $mony = new CoursesMoney;
        
        
        $users = $users->find()->where('user_active_to is null')->all();
        $categ = $categ->find()->where('categ_active_to is null')->all();
        $inco_exp = $inco_exp->find()->all();
        $mony = $mony->find()->all();
        
        return $this->render('update',[ 'users' => $users
                                        , 'categ' => $categ
                                        , 'inco_exp' => $inco_exp
                                        , 'mony' => $mony
                                        , 'famil_bud' => $sql]);
    }
    
    
    
    public function actionDelete($id)
    {
        $id = (int)$id;
        if (empty($id))
        {
            return $this->redirect('index');
        }
        
        $famil_bud = new FamilyBudget;
        
        $sql = $famil_bud->findOne($id)->delete();
        
        return $this->redirect('index');
    }
    
}
