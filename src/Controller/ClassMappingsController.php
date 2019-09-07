<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * ClassMappings Controller
 *
 * @property \App\Model\Table\ClassMappingsTable $ClassMappings
 *
 * @method \App\Model\Entity\ClassMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClassMappingsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
        $this->Security->setConfig('unlockedActions', ['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	 
	 public function classmappingexcel(){
		 
		$this->viewBuilder()->layout(''); 
		$classMappings=$this->ClassMappings->find()->contain(['StudentClasses', 'Mediums', 'Streams', 'Sections', 'Employees']);
		
		$this->set(compact('classMappings'));
		 
	 }
	 
	 
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $classMapping = $this->ClassMappings->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $classMapping = $this->ClassMappings->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $classMapping = $this->ClassMappings->patchEntity($classMapping, array_filter($this->request->getData()));            
            if(!$id)
            {
                $classMapping->created_by =$user_id;
                $classMapping->session_year_id =$session_year_id;
            }
            else
            {
                $classMapping->edited_by =$user_id;
            }
            $error='';
            
            try 
            {
              if($this->ClassMappings->save($classMapping))
              {
                $this->Flash->success(__('The class mapping has been saved.'));
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
                $error_data='The class mapping could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data."\n".$error));
        }
        $this->paginate = [
            'contain' => ['StudentClasses', 'Mediums', 'Streams', 'Sections', 'Employees'],
            'limit'=>10,
            'conditions'=>['ClassMappings.session_year_id'=>$session_year_id]
        ];
        if ($this->request->getQuery('search')) 
        { 
            $classMappings = $this->ClassMappings->find();
            if(!empty($this->request->getQuery('medium_id')))
            {
                $medium_id = $this->request->getQuery('medium_id');
                $classMappings->where(['ClassMappings.medium_id'=>$medium_id]);
                
            }
            if(!empty($this->request->getQuery('stream_id')))
            {
                $stream_id = $this->request->getQuery('stream_id');
                $classMappings->where(['ClassMappings.stream_id'=>$stream_id]);
                
            }
            if(!empty($this->request->getQuery('section_id')))
            {
                $section_id = $this->request->getQuery('section_id');
                $classMappings->where(['ClassMappings.section_id'=>$section_id]);
                
            }
            if(!empty($this->request->getQuery('student_class_id')))
            {
                $student_class_id = $this->request->getQuery('student_class_id');
                $classMappings->where(['ClassMappings.student_class_id'=>$student_class_id]);
                
            }
            if(!empty($this->request->getQuery('employee_id')))
            {
                $employee_id = $this->request->getQuery('employee_id');
                $classMappings->where(['ClassMappings.employee_id'=>$employee_id]);
                
            }
            $classMappings = $this->paginate($classMappings);
        }
        else
        {
            $classMappings = $this->paginate($this->ClassMappings);
        }

        $studentClasses = $this->ClassMappings->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $mediums = $this->ClassMappings->Mediums->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->ClassMappings->Streams->find('list')->where(['is_deleted'=>'N']);
        $sections = $this->ClassMappings->Sections->find('list')->where(['is_deleted'=>'N']);
        $employees = $this->ClassMappings->Employees->find('list')->where(['is_deleted'=>'N']);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('classMapping', 'classMappings', 'studentClasses', 'mediums', 'streams', 'sections','id','status','employees','medium_id','stream_id','section_id','employee_id','student_class_id'));
    }

    public function getClasses()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $where['ClassMappings.is_deleted'] = 'N';
        $where['ClassMappings.session_year_id'] = $session_year_id;
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }

        $success = 0;

        $response = $this->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->select(['id'=>'ClassMappings.student_class_id','name'=>'StudentClasses.name'])->contain(['StudentClasses'])
        ->where([$where,'student_class_id !='=>0])->order('StudentClasses.order_of_class')
        ->distinct('student_class_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getStreams()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $where['ClassMappings.is_deleted'] = 'N';
        $where['ClassMappings.session_year_id'] = $session_year_id;
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        $success = 0;
        $response = $this->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->select(['id'=>'ClassMappings.stream_id','name'=>'Streams.name'])->contain(['Streams'])
        ->where([$where,'stream_id !='=>0])
        ->distinct('stream_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getSections()
    {
        $session_year_id = $this->Auth->User('session_year_id');
        $where['ClassMappings.is_deleted'] = 'N';
        $where['ClassMappings.session_year_id'] = $session_year_id;
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value))
                $where[$key] = $value;
        }
        $success = 0;
        $response = $this->ClassMappings->find('list',[
            'keyField' => 'id',
            'valueField' => 'name'
        ])->select(['id'=>'ClassMappings.section_id','name'=>'Sections.name'])->contain(['Sections'])
        ->where([$where,'section_id !='=>0])
        ->distinct('section_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
}
