<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Religions Controller
 *
 * @property \App\Model\Table\ReligionsTable $Religions
 *
 * @method \App\Model\Entity\Religion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReligionsController extends AppController
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
			$religion = $this->Religions->newEntity();
		}
		else{
			 $id = $this->EncryptingDecrypting->decryptData($id);
			 $religion = $this->Religions->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $religion =  $this->Religions->patchEntity($religion, $this->request->getData());
			if(!$id)
            {
                $religion->created_by =$user_id;
            }
            else
            {
                $religion->edited_by =$user_id;
            }
			$error='';
			try 
            {
				if ($this->Religions->save($religion)) {
					$this->Flash->success(__('The religion has been saved.'));
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
                 $error_data='The religion could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
		$Religions  = $this->paginate($this->Religions->find()->order(['id'=>'DESC']));
        $this->set(compact('religion','id','Religions','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Religion id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $religion = $this->Religions->get($id, [
            'contain' => ['StudentInfos']
        ]);

        $this->set('religion', $religion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $religion = $this->Religions->newEntity();
        if ($this->request->is('post')) {
            $religion = $this->Religions->patchEntity($religion, $this->request->getData());
            if ($this->Religions->save($religion)) {
                $this->Flash->success(__('The religion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The religion could not be saved. Please, try again.'));
        }
        $this->set(compact('religion'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Religion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $religion = $this->Religions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $religion = $this->Religions->patchEntity($religion, $this->request->getData());
            if ($this->Religions->save($religion)) {
                $this->Flash->success(__('The religion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The religion could not be saved. Please, try again.'));
        }
        $this->set(compact('religion'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Religion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $religion = $this->Religions->get($id);
        if ($this->Religions->delete($religion)) {
            $this->Flash->success(__('The religion has been deleted.'));
        } else {
            $this->Flash->error(__('The religion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
