<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubjectTypes Controller
 *
 * @property \App\Model\Table\SubjectTypesTable $SubjectTypes
 *
 * @method \App\Model\Entity\SubjectType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    // public function index()
    // {
    //     $this->paginate = [
    //         'contain' => ['SessionYears']
    //     ];
    //     $subjectTypes = $this->paginate($this->SubjectTypes);

    //     $this->set(compact('subjectTypes'));
    // }

    /**
     * View method
     *
     * @param string|null $id Subject Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id=null)
    // {
    //     $subjectType = $this->SubjectTypes->get($id, [
    //         'contain' => ['SessionYears', 'Subjects']
    //     ]);

    //     $this->set('subjectType', $subjectType);
    // }

    public function add($id=null)
    {
		$user_id = $this->Auth->User('id');
		
		$session_year_id = $this->Auth->User('session_year_id');
		if(!$id || $this->EncryptingDecrypting->decryptData($id) == 1)
		{				
			$subjectType = $this->SubjectTypes->newEntity();
			 
		}
		else
		{
			$id = $this->EncryptingDecrypting->decryptData($id);
			$subjectType = $this->SubjectTypes->get($id, [
							'contain' => []
			]);
		}
		if ($this->request->is(['patch', 'post', 'put']) && $id != 1) {  
			
            $subjectType = $this->SubjectTypes->patchEntity($subjectType, $this->request->getData());
			
			if(!$id)
			{
				$subjectType->created_by = $user_id;
				$session_year_id = $this->Auth->User('session_year_id');
			}
			else
			{
				$subjectType->edited_by	 = $user_id;
				
			}
			
			$error='';
            try 
            {
              if($this->SubjectTypes->save($subjectType))
              {
                $this->Flash->success(__('The subject type has been saved.'));
                return $this->redirect(['action' => 'add']);
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
                 $error_data='The Subject Type could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
		}

		$subjectTypes  = $this->SubjectTypes->find()->order(['SubjectTypes.name'=>'ASC']);
		$status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('subjectType', 'sessionYears','status','subjectTypes' ,'id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $subjectType = $this->SubjectTypes->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $subjectType = $this->SubjectTypes->patchEntity($subjectType, $this->request->getData());
    //         if ($this->SubjectTypes->save($subjectType)) {
    //             $this->Flash->success(__('The subject type has been saved.'));

    //             return $this->redirect(['action' => 'add']);
    //         }
    //         $this->Flash->error(__('The subject type could not be saved. Please, try again.'));
    //     }
    //     $sessionYears = $this->SubjectTypes->SessionYears->find('list', ['limit' => 200]);
    //     $this->set(compact('subjectType', 'sessionYears'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Subject Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //    // $this->request->allowMethod(['post', 'delete']);
    //     $subjectType = $this->SubjectTypes->get($id);
    //     if ($this->SubjectTypes->delete($subjectType)) {
    //         $this->Flash->success(__('The subject type has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The subject type could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
