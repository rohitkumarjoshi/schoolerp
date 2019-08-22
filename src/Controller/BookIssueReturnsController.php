<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * BookIssueReturns Controller
 *
 * @property \App\Model\Table\BookIssueReturnsTable $BookIssueReturns
 *
 * @method \App\Model\Entity\BookIssueReturn[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookIssueReturnsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add','edit','index','fineCollection','report']);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $active_li='Library';
        $active_sub_li='issue_return';

        if($this->request->is('post'))
            $bookIssueReturn = $this->BookIssueReturns->newEntity($this->request->getData('data'));
        else
            $bookIssueReturn = $this->BookIssueReturns->newEntity();
        
        $this->paginate = [
            'contain' => ['Books', 'Students', 'SessionYears', 'Employees']
        ];

       if($this->request->is('post'))
        {
            $where = [];
            foreach ($this->request->getData('data') as $key => $v) {

                if ($key == 'issued')
                    $where[] = 'return_date IS NULL';

                if ($key == 'returned')
                    $where[] = 'return_date IS NOT NULL';

                if ($key == 'book_id' && !empty($v))
                    $where ['BookIssueReturns.book_id'] = $v;

                if ($key == 'student_id' && !empty($v))
                    $where ['BookIssueReturns.student_id'] = $v;

                if ($key == 'employee_id' && !empty($v))
                   $where ['BookIssueReturns.employee_id'] = $v;

                if(!empty($v))
                {
                    if ($key=='daterange' && !empty($v))
                    {

                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));

                        $where ['BookIssueReturns.date_from >='] = $date_from;
                        $where ['BookIssueReturns.date_from <='] = $date_to;
                    }

                    if (strpos($key, 'date_to') !== false)
                        $where[] = 'return_date IS NULL';

                    //$where ['BookIssueReturns.'.$key] = $v;
                }
            }
            
            $this->set(compact('where'));
            $bookIssueReturns = $this->paginate($this->BookIssueReturns->find()->where($where));
        }
        else
            $bookIssueReturns = $this->paginate($this->BookIssueReturns);

        $books = $this->BookIssueReturns->Books->find('list');
        $students = $this->BookIssueReturns->Students->find('list');
        $employees = $this->BookIssueReturns->Employees->find('list');
        $this->set(compact('active_li','active_sub_li','bookIssueReturn','bookIssueReturns', 'books', 'students', 'employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Book Issue Return id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $bookIssueReturn = $this->BookIssueReturns->get($id, [
    //         'contain' => ['Books', 'Students', 'SessionYears', 'Employees']
    //     ]);

    //     $this->set('bookIssueReturn', $bookIssueReturn);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $active_li='Library';
        $active_sub_li='issue';
        $bookIssueReturn = $this->BookIssueReturns->newEntity();
        $book = $this->BookIssueReturns->Books->newEntity();
        if ($this->request->is('post')) {
            foreach ($this->request->getData('book_id') as $key => $value) {

                $book_fine = $this->BookIssueReturns->BookFines->find()->where(['fine_for'=>$this->request->getData('issue_to')])->first();

                $data[$key]['book_id'] = $this->EncryptingDecrypting->decryptData($value);
                $data[$key]['date_from'] = date('Y-m-d');
                $data[$key]['date_to'] = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $book_fine->fine_after_days, date('Y')));
                $data[$key]['fine_amount_per_day'] = $book_fine->fine_amount_per_day;
                $data[$key]['created_by'] = $this->Auth->user('id');
                $data[$key]['session_year_id'] = $this->BookIssueReturns->SessionYears->find()->where(['status'=>'Active'])->first()->id;

                if($this->request->getData('issue_to') == 'Student')
                    $data[$key]['student_id'] = $this->request->getData('student_id');
                else
                    $data[$key]['employee_id'] = $this->request->getData('employee_id');
            }
            
            $bookIssueReturn = $this->BookIssueReturns->newEntities($data);
            
            if ($this->BookIssueReturns->saveMany($bookIssueReturn)) {
                $this->Flash->success(__('The books issued successfully.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unabled issue books. Please, try again.'));
        }
        $books = $this->BookIssueReturns->Books->find('list');
        $students = $this->BookIssueReturns->Students->find('list')->innerJoinWith('StudentInfos');
        //pr($students->toArray());exit;
        $sessionYears = $this->BookIssueReturns->SessionYears->find('list');
        $employees = $this->BookIssueReturns->Employees->find('list');
        $this->set(compact('active_li','active_sub_li','bookIssueReturn', 'books', 'students', 'sessionYears', 'employees','book'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Issue Return id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $active_li='Library';
        $active_sub_li='return';
        $bookIssueReturn = $this->BookIssueReturns->newEntity();
        $book = $this->BookIssueReturns->Books->newEntity();
        $book2 = $this->BookIssueReturns->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->getData('issue_id'));exit;
            foreach ($this->request->getData('issue_id') as $key => $value) {

                $id = $this->EncryptingDecrypting->decryptData($value['id']);
                $return_date = 'DATEDIFF(\''.date('Y-m-d',strtotime($value['return_date'])).'\', BookIssueReturns.date_to)';

                $issued_book = $issued_books = $this->BookIssueReturns->find()
                                ->select($this->BookIssueReturns)
                                ->select(['delay'=>$return_date])
                                ->where(['BookIssueReturns.id' => $id])->first();

                //pr($issued_book->toArray());exit;
                //re-issue book
                if(isset($value['reissue']))
                {
                    $reissue['book_id'] = $issued_book->book_id;
                    $reissue['student_id'] = $issued_book->student_id;
                    $reissue['employee_id'] = $issued_book->employee_id;
                    $reissue['issue_to'] = !empty($issued_book->employee_id)?'Employee':'Student';
                    $this->reissue($reissue);
                }

                $delay = $issued_book->delay>0?$issued_book->delay:'0';
                $total_fine = $issued_book->delay>0?($issued_book->delay*$issued_book->fine_amount_per_day):'0';

                //editing for entity
                $issued_book->late_day = $delay;
                $issued_book->fine_amount = $total_fine;
                if($total_fine > 0)
                    $issued_book->status = 'Unpaid';
                $issued_book->edited_by = $this->Auth->user('id');
                $issued_book->return_date = date('Y-m-d',strtotime($value['return_date']));

                $data[$key] = $issued_book->toArray();
            }
            
            $bookIssueReturn = $this->BookIssueReturns->patchEntities($bookIssueReturn,$data);
            //pr($bookIssueReturn);exit;
            
            if ($this->BookIssueReturns->saveMany($bookIssueReturn)) {
                $this->Flash->success(__('The books returned successfully.'));

                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error(__('Unabled return books. Please, try again.'));
        }

        $books = $this->BookIssueReturns->Books->find('list');
        $students = $this->BookIssueReturns->Students->find('list')->innerJoinWith('StudentInfos');
        $sessionYears = $this->BookIssueReturns->SessionYears->find('list');
        $employees = $this->BookIssueReturns->Employees->find('list');
        $this->set(compact('active_li','active_sub_li','bookIssueReturn', 'books', 'students', 'sessionYears', 'employees','book','book2'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Issue Return id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $bookIssueReturn = $this->BookIssueReturns->get($id);
    //     if ($this->BookIssueReturns->delete($bookIssueReturn)) {
    //         $this->Flash->success(__('The book issue return has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The book issue return could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function getBook()
    {
        if($this->BookIssueReturns->Books->exists(['Books.id'=>$this->request->getData('accession_no'),'is_deleted'=>'N']))
        {
            $data = $this->BookIssueReturns->Books->find()->where(['Books.id'=>$this->request->getData('accession_no'),'is_reserved'=>'No'])->contain(['BookCategories','BookIssueReturns'=>function($q){
                return $q->where(['return_date IS NULL']);
            }]);
            if(!empty($data->toArray()))
            {
                $book = $data->first();
                if(empty($book->book_issue_returns))
                {
                    $success = 1;
                    $response = "<tr><td class='index'>1</td><td>".$book->name." <input type='hidden' name='book_id[]' value='".$this->EncryptingDecrypting->encryptData($book->id)."'></td><td>".$book->author_name."</td><td>".$book->edition."</td><td>".$book->volume."</td><td>".$book->total_page."</td><td>".$book->book_condition."</td><td>".(!empty($book->book_category)?$book->book_category->name:'')."</td><td>".$book->price."</td><td class='book_no'>".$book->id."</td><td class='actions'><a class='remove_book btn btn-xs btn-danger'>X</a></td></tr>";
                }
                else{
                    $success = 0;
                    $response = "Book is already issued";
                }
            }
            else{
                $success = 0;
                $response = "Book is reserved";
            }
        }
        else{
            $success = 0;
            $response = "No Such Book Found";
        }
        $this->set(compact('book','success','response'));
        $this->set('_serialize', ['success','response','book']);
    }

    public function getBookByAccession()
    {
        $book = $this->BookIssueReturns->Books->find()
                ->where(['Books.id'=>$this->request->getData('accession_no')])
                ->contain(['BookCategories'])->first();
        $id = $book->id;

        if($this->BookIssueReturns->exists(['book_id'=>$id,'return_date IS NULL']))
        {
            $issued_book = $this->BookIssueReturns->find()
                            ->select($this->BookIssueReturns)
                            ->select(['delay'=>'DATEDIFF(NOW(), BookIssueReturns.date_to)'])
                            ->where(['book_id'=>$id,'return_date IS NULL'])
                            ->contain(['Books'=>'BookCategories','Employees','Students'])->enableAutoFields('ture')->first();
            $delay = ($issued_book->delay>0?$issued_book->delay:'0');
            $total_fine = ($issued_book->delay>0?($issued_book->delay*$issued_book->fine_amount_per_day):'0');
            $success = 1;
            $response = "<tr><td class='index'>1</td><td>".$issued_book->book->name." <input class='issue_id' type='hidden' name='' value='".$this->EncryptingDecrypting->encryptData($issued_book->id)."'></td><td class='book_no'>".$book->id."</td><td>".$issued_book->book->price."</td><td>".(!empty($issued_book->student_id)?$issued_book->student->name:$issued_book->employee->name)."</td><td>".date('d-m-Y',strtotime($issued_book->date_from))."</td><td>".date('d-m-Y',strtotime($issued_book->date_to))."</td><td><input type='text' class='form-control datepicker' data-date-format='dd-mm-yyyy' data-date-start-date='".$issued_book->date_from."' required='required'><td><label class='checkbox-inline'><input class='reissue' name='' type='checkbox' value='yes'>Re Issue</label></td><td class='actions'><a class='remove_book btn btn-xs btn-danger'>X</a></td></tr>";
        }
        else{
            $success = 0;
            $response = "Book is not issued";
        }
        $this->set(compact('issued_book','success','response'));
        $this->set('_serialize', ['success','response','issued_book']);
    }

    public function getBookByUser()
    {
        $field = null;
        $value = null;
        $response = null;
        foreach ($this->request->getData() as $key => $v) {
            $field = $key;
            $value = $v;
        }
        if($this->BookIssueReturns->exists([$field => $value,'return_date IS NULL']))
        {
            $issued_books = $this->BookIssueReturns->find()
                            ->select($this->BookIssueReturns)
                            ->select(['delay'=>'DATEDIFF(NOW(), BookIssueReturns.date_to)'])
                            ->where([$field => $value,'return_date IS NULL'])
                            ->contain(['Books'=>'BookCategories','Employees','Students'])->enableAutoFields('ture');
           
            foreach ($issued_books as $key => $issued_book) {

                $delay = ($issued_book->delay>0?$issued_book->delay:'0');
                $total_fine = ($issued_book->delay>0?($issued_book->delay*$issued_book->fine_amount_per_day):'0');
                //echo $issued_book->book->name;exit;
                $success = 1;
                $response.= "<tr><td class='index'>1</td><td>".$issued_book->book->name." <input class='issue_id' type='hidden' name='' value='".$this->EncryptingDecrypting->encryptData($issued_book->id)."'></td><td class='book_no'>".$issued_book->book->id."</td><td>".$issued_book->book->price."</td><td>".(!empty($issued_book->student_id)?$issued_book->student->name:$issued_book->employee->name)."</td><td>".date('d-m-Y',strtotime($issued_book->date_from))."</td><td>".date('d-m-Y',strtotime($issued_book->date_to))."</td><td><input type='text' class='form-control datepicker' data-date-format='dd-mm-yyyy' data-date-start-date='".$issued_book->date_from."' required='required'></td><td><label class='checkbox-inline'><input class='reissue' name='' type='checkbox' value='yes'>Re Issue</label></td><td class='actions'><a class='remove_book btn btn-xs btn-danger'>X</a></td></tr>";
            }
        }
        else{
            $success = 0;
            $response = "No book issued";
        }
        $this->set(compact('issued_book','success','response'));
        $this->set('_serialize', ['success','response','issued_book']);
    }

    public function getFine()
    {
        $field = null;
        $value = null;
        $response = null;
        foreach ($this->request->getData() as $key => $v) {
            $field = $key;
            $value = $v;
        }
        if($this->BookIssueReturns->exists([$field => $value,'return_date IS NOT NULL','Status'=>'Unpaid']))
        {
            $issued_books = $this->BookIssueReturns->find()
                            ->select($this->BookIssueReturns)
                            ->where([$field => $value,'return_date IS NOT NULL','Status'=>'Unpaid'])
                            ->contain(['Books'=>'BookCategories','Employees','Students'])->enableAutoFields('ture');
           
            foreach ($issued_books as $key => $issued_book) {

                $total_fine = $issued_book->fine_amount;
                //echo $issued_book->book->name;exit;
                $success = 1;
                $response.= "<tr><td class='index'>1</td><td>".$issued_book->book->name." <input class='issue_id' type='hidden' name='' value='".$this->EncryptingDecrypting->encryptData($issued_book->id)."'></td><td class='book_no'>".$issued_book->book->accession_no."</td><td>".(!empty($issued_book->student_id)?$issued_book->student->name:$issued_book->employee->name)."</td><td>".date('d-m-Y',strtotime($issued_book->date_from))."</td><td>".date('d-m-Y',strtotime($issued_book->date_to))."</td><td>".date('d-m-Y',strtotime($issued_book->return_date))."</td><td>".$issued_book->late_day."</td><td class='fine_amount'>".$total_fine."</td><td>".($total_fine>0?'<input class=\'fine_check\' name=\'\' type=\'checkbox\' value=\'paid\'>':'')."</td><td class='actions'><a class='remove_book btn btn-xs btn-danger'>X</a></td></tr>";
            }
        }
        else{
            $success = 0;
            $response = "No Due Found";
        }
        $this->set(compact('issued_book','success','response'));
        $this->set('_serialize', ['success','response','issued_book']);
    }

    public function reissue($data)
    {
        $bookIssueReturn = $this->BookIssueReturns->newEntity();
        $bookIssueReturn = $this->BookIssueReturns->patchEntity($bookIssueReturn,$data);

        $book_fine = $this->BookIssueReturns->BookFines->find()->where(['fine_for'=>$data['issue_to']])->first();

        $bookIssueReturn->date_from = date('Y-m-d');
        $bookIssueReturn->date_to = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + $book_fine->fine_after_days, date('Y')));
        $bookIssueReturn->fine_amount_per_day = $book_fine->fine_amount_per_day;
        $bookIssueReturn->created_by = $this->Auth->user('id');
        $bookIssueReturn->session_year_id = $this->BookIssueReturns->SessionYears->find()->where(['status'=>'Active'])->first()->id;
        
        if ($this->BookIssueReturns->save($bookIssueReturn))
            return true;

        return false;
    }

    public function fineCollection()
    {
        $active_li='Library';
        $active_sub_li='fine_collection';

        $bookIssueReturn = $this->BookIssueReturns->newEntity();
        if($this->request->is(['post']))
        {
            $is_submit = False;
            if(@$this->request->getData('book_fine'))
            {

                foreach ($this->request->getData('book_fine') as $key => $value) {
                    $id = $this->EncryptingDecrypting->decryptData($value['id']);

                    if (isset($value['fine'])) {
                        $is_submit = True;
                        $data = $this->BookIssueReturns->get($id);
                        $data->status = 'Paid';
                        $data->payment_date = date('Y-m-d');
                        $submit[$key] = $data;
                    }
                }
                if($is_submit)
                {
                    if($this->BookIssueReturns->saveMany($submit))
                        $this->Flash->success('Fine Submited');
                    else
                        $this->Flash->error('Unable To Submited Fine');
                }
            }
        }
        $this->set(compact('active_li','active_sub_li','bookIssueReturn'));
    }

    public function report($value='')
    {
        $active_li='Library';
        $active_sub_li='fine_report';

        $bookIssueReturn = $this->BookIssueReturns->newEntity();
        $where = [];
        if($this->request->is(['post']))
        {
            foreach ($this->request->getData('data') as $key => $v) {
                if(!empty($v))
                {
                    if ($key=='payment_date' && !empty($v))
                    {
                        $daterange=explode('/',$v);
                        $date_from=date('Y-m-d',strtotime($daterange[0]));
                        $date_to=date('Y-m-d',strtotime($daterange[1]));

                        $where ['BookIssueReturns.payment_date >='] = $date_from;
                        $where ['BookIssueReturns.payment_date <='] = $date_to;
                    }
                    else
                    {
                        $where ['BookIssueReturns.'.$key] = $v;
                    }
                    
                }
            }
            $this->set(compact('where'));
        }
        $books = $this->BookIssueReturns->Books->find('list');
        $bookIssueReturns = $this->paginate($this->BookIssueReturns->find()->where([$where,'fine_amount >'=>0])->contain(['Books','Students','Employees']));
        $this->set(compact('active_li','active_sub_li','bookIssueReturn','bookIssueReturns','books'));
    }

    public function export()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $bookIssueReturns = $this->BookIssueReturns->find()->where($this->request->getData('BookIssueReturns'))->contain(['Books', 'Students', 'SessionYears', 'Employees']);

        $this->set(compact('bookIssueReturns'));
    }

    public function fineExport()
    {
        $this->viewBuilder()->setLayout('pdf');

        $bookIssueReturns = $this->paginate($this->BookIssueReturns->find()->where([$this->request->getData('BookIssueReturns'),'fine_amount >'=>0])->contain(['Books','Students','Employees']));

        $this->set(compact('bookIssueReturns'));
    }
}
