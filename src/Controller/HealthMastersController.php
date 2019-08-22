<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HealthMasters Controller
 *
 * @property \App\Model\Table\HealthMastersTable $HealthMasters
 *
 * @method \App\Model\Entity\HealthMaster[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HealthMastersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        if(is_null($id))
            $healthMaster = $this->HealthMasters->newEntity();
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $healthMaster = $this->HealthMasters->get($id);
        }

        $healthMasters = $this->paginate($this->HealthMasters->find()->where(['is_deleted'=>'N']));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $healthMaster = $this->HealthMasters->patchEntity($healthMaster, $this->request->getData());
            if(is_null($id))
                $healthMaster->created_by = $this->Auth->user('id');
            else
                $healthMaster->edited_by = $this->Auth->user('id');

            if ($this->HealthMasters->save($healthMaster)) {
                $this->Flash->success(__('The health master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The health master could not be saved. Please, try again.'));
        }
        $this->set(compact('healthMaster','healthMasters','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Health Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $healthMaster = $this->HealthMasters->get($id, [
    //         'contain' => ['StudentHealths']
    //     ]);

    //     $this->set('healthMaster', $healthMaster);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $healthMaster = $this->HealthMasters->newEntity();
    //     if ($this->request->is('post')) {
    //         $healthMaster = $this->HealthMasters->patchEntity($healthMaster, $this->request->getData());
    //         if ($this->HealthMasters->save($healthMaster)) {
    //             $this->Flash->success(__('The health master has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The health master could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('healthMaster'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Health Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $healthMaster = $this->HealthMasters->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $healthMaster = $this->HealthMasters->patchEntity($healthMaster, $this->request->getData());
    //         if ($this->HealthMasters->save($healthMaster)) {
    //             $this->Flash->success(__('The health master has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The health master could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('healthMaster'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Health Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $healthMaster = $this->HealthMasters->get($id);
        $healthMaster->is_deleted = 'Y';
        if ($this->HealthMasters->save($healthMaster)) {
            $this->Flash->success(__('The health master has been deleted.'));
        } else {
            $this->Flash->error(__('The health master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
