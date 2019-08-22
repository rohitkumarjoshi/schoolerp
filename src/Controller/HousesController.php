<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Houses Controller
 *
 * @property \App\Model\Table\HousesTable $Houses
 *
 * @method \App\Model\Entity\House[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HousesController extends AppController
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
			$house = $this->Houses->newEntity();
		}
		else{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$house = $this->Houses->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $house =  $this->Houses->patchEntity($house, $this->request->getData());
			if(!$id)
            {
                $house->created_by =$user_id;
            }
            else
            {
                $house->edited_by =$user_id;
            }
			$error='';
			try 
            {
				if ($this->Houses->save($house)) {
					$this->Flash->success(__('The house has been saved.'));
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
                 $error_data='The house could not be saved. Please, try again.';
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
            $Houses = $this->Houses->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $Houses->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('Houses.name', '%'.$name.'%');
                });
            }
            $Houses = $this->paginate($Houses);
        }
        else
        {
            $Houses = $this->paginate($this->Houses);
        }
        $this->set(compact('house','id','Houses','status','name'));
    }

    /**
     * View method
     *
     * @param string|null $id House id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $house = $this->Houses->get($id, [
            'contain' => ['StudentInfos']
        ]);

        $this->set('house', $house);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $house = $this->Houses->newEntity();
        if ($this->request->is('post')) {
            $house = $this->Houses->patchEntity($house, $this->request->getData());
            if ($this->Houses->save($house)) {
                $this->Flash->success(__('The house has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The house could not be saved. Please, try again.'));
        }
        $this->set(compact('house'));
    }

    /**
     * Edit method
     *
     * @param string|null $id House id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $house = $this->Houses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $house = $this->Houses->patchEntity($house, $this->request->getData());
            if ($this->Houses->save($house)) {
                $this->Flash->success(__('The house has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The house could not be saved. Please, try again.'));
        }
        $this->set(compact('house'));
    }

    /**
     * Delete method
     *
     * @param string|null $id House id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $house = $this->Houses->get($id);
        if ($this->Houses->delete($house)) {
            $this->Flash->success(__('The house has been deleted.'));
        } else {
            $this->Flash->error(__('The house could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
