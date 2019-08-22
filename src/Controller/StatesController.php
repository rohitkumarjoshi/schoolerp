<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 *
 * @method \App\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatesController extends AppController
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
			$state = $this->States->newEntity();
		}
		else{
			 $id = $this->EncryptingDecrypting->decryptData($id);
			 $state = $this->States->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $state =  $this->States->patchEntity($state, $this->request->getData());
			if(!$id)
            {
                $state->created_by =$user_id;
            }
            else
            {
                $state->edited_by =$user_id;
            }
			$error='';
            try 
            {
				if ($this->States->save($state)) {
					$this->Flash->success(__('The state has been saved.'));
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
                 $error_data='The state could not be saved. Please, try again.';
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
            $States = $this->States->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $States->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('States.name', '%'.$name.'%');
                });
            }
            $States = $this->paginate($States);
        }
        else
        {
            $States = $this->paginate($this->States);
        }
        $this->set(compact('state','id','States','status','name'));
    }

    
}
