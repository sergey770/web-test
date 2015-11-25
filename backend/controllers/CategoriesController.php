<?


namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Categories;
use common\models\IncoExpenso;

class CategoriesController extends Controller
{
    public function actionIndex()
    {
        $query = new Categories;
        $sql = $query -> categIncoExpen();
        return $this->render('index',['query' => $sql]);
    }
    
    public function actionCreate()
    {
        $categ = new Categories;
        
        if($categ->load(Yii::$app->request->post()) && $categ->validate())
        {
            //return print_r($_POST);
            $categ['categ_active_from'] = date("Y-m-d");
            
            $categ->save();
            return $this->redirect('index');
        }
        
        $inco_ex = new IncoExpenso;
        $inco_ex = $inco_ex->find()->all();
        return $this->render('create',['categ' => $categ, 'inco_ex' => $inco_ex]);
    }
    
    
    
    
    public function actionUpdate($id)
    {
        $id = (int)$id;
        if (empty($id))
        {
            return $this->redirect('index');
        }
        
        $categ = new Categories;
        $inco_ex = new IncoExpenso;
        $inco_ex = $inco_ex->find()->all();
        
        $sql = $categ->sqlAactivDelete($id);
        
        //проверяем активна запись для изменения
        
        $query = Categories::findBySql($sql)->count();
        if ($query == 0)
        {
            return $this->redirect('index');
        }
        
        if($categ->load(Yii::$app->request->post()) && $categ->validate())
        {
            $q = $categ->updateCateg($id);
            return $this->redirect('index');
        }
        $sql = $categ->findOne($id);
        return $this->render('update',['categ' => $sql, 'inco_ex' => $inco_ex]);
    }
    
    
    
    public function actionDelete($id)
    {
        $id = (int)$id;
        if (empty($id))
        {
            return $this->redirect('index');
        }
        $categ = new Categories;
        $categ->updateAll(['categ_active_to' => date("Y-m-d")],['categ_id'=>$id]);
        
        return $this->redirect('index');
    }
    
    
    
    public function actionActive($id)
    {
        // проверяем число
        $id = (int)$id;
        if (empty($id))
        {
            return $this->redirect('index');
        }
        
        $categ = new Categories;
        $categ->updateAll(['categ_active_to' => null],['categ_id'=>$id]);
        
        return $this->redirect('index');
    }
    
    
}