<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * StudentClasses Controller
 *
 * @property \App\Model\Table\StudentClassesTable $StudentClasses
 *
 * @method \App\Model\Entity\StudentClass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentClassesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $order = $this->StudentClasses->find()->order(['order_of_class'=>'DESC'])->limit('1')->first();

        if($order)
        {
            $order = $order->order_of_class;
        }
        else
        {
            $order = 0;
        }
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $class = $this->StudentClasses->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $class = $this->StudentClasses->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $class = $this->StudentClasses->patchEntity($class, $this->request->getData());            
            if(!$id)
            {
                $class->created_by =$user_id;
                $class->session_year_id =$session_year_id;
            }
            else
            {
                $class->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->StudentClasses->save($class))
              {
                $this->Flash->success(__('The class has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry.';
            }
            else
            {
                 $error_data='The class has not been saved.';
            }
            
            $this->Flash->error(__($error_data));
        }
         $this->paginate = [
            'order' => ['id'=>'DESC'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $classes = $this->StudentClasses->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $classes->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('StudentClasses.name', '%'.$name.'%');
                });
            }
            $classes = $this->paginate($classes);
        }
        else
        {
            $classes = $this->paginate($this->StudentClasses);
        }
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('classes','class','id','status','order','name'));
    }

    public function getStreams()
    {
        $id = $this->request->getData('class_id');
        $success = 0;

        $response = $this->StudentClasses->ClassMappings->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])
                ->select(['id'=>'ClassMappings.stream_id','name'=>'Streams.name'])->contain(['Streams'])->where(['ClassMappings.student_class_id'=>$id,'stream_id !='=>0])->distinct('ClassMappings.stream_id');

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getGradeType()
    {
        $id = $this->request->getData('class_id');
        $success = 0;

        $response = $this->StudentClasses->get($id)->grade_type;

        if(!empty($response))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }
}
