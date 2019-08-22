<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * DocumentClassMappings Controller
 *
 * @property \App\Model\Table\DocumentClassMappingsTable $DocumentClassMappings
 *
 * @method \App\Model\Entity\DocumentClassMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentClassMappingsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['getDocument']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id= null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id){
                    $documentClassMapping = $this->DocumentClassMappings->newEntity();
                }
          else{
                $id = $this->EncryptingDecrypting->decryptData($id);
                $documentClassMapping = $this->DocumentClassMappings->get($id, [
                    'contain' => []
                 ]);
            
             }
            if ($this->request->is(['patch', 'post', 'put']))
            {  
                $documentClassMapping = $this->DocumentClassMappings->patchEntity($documentClassMapping, $this->request->getData());
                $documentClassMapping->session_year_id =$session_year_id;
                if(!$id)
                {
                    $documentClassMapping->created_by =$user_id;
                }
                else
                {
                    $documentClassMapping->edited_by =$user_id;

                }
                $error='';
                 try 
                {
                    if ($this->DocumentClassMappings->save($documentClassMapping)) 
                    {
                        $this->Flash->success(__('The document class mapping has been saved.'));
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
                    $error_data='The document class mapping could not be saved. Please, try again.';
                }
                //pr($employee);exit;
                $this->Flash->error(__($error_data));
            }
        $documents = $this->DocumentClassMappings->Documents->find('list');
        $studentClasses = $this->DocumentClassMappings->StudentClasses->find('list')->order(['order_of_class'=>'ASC']);
      
        $this->paginate = [
            'contain' => ['Documents', 'StudentClasses'],
            'limit'=>10,
        ];
        if ($this->request->getQuery('search')) 
        { 
            $documentClassMappings = $this->DocumentClassMappings->find();
            if(!empty($this->request->getQuery('document_id')))
            {
                $document_id = $this->request->getQuery('document_id');
                $documentClassMappings->where(['DocumentClassMappings.document_id'=>$document_id]);
                
            }
            if(!empty($this->request->getQuery('student_class_id')))
            {
                $student_class_id = $this->request->getQuery('student_class_id');
                $documentClassMappings->where(['DocumentClassMappings.student_class_id'=>$student_class_id]);
            }
            $documentClassMappings = $this->paginate($documentClassMappings);
        }
        else
        {
            $documentClassMappings = $this->paginate($this->DocumentClassMappings);
        }
        $status=['Y'=>'Deactive','N'=>'Active'];
          $this->set(compact('documentClassMappings','documentClassMapping', 'id', 'documents', 'studentClasses','status','student_class_id','document_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Document Class Mapping id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $documentClassMapping = $this->DocumentClassMappings->get($id, [
            'contain' => ['SessionYears', 'Documents', 'StudentClasses', 'StudentDocuments']
        ]);
        $this->set('documentClassMapping', $documentClassMapping);
    }
    public function getDocument()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is('post')) {
            $student_class_id=$this->request->getData('student_class_id');
            $documentClassMappings = $this->DocumentClassMappings->find()->where(['student_class_id'=>$student_class_id,'DocumentClassMappings.session_year_id'=>$session_year_id,'DocumentClassMappings.is_deleted'=>'N'])->contain(['Documents']);
            $this->set(compact('documentClassMappings'));
        }
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $documentClassMapping = $this->DocumentClassMappings->newEntity();
        if ($this->request->is('post')) {
            $documentClassMapping = $this->DocumentClassMappings->patchEntity($documentClassMapping, $this->request->getData());
            if ($this->DocumentClassMappings->save($documentClassMapping)) {
                $this->Flash->success(__('The document class mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The document class mapping could not be saved. Please, try again.'));
        }
        $sessionYears = $this->DocumentClassMappings->SessionYears->find('list', ['limit' => 200]);
        $documents = $this->DocumentClassMappings->Documents->find('list', ['limit' => 200]);
        $studentClasses = $this->DocumentClassMappings->StudentClasses->find('list', ['limit' => 200]);
        $this->set(compact('documentClassMapping', 'sessionYears', 'documents', 'studentClasses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Document Class Mapping id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $documentClassMapping = $this->DocumentClassMappings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $documentClassMapping = $this->DocumentClassMappings->patchEntity($documentClassMapping, $this->request->getData());
            if ($this->DocumentClassMappings->save($documentClassMapping)) {
                $this->Flash->success(__('The document class mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The document class mapping could not be saved. Please, try again.'));
        }
        $sessionYears = $this->DocumentClassMappings->SessionYears->find('list', ['limit' => 200]);
        $documents = $this->DocumentClassMappings->Documents->find('list', ['limit' => 200]);
        $studentClasses = $this->DocumentClassMappings->StudentClasses->find('list', ['limit' => 200]);
        $this->set(compact('documentClassMapping', 'sessionYears', 'documents', 'studentClasses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document Class Mapping id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $documentClassMapping = $this->DocumentClassMappings->get($id);
        if ($this->DocumentClassMappings->delete($documentClassMapping)) {
            $this->Flash->success(__('The document class mapping has been deleted.'));
        } else {
            $this->Flash->error(__('The document class mapping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
