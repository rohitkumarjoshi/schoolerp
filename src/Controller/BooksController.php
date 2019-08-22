<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\View\View;
use Cake\View\Helper\FormHelper;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
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
    public function index()
    {
        $head_title = 'Books';
        $active_li='Library';
        $active_sub_li='book';

        $book = $this->Books->newEntity();
        $where['Books.is_deleted'] = 'N';

        foreach ($this->request->getData() as $key => $v) {
            if(!empty($v))
            {
                $where['Books.'.$key] = $v;
            }
        }

        
        $this->paginate = [
            'contain' => ['StudentClasses', 'BookCategories', 'Subjects'],
            'order' => ['id'=>'DESC']
        ];

        $books = $this->paginate($this->Books->find()->where($where));

        $bookCategories = $this->Books->BookCategories->find('list');

        $subjects = $this->Books->Subjects->find('list', [
                'keyField' => 'id',
                'valueField' => 'concatenated'
            ])->innerJoinWith('StudentClasses')->leftJoinWith('Streams');

             $subjects->select(['id','concatenated' =>$subjects->func()->CONCAT_WS([' -> ',
                'Subjects.name' => 'identifier',
                'StudentClasses.name' => 'identifier',
                'Streams.name' => 'identifier',
            ])]);

        $names[@$books->first()->name] = @$books->first()->name;
        $authors[@$books->first()->author_name] = @$books->first()->author_name;
        $publishers[@$books->first()->publisher] = @$books->first()->publisher;

        if($this->request->is('post'))
            $this->set(compact('where'));

        $this->set(compact('books','book','bookCategories','subjects'));
    }
    public function barcodeGenerate()
    {
        
        /*$books = $this->Books->find('list', [
                'keyField' => 'id',
                'valueField' => 'id'
            ]);*/
        $this->set(compact('books'));
    }
    public function barcodePrint()
    {
        $this->viewBuilder()->setLayout('');
        if ($this->request->is('post')) {
            if($this->request->getData('range')=='Generate')
            {
                $accession_from=$this->request->getData('accession_from');
                $accession_to=$this->request->getData('accession_to');
                $books=$this->Books->find()->select(['id','name'])->where(function (QueryExpression $exp, Query $q) use($accession_from,$accession_to) {
                    return $exp->between('Books.id',$accession_from,$accession_to);
                });
            }
            else if($this->request->getData('custome')=='Generate')
            {
                $accession_no=explode(',',$this->request->getData('accession_no'));
               
                $books=$this->Books->find()->select(['id','name'])->where(['Books.id IN'=>$accession_no]);
            }

        }
        $this->set(compact('books'));
    }
    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $active_li='Library';
        $active_sub_li='book';
        $head_title = 'View Book';
        $id = $this->EncryptingDecrypting->decryptData($id);
        $book = $this->Books->get($id, [
            'contain' => ['Mediums','StudentClasses', 'BookCategories', 'Subjects', 'BookIssueReturns']
        ]);

        $this->set(compact('active_li','active_sub_li','book','head_title'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $active_li='Library';
        $active_sub_li='book';
        $user_id = $this->Auth->User('id');
        $head_title = 'Add Book';
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $lastAccession = @$this->Books->find('all')->limit('1')->order(['id'=>'Desc'])->first()->accession_no;

            for ($i=0; $i < $this->request->getData('quantity'); $i++) { 
                $data[$i] = $this->request->getData();
                $data[$i]['created_by'] = $user_id;
                $data[$i]['accession_no'] = $lastAccession + 1 + $i;
            }

            $book = $this->Books->newEntities($data);

            if ($this->Books->saveMany($book)) {
                
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $mediums = $this->Books->Mediums->find('list');
        $bookCategories = $this->Books->BookCategories->find('list');
        //$subjects = $this->Books->Subjects->find('list');
        $this->set(compact('active_li','active_sub_li','book', 'mediums', 'bookCategories'));
    }
    public function getSubject()
    {
        $form = new FormHelper(new \Cake\View\View());
        $student_class_id=$this->request->getData('student_class_id');
        $success='1';
        //$subjects = $this->Books->Subjects->find('list')->where(['student_class_id'=>$student_class_id]);
         $subjects = $this->Books->Subjects->find('list', [
                'keyField' => 'id',
                'valueField' => 'concatenated'
            ])->leftJoinWith('Streams');

             $subjects->select(['id','concatenated' =>$subjects->func()->CONCAT_WS([' -> ',
                'Subjects.name' => 'identifier',
                'Streams.name' => 'identifier',
            ])])
             ->where(['Subjects.student_class_id'=>$student_class_id]);
        $response=$form->control('subject_id',[
                                'label' => false,'class'=>'select2','empty'=>'---Select Subject---','options'=>$subjects,'id'=>'subject_id','style'=>'width:100%']);
        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $active_li='Library';
        $active_sub_li='book';
        $head_title = 'Edit Book';
        $id = $this->EncryptingDecrypting->decryptData($id);
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $mediums = $this->Books->Mediums->find('list');
        $studentClasses = $this->Books->StudentClasses->find('list');
        $bookCategories = $this->Books->BookCategories->find('list');
        $subjects = $this->Books->Subjects->find('list')->where(['student_class_id'=>$book->student_class_id]);
        $this->set(compact('active_li','active_sub_li','book', 'studentClasses', 'bookCategories', 'subjects','mediums'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        $book->is_deleted = 'Y';
        if ($this->Books->save($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function opac()
    {
        $active_li='Library';
        $active_sub_li='book';

        foreach ($this->request->getData() as $key => $v) {
            if(!empty($v))
            {
                $where ['Books.'.$key] = $v;
            }
        }

        $book = $this->Books->newEntity();
        if($this->request->is('post'))
        {
            $books = $this->Books->find()->leftJoinWith('BookIssueReturns',function($q){
                        return $q->where(['return_date IS NULL']);
                    })
                    ->where($where)->order(['BookIssueReturns.id'=>'ASC'])
                    ->contain([
                        'BookIssueReturns','BookCategories','Subjects']);
                    
            $this->set(compact('books'));
        }
        else
        {
            unset($books);
        }

        $bookCategories = $this->Books->BookCategories->find('list');
        $subjects = $this->Books->Subjects->find('list');
        $this->set(compact('active_li','active_sub_li','book', 'studentClasses', 'bookCategories', 'subjects'));
    }

    public function getBook()
    {
        $value = $this->request->getData('value');
        $field = !empty(@$this->request->getData('field'))?$this->request->getData('field'):'name';
        $key = !empty(@$this->request->getData('key'))?$this->request->getData('key'):'id';
        $table = $this->request->getData('table');

        $Table = TableRegistry::get($table); // Prior to 3.6.0
        //$Table = TableRegistry::getTableLocator()->get($table);
        $response = $Table->find()->select(['key'=>$key,'text'=>$field])->where([$field.' LIKE'=>'%'.$value.'%'])->distinct($field)->where([$field.' IS NOT NULL']);
        
        $this->set(compact('success','response'));
        $this->set('_serialize', ['response']);
    }

    public function bookExport()
    {     
        $this->viewBuilder()->setLayout('pdf');
        if(($this->request->getData('Books')))
        {
            $where['Books.is_deleted'] = 'N';
            foreach ($this->request->getData('Books') as $key => $v) {
                if(!empty($v))
                {
                    $where['Books.'.$key] = $v;
                }
            }
            $books = $this->Books->find()->where($where)->contain(['BookCategories']);
        }
        else
            $books = $this->Books->find('all')->where(['is_deleted'=>'N'])->contain(['BookCategories']);

        //pr($books->toArray());exit;

        $this->set(compact('books'));
    }
}
