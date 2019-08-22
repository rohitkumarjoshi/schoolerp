<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 *
 * @method \App\Model\Entity\City[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitiesController extends AppController
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
			$city = $this->Cities->newEntity();
		}
		else{
			 $id = $this->EncryptingDecrypting->decryptData($id);
			 $city = $this->Cities->get($id, [
			'contain' => ['States']
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $city =  $this->Cities->patchEntity($city, $this->request->getData());
			if(!$id)
            {
                $city->created_by = $user_id;
            }
            else
            {
                $city->edited_by = $user_id;
            }
			$error='';
			try 
            {
				if ($this->Cities->save($city)) {
					$this->Flash->success(__('The city has been saved.'));
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
                 $error_data='The city could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
		$states = $this->Cities->States->find('list')->order(['States.name'=>'ASC']);
        $this->paginate = [
            'contain' => ['States'],
            'order' => ['Cities.id'=>'DESC'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $citys = $this->Cities->find();
            if(!empty($this->request->getQuery('state_id')))
            {
                $state_id = $this->request->getQuery('state_id');
                $citys->where(['Cities.state_id'=>$state_id]);
                
            }
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $citys->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('Cities.name', '%'.$name.'%');
                });
            }
            $citys = $this->paginate($citys);
        }
        else
        {
            $citys = $this->paginate($this->Cities);
        }
        $this->set(compact('city','id','citys','status','states','state_id','name'));
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => ['States', 'Employees', 'StudentInfos']
        ]);

        $this->set('city', $city);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->Cities->States->find('list');
        $this->set(compact('city', 'states'));
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $states = $this->Cities->States->find('list');
        $this->set(compact('city', 'states'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
