<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DirectorMessages Controller
 *
 * @property \App\Model\Table\DirectorMessagesTable $DirectorMessages
 *
 * @method \App\Model\Entity\DirectorMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectorMessagesController extends AppController
{
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
        if(!$id){
              $directorMessage = $this->DirectorMessages->newEntity();
              }
          else
            {
                $id = $this->EncryptingDecrypting->decryptData($id);
                $directorMessage = $this->DirectorMessages->get($id, [
                    'contain' => []
                ]);
            }
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            $directorMessage = $this->DirectorMessages->patchEntity($directorMessage, $this->request->getData());
            if(!$id)
            {
                $directorMessage->created_by =$user_id;
            }
            else
            {
                $directorMessage->edited_by =$user_id;
            }
            $error='';
            try 
            {
                if ($this->DirectorMessages->save($directorMessage))
                {
                    $this->Flash->success(__('The director message has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                $error_data='The director message could not be saved. Please, try again.';
            } 
            $this->Flash->error(__($error_data));
        }
        $status=['Y'=>'Deactive','N'=>'Active'];
        $roleTypes=['All'=>'All','Teacher'=>'Teacher','Student'=>'Student'];
        $MessageBy=['Director'=>'Director','Principal'=>'Principal']; 
        $where=[];
        if(!empty($this->request->getQuery('role'))){
            $where['DirectorMessages.role_type']=$this->request->getQuery('role');
        }
        if(!empty($this->request->getQuery('msgby'))){
            $where['DirectorMessages.message_by']=$this->request->getQuery('msgby');
        }
        $directorMessages = $this->paginate($this->DirectorMessages->find()->where($where));
        $this->set(compact('directorMessages','directorMessage','id','roleTypes','MessageBy','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Director Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function studentView($id = null)
    {
        $where['role_type']='Student'; 
        if(!empty($this->request->getQuery('msgby'))){
            $where['DirectorMessages.message_by']=$this->request->getQuery('msgby');
        }
        $directorMessages = $this->paginate($this->DirectorMessages->find()->where($where));
        $this->set(compact('directorMessages','directorMessage','id','roleTypes','MessageBy','status'));
       
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $directorMessage = $this->DirectorMessages->newEntity();
        if ($this->request->is('post')) {
            $directorMessage = $this->DirectorMessages->patchEntity($directorMessage, $this->request->getData());
            if ($this->DirectorMessages->save($directorMessage)) {
                $this->Flash->success(__('The director message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The director message could not be saved. Please, try again.'));
        }
        $this->set(compact('directorMessage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Director Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $directorMessage = $this->DirectorMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $directorMessage = $this->DirectorMessages->patchEntity($directorMessage, $this->request->getData());
            if ($this->DirectorMessages->save($directorMessage)) {
                $this->Flash->success(__('The director message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The director message could not be saved. Please, try again.'));
        }
        $this->set(compact('directorMessage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Director Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $directorMessage = $this->DirectorMessages->get($id);
        if ($this->DirectorMessages->delete($directorMessage)) {
            $this->Flash->success(__('The director message has been deleted.'));
        } else {
            $this->Flash->error(__('The director message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
