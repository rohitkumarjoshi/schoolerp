<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReservationCategories Controller
 *
 * @property \App\Model\Table\ReservationCategoriesTable $ReservationCategories
 *
 * @method \App\Model\Entity\ReservationCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationCategoriesController extends AppController
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
			$reservationCategory = $this->ReservationCategories->newEntity();
		}
		else{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$reservationCategory = $this->ReservationCategories->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $reservationCategory =  $this->ReservationCategories->patchEntity($reservationCategory, $this->request->getData());
			if(!$id)
            {
                $reservationCategory->created_by =$user_id;
            }
            else
            {
                $reservationCategory->edited_by =$user_id;
            }
			$error='';
			try 
            {
				if ($this->ReservationCategories->save($reservationCategory)) {
					$this->Flash->success(__('The reservation category has been saved.'));
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
                 $error_data='The reservation category could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
		$ReservationCategories  = $this->paginate($this->ReservationCategories->find()->order(['id'=>'DESC']),['limit'=>20]);
        $this->set(compact('reservationCategory','id','ReservationCategories','status'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservationCategory = $this->ReservationCategories->get($id, [
            'contain' => ['StudentInfos']
        ]);

        $this->set('reservationCategory', $reservationCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservationCategory = $this->ReservationCategories->newEntity();
        if ($this->request->is('post')) {
            $reservationCategory = $this->ReservationCategories->patchEntity($reservationCategory, $this->request->getData());
            if ($this->ReservationCategories->save($reservationCategory)) {
                $this->Flash->success(__('The reservation category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation category could not be saved. Please, try again.'));
        }
        $this->set(compact('reservationCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservationCategory = $this->ReservationCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservationCategory = $this->ReservationCategories->patchEntity($reservationCategory, $this->request->getData());
            if ($this->ReservationCategories->save($reservationCategory)) {
                $this->Flash->success(__('The reservation category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation category could not be saved. Please, try again.'));
        }
        $this->set(compact('reservationCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservationCategory = $this->ReservationCategories->get($id);
        if ($this->ReservationCategories->delete($reservationCategory)) {
            $this->Flash->success(__('The reservation category has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
