<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EnquiryStatuses Controller
 *
 * @property \App\Model\Table\EnquiryStatusesTable $EnquiryStatuses
 *
 * @method \App\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiryStatusesController extends AppController
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
			$enquiryStatus = $this->EnquiryStatuses->newEntity();
		}
		else{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$enquiryStatus = $this->EnquiryStatuses->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $enquiryStatus =  $this->EnquiryStatuses->patchEntity($enquiryStatus, $this->request->getData());
			if(!$id)
            {
                $enquiryStatus->created_by =$user_id;
            }
            else
            {
                $enquiryStatus->edited_by =$user_id;
            }
			$error='';
			try 
            {
				if ($this->EnquiryStatuses->save($enquiryStatus)) {
					$this->Flash->success(__('The enquiry status has been saved.'));
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
                 $error_data='The enquiry status could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
		$EnquiryStatuses  = $this->paginate($this->EnquiryStatuses->find()->order(['id'=>'DESC']),['limit'=>10]);
        $this->set(compact('enquiryStatus','id','EnquiryStatuses','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enquiryStatus = $this->EnquiryStatuses->get($id, [
            'contain' => ['EnquiryFormStudents']
        ]);

        $this->set('enquiryStatus', $enquiryStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enquiryStatus = $this->EnquiryStatuses->newEntity();
        if ($this->request->is('post')) {
            $enquiryStatus = $this->EnquiryStatuses->patchEntity($enquiryStatus, $this->request->getData());
            if ($this->EnquiryStatuses->save($enquiryStatus)) {
                $this->Flash->success(__('The enquiry status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry status could not be saved. Please, try again.'));
        }
        $this->set(compact('enquiryStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enquiryStatus = $this->EnquiryStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiryStatus = $this->EnquiryStatuses->patchEntity($enquiryStatus, $this->request->getData());
            if ($this->EnquiryStatuses->save($enquiryStatus)) {
                $this->Flash->success(__('The enquiry status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry status could not be saved. Please, try again.'));
        }
        $this->set(compact('enquiryStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiryStatus = $this->EnquiryStatuses->get($id);
        if ($this->EnquiryStatuses->delete($enquiryStatus)) {
            $this->Flash->success(__('The enquiry status has been deleted.'));
        } else {
            $this->Flash->error(__('The enquiry status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
