<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NoticeCategories Controller
 *
 * @property \App\Model\Table\NoticeCategoriesTable $NoticeCategories
 *
 * @method \App\Model\Entity\NoticeCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NoticeCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id)
        {
            $noticeCategory = $this->NoticeCategories->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $noticeCategory = $this->NoticeCategories->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $noticeCategory = $this->NoticeCategories->patchEntity($noticeCategory, $this->request->getData());            
            if(!$id)
            {
                $noticeCategory->created_by =$user_id;
            }
            else
            {
                $noticeCategory->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->NoticeCategories->save($noticeCategory))
              {
                $this->Flash->success(__('The notice category has been saved.'));
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
                $error_data='The notice category could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }

        $noticeCategories = $this->paginate($this->NoticeCategories);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('noticeCategories','id','noticeCategory','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $noticeCategory = $this->NoticeCategories->get($id, [
            'contain' => ['Notices']
        ]);

        $this->set('noticeCategory', $noticeCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $noticeCategory = $this->NoticeCategories->newEntity();
        if ($this->request->is('post')) {
            $noticeCategory = $this->NoticeCategories->patchEntity($noticeCategory, $this->request->getData());
            if ($this->NoticeCategories->save($noticeCategory)) {
                $this->Flash->success(__('The notice category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice category could not be saved. Please, try again.'));
        }
        $this->set(compact('noticeCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $noticeCategory = $this->NoticeCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $noticeCategory = $this->NoticeCategories->patchEntity($noticeCategory, $this->request->getData());
            if ($this->NoticeCategories->save($noticeCategory)) {
                $this->Flash->success(__('The notice category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notice category could not be saved. Please, try again.'));
        }
        $this->set(compact('noticeCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $noticeCategory = $this->NoticeCategories->get($id);
        if ($this->NoticeCategories->delete($noticeCategory)) {
            $this->Flash->success(__('The notice category has been deleted.'));
        } else {
            $this->Flash->error(__('The notice category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
