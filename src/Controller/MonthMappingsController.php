<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MonthMappings Controller
 *
 * @property \App\Model\Table\MonthMappingsTable $MonthMappings
 *
 * @method \App\Model\Entity\MonthMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MonthMappingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SessionYears', 'StudentClasses', 'Media', 'Streams']
        ];
        $monthMappings = $this->paginate($this->MonthMappings);

        $this->set(compact('monthMappings'));
    }

    /**
     * View method
     *
     * @param string|null $id Month Mapping id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $monthMapping = $this->MonthMappings->get($id, [
            'contain' => ['SessionYears', 'StudentClasses', 'Media', 'Streams']
        ]);

        $this->set('monthMapping', $monthMapping);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $monthMapping = $this->MonthMappings->newEntity();
        if ($this->request->is('post')) {
            $monthMapping = $this->MonthMappings->patchEntity($monthMapping, $this->request->getData());
            if ($this->MonthMappings->save($monthMapping)) {
                $this->Flash->success(__('The month mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The month mapping could not be saved. Please, try again.'));
        }
        $sessionYears = $this->MonthMappings->SessionYears->find('list');
        $studentClasses = $this->MonthMappings->StudentClasses->find('list');
        $media = $this->MonthMappings->Media->find('list');
        $streams = $this->MonthMappings->Streams->find('list');
        $this->set(compact('monthMapping', 'sessionYears', 'studentClasses', 'media', 'streams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Month Mapping id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $monthMapping = $this->MonthMappings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $monthMapping = $this->MonthMappings->patchEntity($monthMapping, $this->request->getData());
            if ($this->MonthMappings->save($monthMapping)) {
                $this->Flash->success(__('The month mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The month mapping could not be saved. Please, try again.'));
        }
        $sessionYears = $this->MonthMappings->SessionYears->find('list');
        $studentClasses = $this->MonthMappings->StudentClasses->find('list');
        $media = $this->MonthMappings->Media->find('list');
        $streams = $this->MonthMappings->Streams->find('list');
        $this->set(compact('monthMapping', 'sessionYears', 'studentClasses', 'media', 'streams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Month Mapping id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $monthMapping = $this->MonthMappings->get($id);
        if ($this->MonthMappings->delete($monthMapping)) {
            $this->Flash->success(__('The month mapping has been deleted.'));
        } else {
            $this->Flash->error(__('The month mapping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
