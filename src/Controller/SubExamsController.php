<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubExams Controller
 *
 * @property \App\Model\Table\SubExamsTable $SubExams
 *
 * @method \App\Model\Entity\SubExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubExamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $subExam = $this->SubExams->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $subExam = $this->SubExams->get($id);
            $id = $this->EncryptingDecrypting->encryptData($id);
        }
        $this->paginate = [
            'contain' => ['ExamMasters']
        ];
        $subExams = $this->paginate($this->SubExams->find()->order(['SubExams.id','exam_master_id']));

        $data = $this->SubExams->ExamMasters->find();
        $data->select([
                        'id'=> 'ExamMasters.id',
                        'parent'=>'ParentExamMasters.name',
                        'name'=>'ExamMasters.name',
                        'class'=>'StudentClasses.name',
                    ])
                    ->where(['ExamMasters.rght-ExamMasters.lft'=>1,'ExamMasters.session_year_id'=>$session_year_id])
                    ->contain(['ParentExamMasters','StudentClasses'])->order(['StudentClasses.order_of_class','ExamMasters.student_class_id','ExamMasters.order_number']);

        foreach ($data as $key => $exam) {
            $id2 = $exam->id;
            $examMasters[$id2] = '';
            if(!empty($exam->class))
            {
                if(!empty($examMasters[$id2]))
                    $examMasters[$id2].=" > ";
                
                $examMasters[$id2].=$exam->class;
            }
            if(!empty($exam->parent))
            {
                if(!empty($examMasters[$id2]))
                    $examMasters[$id2].=" > ";
                
                $examMasters[$id2].=$exam->parent;
            }
            if(!empty($exam->name))
            {
                if(!empty($examMasters[$id2]))
                    $examMasters[$id2].=" > ";

                $examMasters[$id2].=$exam->name;
            }
        }

        $this->set(compact('subExams', 'subExam', 'examMasters','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Sub Exam id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subExam = $this->SubExams->get($id, [
            'contain' => ['ExamMasters', 'StudentMarks']
        ]);

        $this->set('subExam', $subExam);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $subExam = $this->SubExams->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $subExam = $this->SubExams->get($id);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subExam = $this->SubExams->patchEntity($subExam, $this->request->getData());

            if ($this->SubExams->save($subExam))
                $this->Flash->success(__('The sub exam has been saved.'));
            else
                $this->Flash->error(__('The sub exam could not be saved. Please, try again.'));

            return $this->redirect(['action' => 'index']);
        }
        $examMasters = $this->SubExams->ExamMasters->find('list')->where(['session_year_id'=>$session_year_id]);
        $this->set(compact('subExam', 'examMasters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sub Exam id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subExam = $this->SubExams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subExam = $this->SubExams->patchEntity($subExam, $this->request->getData());
            if ($this->SubExams->save($subExam)) {
                $this->Flash->success(__('The sub exam has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sub exam could not be saved. Please, try again.'));
        }
        $examMasters = $this->SubExams->ExamMasters->find('list', ['limit' => 200]);
        $this->set(compact('subExam', 'examMasters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sub Exam id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subExam = $this->SubExams->get($id);
        if ($this->SubExams->delete($subExam)) {
            $this->Flash->success(__('The sub exam has been deleted.'));
        } else {
            $this->Flash->error(__('The sub exam could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
