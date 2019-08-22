<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Castes Controller
 *
 * @property \App\Model\Table\CastesTable $Castes
 *
 * @method \App\Model\Entity\Caste[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CastesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
		if(!$id){
			$caste = $this->Castes->newEntity();
		}
		else{
			 $id = $this->EncryptingDecrypting->decryptData($id);
			 $caste = $this->Castes->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $caste =  $this->Castes->patchEntity($caste, $this->request->getData());
			if(!$id)
            {
                $caste->created_by =$user_id;
            }
            else
            {
                $caste->edited_by =$user_id;
            }
			$error='';
			try 
            {
				if ($this->Castes->save($caste)) {
					$this->Flash->success(__('The caste has been saved.'));
					return $this->redirect(['action' => 'index']);
				}
			} catch (\Exception $e) {
               $error = $e->getMessage();
            }
			if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The caste could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
        $this->paginate = [
            'order' => ['id'=>'DESC'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $Castes = $this->Castes->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $Castes->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('Castes.name', '%'.$name.'%');
                });
            }
            $Castes = $this->paginate($Castes);
        }
        else
        {
            $Castes = $this->paginate($this->Castes);
        }
        $this->set(compact('caste','id','Castes','status','name'));
    }
}
