<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MealTypes Controller
 *
 * @property \App\Model\Table\MealTypesTable $MealTypes
 *
 * @method \App\Model\Entity\MealType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MealTypesController extends AppController
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
            $mealType = $this->MealTypes->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $mealType = $this->MealTypes->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());            
            if(!$id)
            {
                $mealType->created_by =$user_id;
            }
            else
            {
                $mealType->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->MealTypes->save($mealType))
              {
                $this->Flash->success(__('The meal has been saved.'));
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
                $error_data='The meal could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $MealTypes = $this->paginate($this->MealTypes,['limit'=>10]);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('MealTypes','mealType','id','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Meal Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mealType = $this->MealTypes->get($id, [
            'contain' => ['MessAttendances']
        ]);

        $this->set('mealType', $mealType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mealType = $this->MealTypes->newEntity();
        if ($this->request->is('post')) {
            $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());
            if ($this->MealTypes->save($mealType)) {
                $this->Flash->success(__('The meal type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The meal type could not be saved. Please, try again.'));
        }
        $this->set(compact('mealType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Meal Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mealType = $this->MealTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mealType = $this->MealTypes->patchEntity($mealType, $this->request->getData());
            if ($this->MealTypes->save($mealType)) {
                $this->Flash->success(__('The meal type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The meal type could not be saved. Please, try again.'));
        }
        $this->set(compact('mealType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Meal Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mealType = $this->MealTypes->get($id);
        if ($this->MealTypes->delete($mealType)) {
            $this->Flash->success(__('The meal type has been deleted.'));
        } else {
            $this->Flash->error(__('The meal type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
