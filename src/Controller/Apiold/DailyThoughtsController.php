<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * DailyThoughts Controller
 *
 * @property \App\Model\Table\DailyThoughtsTable $DailyThoughts
 *
 * @method \App\Model\Entity\DailyThought[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DailyThoughtsController extends AppController
{ 
    public function dailyThought()
    {
        $user_type = $this->request->getQuery('user_type');
        
        $where['is_deleted']='N'; 
        if($user_type=='Employee'){
            $where['DailyThoughts.role_type !=']='Student';
        }
        if($user_type=='Student'){
            $where['DailyThoughts.role_type !=']='Teacher';
        }
        $dailyThought = $this->DailyThoughts->find()
                        ->where($where)
                        ->order(['id'=>'DESC'])->limit(1)->first();
        if($dailyThought){
            $success=true;
            $message='';
        }else{
            $success=false;
            $message="No data found";
            $dailyThought=array();
        }
        $this->set(compact('success', 'message', 'dailyThought'));
        $this->set('_serialize', ['success', 'message', 'dailyThought']);
    }

    /**
     * View method
     *
     * @param string|null $id Daily Thought id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function studentView($id = null)
    {
        $where['role_type']='Student'; 
        $where['is_deleted']='N'; 
        $dailyThoughts = $this->paginate($this->DailyThoughts->find()->where($where)->order(['id'=>'DESC']));
        $this->set(compact('dailyThoughts'));  
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dailyThought = $this->DailyThoughts->newEntity();
        if ($this->request->is('post')) {
            $dailyThought = $this->DailyThoughts->patchEntity($dailyThought, $this->request->getData());
            if ($this->DailyThoughts->save($dailyThought)) {
                $this->Flash->success(__('The daily thought has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The daily thought could not be saved. Please, try again.'));
        }
        $this->set(compact('dailyThought'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Daily Thought id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dailyThought = $this->DailyThoughts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dailyThought = $this->DailyThoughts->patchEntity($dailyThought, $this->request->getData());
            if ($this->DailyThoughts->save($dailyThought)) {
                $this->Flash->success(__('The daily thought has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The daily thought could not be saved. Please, try again.'));
        }
        $this->set(compact('dailyThought'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Daily Thought id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dailyThought = $this->DailyThoughts->get($id);
        if ($this->DailyThoughts->delete($dailyThought)) {
            $this->Flash->success(__('The daily thought has been deleted.'));
        } else {
            $this->Flash->error(__('The daily thought could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
