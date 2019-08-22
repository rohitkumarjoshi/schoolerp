<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Expenses Controller
 *
 * @property \App\Model\Table\ExpensesTable $Expenses
 *
 * @method \App\Model\Entity\Expense[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExpensesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $title='View Expenses';
        
        $expense = $this->Expenses->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
            {
                $vehicle_id = $this->request->getQuery('vehicle_id');
                $category_id = $this->request->getQuery('category_id');
                $sub_category_id = $this->request->getQuery('sub_category_id');
                if(!empty($vehicle_id)){
                    $conditions['Expenses.vehicle_id']=$vehicle_id;
                }
                if(!empty($category_id)){
                    $conditions['Expenses.expense_category_id']=$category_id;   
                }
                if(!empty($sub_category_id)){
                    $conditions['Expenses.expense_subcategory_id']=$sub_category_id;   
                }
                $conditions['Expenses.is_deleted']='N';
                $this->paginate = [
                'contain' => ['ExpenseCategories', 'ExpenseSubcategories', 'Vehicles','Employees']
                ];
                $expenses = $this->paginate($this->Expenses->find()->where($conditions));
                if(!empty($expenses->toArray()))
                  {
                    $data_exist='data_exist';
                  }
                  else{
                    $data_exist='No Record Found';
                  }  
            }

        //pr($expenses->toArray());exit;
        $employees = $this->Expenses->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $expenseCategories = $this->Expenses->ExpenseCategories->find('list');
        $expenseSubcategories = $this->Expenses->ExpenseSubcategories->find('list');
        $vehicles = $this->Expenses->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $this->set(compact('head_title','employees','expenses', 'expenseCategories', 'expenseSubcategories', 'vehicles','data_exist','expense'));
    }

    /**
     * View method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id = $this->EncryptingDecrypting->decryptData($id);
        $expense = $this->Expenses->get($id, [
            'contain' => ['ExpenseCategories', 'ExpenseSubcategories', 'Vehicles']
        ]);

        $this->set('expense', $expense);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $head_title='Add Expense';
        $expense = $this->Expenses->newEntity();
        if ($this->request->is('post')) {
            $expense = $this->Expenses->patchEntity($expense, $this->request->getData());
            $expense->expense_date=date('Y-m-d',strtotime($this->request->getData('expense_date')));
            $expense->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
            if ($this->Expenses->save($expense)) {
                $this->Flash->success(__('The expense has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $employees = $this->Expenses->Employees->find('list');
        $expenseCategories = $this->Expenses->ExpenseCategories->find('list');
        $expenseSubcategories = $this->Expenses->ExpenseSubcategories->find('list');
        $vehicles = $this->Expenses->Vehicles->find('list');
        $this->set(compact('head_title','employees','expense', 'expenseCategories', 'expenseSubcategories', 'vehicles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $head_title='Edit Expense';
        $id = $this->EncryptingDecrypting->decryptData($id);
        $expense = $this->Expenses->get($id, [
        'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        $expense = $this->Expenses->patchEntity($expense, $this->request->getData());
        $expense->expense_date=date('Y-m-d',strtotime($this->request->getData('expense_date')));
        $expense->cheque_date=date('Y-m-d',strtotime($this->request->getData('cheque_date')));
        if ($this->Expenses->save($expense)) {
            $this->Flash->success(__('The expense has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The expense could not be saved. Please, try again.'));
        }
        $employees = $this->Expenses->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $expenseCategories = $this->Expenses->ExpenseCategories->find('list');
        $expenseSubcategories = $this->Expenses->ExpenseSubcategories->find('list');
        $vehicles = $this->Expenses->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('employees','expense', 'expenseCategories', 'expenseSubcategories', 'vehicles','head_title','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Expense id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expense = $this->Expenses->get($id);
        if ($this->Expenses->delete($expense)) {
            $this->Flash->success(__('The expense has been deleted.'));
        } else {
            $this->Flash->error(__('The expense could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
     public function report()
    {
        $expense = $this->Expenses->newEntity();
        $where = [];
        $data_exist='';
        if(!empty($this->request->getQuery('data')))
            {
                $vehicle_id = $this->request->getQuery('vehicle_id');
                $category_id = $this->request->getQuery('category_id');
                $sub_category_id = $this->request->getQuery('sub_category_id');
                if(!empty($vehicle_id)){
                    $conditions['Expenses.vehicle_id']=$vehicle_id;
                }
                if(!empty($category_id)){
                    $conditions['Expenses.expense_category_id']=$category_id;   
                }
                if(!empty($sub_category_id)){
                    $conditions['Expenses.expense_subcategory_id']=$sub_category_id;   
                }
                $conditions['Expenses.is_deleted']='N';
                $this->paginate = [
                'contain' => ['ExpenseCategories', 'ExpenseSubcategories', 'Vehicles','Employees']
                ];
                $expenses = $this->paginate($this->Expenses->find()->where($conditions));
                if(!empty($expenses->toArray()))
                  {
                    $data_exist='data_exist';
                  }
                  else{
                    $data_exist='No Record Found';
                  }  
            }

        //pr($expenses->toArray());exit;
        $employees = $this->Expenses->Employees->find('list')->where(['Employees.is_deleted'=>'N']);
        $expenseCategories = $this->Expenses->ExpenseCategories->find('list');
        $expenseSubcategories = $this->Expenses->ExpenseSubcategories->find('list');
        $vehicles = $this->Expenses->Vehicles->find('list')->where(['Vehicles.is_deleted'=>'N']);
        $this->set(compact('employees','expenses', 'expenseCategories', 'expenseSubcategories', 'vehicles','data_exist','expense'));
    }
     public function reportExport()
    {
        $this->viewBuilder()->setLayout('pdf');
        
        $expenses = $this->Expenses->find()->where($this->request->getData('Expenses'))->contain(['ExpenseCategories', 'ExpenseSubcategories', 'Vehicles','Employees']);

        $this->set(compact('expenses'));
    }

}
