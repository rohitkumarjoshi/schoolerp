<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * StudentMarks Controller
 *
 * @property \App\Model\Table\StudentMarksTable $StudentMarks
 *
 * @method \App\Model\Entity\StudentMark[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentMarksController extends AppController
{
    private $array = [];
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->request->getParam('_ext') == 'json') 
        {
            $this->Security->setConfig('unlockedActions', [$this->request->getParam('action')]);
        }

        $this->Security->setConfig('unlockedActions', ['add','excelDownload','excelUpload','markSheet','getParentExams']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $studentMark = $this->StudentMarks->newEntity();
        if($this->request->is('post'))
        {
            $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));
            
            $where['student_class_id'] = $class_mapping->student_class_id;
            $where['stream_id'] = $class_mapping->stream_id;

            $exam_master_id[] = $this->request->getData('exam_master_id');

            $children = $this->StudentMarks->ExamMasters->find('children', ['for' => $exam_master_id[0]]);

            if(!empty($children->toArray()))
                foreach ($children as $key => $child)
                    $exam_master_id[] = $child->id;

            $subject_id = $this->request->getData('subject_id');
            
            if (!empty($subject_id))
                $subjects = $this->StudentMarks->Subjects->find('threaded')->contain(['ExamMaxMarks'])->where(['id IN'=>$subject_id,'Subjects.subject_type_id' => 1]);
            else
            {
                $subjects = $this->StudentMarks->Subjects->find('threaded')->contain(['ExamMaxMarks'])->where([$where,'Subjects.subject_type_id' => 1,'Subjects.is_deleted'=>'N']);

                $subject_ids = $this->StudentMarks->Subjects->find()->contain(['ExamMaxMarks'])->where([$where,'Subjects.subject_type_id' => 1,'Subjects.is_deleted'=>'N']);
            }

            if (!empty($subject_id)){}
            else
            {
                $subject_id =[];
                foreach ($subject_ids as $key => $sub)
                    $subject_id [] = $sub->id;
            }

            $condition = implode(' AND ',$this->array_map_assoc(function($k,$v){return "$k = $v";},$where));
            $exams = $this->StudentMarks->ExamMasters->find('threaded')->contain(['SubExams'])->where(['id IN'=>$exam_master_id]);

            $conn = ConnectionManager::get('default');

            $stmt = $conn->execute("SELECT 
            students.name,
            student_infos.id As student_info_id, 
            exam_masters.id,
            exam_masters.name As exam,
            sub_exams.name as sub_exam,
            sub_exams.id as sub_exam_id,
            subjects.name As subject,
            subjects.id As subject_id,
            student_marks.student_number,
            exam_masters.max_marks,
            sub_exams.max_marks As sub_max,
            IF(sub_exams.id,1,0) as save_to
            FROM student_infos

            INNER JOIN students ON student_infos.student_id = students.id
            AND ".$condition." AND student_infos.section_id = ".$class_mapping->section_id."

            LEFT JOIN subjects ON subjects.student_class_id = student_infos.student_class_id 
            AND subjects.stream_id = student_infos.stream_id 
            AND subjects.rght-subjects.lft=1  
            AND subjects.subject_type_id = 1
            ".(!empty($subject_id) ? 'AND subjects.id IN ('.implode(',',$subject_id).')':'')."

            LEFT JOIN exam_masters ON subjects.student_class_id = exam_masters.student_class_id 
            AND subjects.stream_id = exam_masters.stream_id 
            AND exam_masters.rght-exam_masters.lft=1
            AND exam_masters.id IN (".implode(',',$exam_master_id).")

            LEFT JOIN sub_exams ON sub_exams.exam_master_id = exam_masters.id

            LEFT JOIN student_marks ON (student_marks.exam_master_id = exam_masters.id OR student_marks.sub_exam_id = sub_exams.id)
            AND student_marks.student_info_id = student_infos.id 
            AND student_marks.subject_id = subjects.id 
            ".(!empty($subject_id) ? 'AND subjects.id IN ('.implode(',',$subject_id).')':'')."

            ORDER BY student_infos.id ASC,exam_masters.order_number,sub_exams.id,subjects.order_number;");
            $students = $stmt->fetchAll('assoc');

            $subjects = json_decode(json_encode($subjects->toArray()),true);
            $exams = json_decode(json_encode($exams->toArray()),true);

            foreach ($students as $key => $student) {
                if($this->StudentMarks->ExamMasters->ExamMaxMarks->exists(['exam_master_id'=>$student['id'],'subject_id'=>$student['subject_id']]))
                    $students[$key]['max_marks'] = $this->StudentMarks->ExamMasters->ExamMaxMarks->find()->where(['exam_master_id'=>$student['id'],'subject_id'=>$student['subject_id']])->first()->max_marks;
            }
            //pr($students);exit;
        }
        
        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }

        $this->set(compact('studentMarks','studentMark','subjects','exams','students','classMappings'));
    }

    function array_map_assoc( $callback , $array ){
      $r = array();
      foreach ($array as $key=>$value)
        $r[$key] = $callback($key,$value);
      return $r;
    }

    public function examWiseReport()
    {
        $studentMark = $this->StudentMarks->newEntity();
        if($this->request->is('post'))
        {
            $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));
            
            $where['student_class_id'] = $class_mapping->student_class_id;
            $where['stream_id'] = $class_mapping->stream_id;

            $exam_master_id[] = $this->request->getData('exam_master_id');

            $children = $this->StudentMarks->ExamMasters->find('children', ['for' => $exam_master_id[0]]);

            if(!empty($children->toArray()))
                foreach ($children as $key => $child)
                    $exam_master_id[] = $child->id;

            $subject_id = $this->request->getData('subject_id');

            if (!empty($subject_id))
                $subjects = $this->StudentMarks->Subjects->find('threaded')->contain(['ExamMaxMarks'])->where(['id IN'=>$subject_id,'Subjects.subject_type_id' => 1]);
            else
            {
                $subjects = $this->StudentMarks->Subjects->find('threaded')->contain(['ExamMaxMarks'])->where([$where,'Subjects.subject_type_id' => 1,'Subjects.is_deleted'=>'N']);

                $subject_ids = $this->StudentMarks->Subjects->find()->contain(['ExamMaxMarks'])->where([$where,'Subjects.subject_type_id' => 1,'Subjects.is_deleted'=>'N']);
            }

            if (!empty($subject_id)){}
            else
            {
                $subject_id =[];
                foreach ($subject_ids as $key => $sub)
                    $subject_id [] = $sub->id;
            }

            $condition = implode(' AND ',$this->array_map_assoc(function($k,$v){return "$k = $v";},$where));
            $exams = $this->StudentMarks->ExamMasters->find('threaded')->contain(['SubExams'])->where(['id IN'=>$exam_master_id]);

            $conn = ConnectionManager::get('default');

            $stmt = $conn->execute("SELECT 
            students.name, 
            student_infos.id As student_info_id, 
            exam_masters.id,exam_masters.name As exam,
            sub_exams.name as sub_exam,
            sub_exams.id as sub_exam_id,
            subjects.name As subject,
            subjects.id As subject_id,
            student_marks.student_number,
            exam_masters.max_marks,
            sub_exams.max_marks As sub_max,
            IF(sub_exams.id,1,0) as save_to
            FROM student_infos

            INNER JOIN students ON student_infos.student_id = students.id
            AND ".$condition." AND student_infos.section_id = ".$class_mapping->section_id."

            LEFT JOIN subjects ON subjects.student_class_id = student_infos.student_class_id 
            AND subjects.stream_id = student_infos.stream_id 
            AND subjects.rght-subjects.lft=1 
            AND subjects.subject_type_id = 1
            ".(!empty($subject_id) ? 'AND subjects.id IN ('.implode(',',$subject_id).')':'')."

            LEFT JOIN exam_masters ON subjects.student_class_id = exam_masters.student_class_id 
            AND subjects.stream_id = exam_masters.stream_id 
            AND exam_masters.rght-exam_masters.lft=1 
            AND exam_masters.id IN (".implode(',',$exam_master_id).")

            LEFT JOIN sub_exams ON sub_exams.exam_master_id = exam_masters.id

            LEFT JOIN student_marks ON (student_marks.exam_master_id = exam_masters.id OR student_marks.sub_exam_id = sub_exams.id)
            AND student_marks.student_info_id = student_infos.id 
            AND student_marks.subject_id = subjects.id 
            ".(!empty($subject_id) ? 'AND subjects.id IN ('.implode(',',$subject_id).')':'')."

            ORDER BY student_infos.id ASC,subjects.order_number,exam_masters.order_number,sub_exams.id;");
            $students = $stmt->fetchAll('assoc');

            $subjects = json_decode(json_encode($subjects->toArray()),true);
            $exams = json_decode(json_encode($exams->toArray()),true);

            foreach ($students as $key => $student) {
                if($this->StudentMarks->ExamMasters->ExamMaxMarks->exists(['exam_master_id'=>$student['id'],'subject_id'=>$student['subject_id']]))
                    $students[$key]['max_marks'] = $this->StudentMarks->ExamMasters->ExamMaxMarks->find()->where(['exam_master_id'=>$student['id'],'subject_id'=>$student['subject_id']])->first()->max_marks;
            }

            //pr($students);exit;
        }
        
        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }

        $this->set(compact('studentMarks','studentMark','subjects','exams','students','classMappings'));
    }

    /**
     * View method
     *
     * @param string|null $id Student Mark id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentMark = $this->StudentMarks->get($id, [
            'contain' => ['SessionYears', 'StudentInfos', 'ExamMasters', 'Subjects']
        ]);

        $this->set('studentMark', $studentMark);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentMark = $this->StudentMarks->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            foreach ($data['data'] as $key => $value) {
                $data['data'][$key]['session_year_id'] = $this->Auth->user('session_year_id');
                $data['data'][$key]['created_by'] = $this->Auth->user('id');
                $data['data'][$key]['exam_master_id'] = $this->request->getData('exam_master_id');
                $data['data'][$key]['subject_id'] = $this->request->getData('subject_id');
            }
            //pr($data['data']);exit;
            $studentMark = $this->StudentMarks->patchEntities($studentMark,$data['data']);
            //pr($studentMark);exit;
            if ($this->StudentMarks->saveMany($studentMark)) {
                $this->Flash->success(__('The student mark has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            else
            {
                $this->Flash->error(__('The student mark could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'add']);
            }
        }
        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }
        $this->set(compact('studentMark', 'sessionYears', 'studentInfos', 'examMasters', 'subjects','classMappings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Mark id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentMark = $this->StudentMarks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentMark = $this->StudentMarks->patchEntity($studentMark, $this->request->getData());
            if ($this->StudentMarks->save($studentMark)) {
                $this->Flash->success(__('The student mark has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student mark could not be saved. Please, try again.'));
        }
        $sessionYears = $this->StudentMarks->SessionYears->find('list');
        $studentInfos = $this->StudentMarks->StudentInfos->find('list');
        $examMasters = $this->StudentMarks->ExamMasters->find('list');
        $subjects = $this->StudentMarks->Subjects->find('list');
        $this->set(compact('studentMark', 'sessionYears', 'studentInfos', 'examMasters', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Mark id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentMark = $this->StudentMarks->get($id);
        if ($this->StudentMarks->delete($studentMark)) {
            $this->Flash->success(__('The student mark has been deleted.'));
        } else {
            $this->Flash->error(__('The student mark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getStudentsSingle()
    {
        $where['Students.is_deleted'] = 'N';
        $where2['StudentMarks.is_deleted'] = 'N';
        $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));

        if(!empty($this->request->getData()))
            foreach ($this->request->getData() as $key => $value) {
                if(!empty($value) && $key != 'class_mapping_id')
                    $where2['StudentMarks.'.$key] = $value;
            }

        //pr($where2);exit;

        $subject_id = $where2['StudentMarks.subject_id'];
        $subject = $this->StudentMarks->Subjects->get($subject_id);
        $success = 0;

        if($subject->elective == 'Yes')
        {
            $response = $this->StudentMarks->StudentInfos->find();
            $response->select(['id'=>'StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no','marks'=>'StudentMarks.student_number','marks_id'=>'StudentMarks.id'])
            ->innerJoinWith('StudentElectiveSubjects',function($q)use($where2){return $q->where(['subject_id'=>$where2['StudentMarks.subject_id']]);})
            ->leftJoinWith('StudentMarks',function($q)use($where2){return $q->where($where2);})
            ->contain(['Students'])
            ->where(['StudentInfos.student_class_id'=>$class_mapping->student_class_id])
            ->where(['StudentInfos.stream_id'=>$class_mapping->stream_id])
            ->where(['StudentInfos.section_id'=>$class_mapping->section_id])
            ->where(['Students.is_deleted'=>'N']);
        }
        else
        {
            $response = $this->StudentMarks->StudentInfos->find();
            $response->select(['id'=>'StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no','marks'=>'StudentMarks.student_number','marks_id'=>'StudentMarks.id'])
            ->leftJoinWith('StudentMarks',function($q)use($where2){return $q->where($where2);})
            ->contain(['Students'])
            ->where(['StudentInfos.student_class_id'=>$class_mapping->student_class_id])
            ->where(['StudentInfos.stream_id'=>$class_mapping->stream_id])
            ->where(['StudentInfos.section_id'=>$class_mapping->section_id])
            ->where(['Students.is_deleted'=>'N']);

        }  

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getStudentsMultiple()
    {
        $where['Students.is_deleted'] = 'N';
        $where2['StudentMarks.is_deleted'] = 'N';
        foreach ($this->request->getData('StudentInfos') as $key => $value) {
            if(!empty($value))
                $where['StudentInfos.'.$key] = $value;
        }
        if(!empty($this->request->getData('ExamMasters')))
            foreach ($this->request->getData('ExamMasters') as $key => $value) {
                if(!empty($value))
                    $where2['StudentMarks.'.$key] = $value;
            }

        //pr($where2);exit;

        $subject_id = $where2['StudentMarks.subject_id'];
        $subject = $this->StudentMarks->Subjects->get($subject_id);
        $success = 0;

        if($subject->elective == 'Yes')
        {
            $response = $this->StudentMarks->StudentInfos->find();
            $response->select(['id'=>'StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no','marks'=>'StudentMarks.student_number','marks_id'=>'StudentMarks.id'])
            ->innerJoinWith('StudentElectiveSubjects',function($q)use($where2){return $q->where(['subject_id'=>$where2['StudentMarks.subject_id']]);})
            ->leftJoinWith('StudentMarks',function($q)use($where2){return $q->where($where2);})
            ->contain(['Students'])
            ->where([$where]);
        }
        else
        {
            $response = $this->StudentMarks->StudentInfos->find();
            $response->select(['id'=>'StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no','marks'=>'StudentMarks.student_number','marks_id'=>'StudentMarks.id'])
            ->leftJoinWith('StudentMarks',function($q)use($where2){return $q->where($where2);})
            ->contain(['Students'])
            ->where([$where]);
        }  

        if(!empty($response->toArray()))
            $success = 1;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function excelUpload()
    {
        $studentMark = $this->StudentMarks->newEntity();
        if ($this->request->is('post')) {
            $tmpName = $_FILES['csv']['tmp_name'];
            $csvAsArray = array_map('str_getcsv', file($tmpName));

            //pr($csvAsArray);exit;

            foreach ($csvAsArray as $key => $data) {
                if($key > 0)
                {
                    foreach ($data as $key2 => $value) {
                        if($key2 > 0)
                        {
                            if($csvAsArray[0][$key2] == 'Marks')
                                $csvAsArray[0][$key2] = 'student_number';
                            $studentMarks[$key][$csvAsArray[0][$key2]] = $value;
                        }
                    }
                }
            }
            //pr($studentMarks);
            $save = $this->StudentMarks->patchEntities($studentMark,$studentMarks);
            //pr($save);exit;
            foreach ($save as $key => $value) {
                if(isset($value->id))
                    $value->edited_by = $this->Auth->user('id');
                else
                {
                    $value->created_by = $this->Auth->user('id');
                    $value->session_year_id = $this->Auth->user('session_year_id');
                }
            }
            //pr($save);exit;
            if($this->StudentMarks->saveMany($save))
                $this->Flash->success('Data has been saved');
            else
                $this->Flash->error('Data could not be saved');
        }

        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }
        $this->set(compact('studentMark', 'examMasters', 'subjects','classMappings'));
    }

    public function excelDownload()
    {
        $tables = '';
        $table = [];
        $this->viewBuilder()->setLayout('');
        
        if($this->request->is('post'))
        {
            $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));
            $data = $this->request->getData();
            $exam_id = $data['exam_master_id'];
            unset($data['exam_master_id']);
            $data[''.$data['save_to']] = $exam_id;
            unset($data['save_to']);
            unset($data['class_mapping_id']);

            array_push($table,'Sr. No.','id','exam_master_id','sub_exam_id','subject_id','student_info_id','Student','Scoller No.','Roll No.','Marks');
            $tables.=implode($table,',');
            $tables.="\n";

            $where2['StudentMarks.is_deleted'] = 'N';

            foreach ($data as $key => $value) {
                if(!empty($value))
                    $where2['StudentMarks.'.$key] = $value;
            }

            $success = 0;
            $response = $this->StudentMarks->StudentInfos->find();
            $response->select(['id'=>'StudentInfos.id','name'=>'Students.name','rollno'=>'StudentInfos.roll_no','scholer'=>'Students.scholar_no','marks'=>'StudentMarks.student_number','marks_id'=>'StudentMarks.id'])
            ->leftJoinWith('StudentMarks',function($q)use($where2)
                {
                    return $q->where($where2);
                }
            )
            ->contain(['Students'])
            ->where(['StudentInfos.student_class_id'=>$class_mapping->student_class_id])
            ->where(['StudentInfos.stream_id'=>$class_mapping->stream_id])
            ->where(['StudentInfos.section_id'=>$class_mapping->section_id])
            ->where(['StudentInfos.session_year_id'=>$this->Auth->user('session_year_id')])
            ->where(['Students.is_deleted'=>'N']);

            foreach ($response as $key => $data) {
                $table[0]= $key;
                $table[1]= (!empty($data->marks_id)? $data->marks_id : '');
                $table[2]= (@$where2['StudentMarks.exam_master_id']) ? $where2['StudentMarks.exam_master_id'] : '';
                $table[3]= (@$where2['StudentMarks.sub_exam_id']) ? $where2['StudentMarks.sub_exam_id'] : '';
                $table[4]= $where2['StudentMarks.subject_id'];
                $table[5]= (!empty($data->id) ? $data->id : '');
                $table[6]= $data->name;
                $table[7]= $data->scholer;
                $table[8]= $data->rollno;
                $table[9]= ($data->marks !== null ? $data->marks : '');
                $tables.=implode($table,',');
                $tables.="\n";
            }

            if(!empty($response->toArray()))
                $success = 1;
        }
        

        $this->set(compact('success','response','tables'));
        $this->set('_serialize', ['response','success']);
    }

    public function markSheet()
    {
        $studentMark = $this->StudentMarks->newEntity();
        if ($this->request->is('post')) {
            $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));

            $students = $this->StudentMarks->StudentInfos->find()
            ->select($this->StudentMarks->StudentInfos)
            ->select(['name'=>'Students.name','scholer_no'=>'Students.scholar_no'])
            ->where(['student_class_id'=>$class_mapping->student_class_id])
            ->where(['stream_id'=>$class_mapping->stream_id])
            ->where(['is_deleted'=>'N'])
            ->contain(['Students']);
        }

        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }

        //$mediums = $this->StudentMarks->Mediums->find('list');
        $this->set(compact('studentMark', 'sessionYears', 'studentInfos', 'examMasters', 'subjects','classMappings','students'));
    }

    public function viewMarkSheet1($student_info_id,$student_class_id,$exam_master_id,$last,$stream_id=null)
    { 
        $where['student_class_id'] = $student_class_id;
        $where['stream_id'] = $stream_id;
        $sy_id = $this->Auth->user('session_year_id');
        $where = array_filter($where, function($value) { return $value != ''; });
        $this->viewBuilder()->setLayout('pdf');

        
        $student = $this->StudentMarks->StudentInfos->get($student_info_id, [
            'contain' => ['Students','StudentClasses','Sections','Streams']
        ]);

        $marks_type = $student->student_class->grade_type;

        if($last == 0)
            $children = $this->StudentMarks->ExamMasters->find('children', ['for' => $exam_master_id]);
        else
            $children = $this->StudentMarks->ExamMasters->find()->where([$where,'session_year_id'=>$sy_id]);

        if(!empty($children->toArray()))
        {
            $old_exam_master_id = $exam_master_id;
            $exam_master_id = [];
            $exam_master_id[] = $old_exam_master_id;
            foreach ($children as $key => $child) {
                $exam_master_id[] = $child->id;
            }

        }

        $exams = $this->StudentMarks->ExamMasters->find('threaded')->where([$where,'id IN'=>$exam_master_id]);

        $marks = $this->StudentMarks->ExamMasters->Results->find()->where(['student_info_id'=>$student_info_id,'exam_master_id IN'=>$exam_master_id])->contain(['ResultRows']);
        //pr($marks->toArray());exit;

        $scholastic_subjects = $this->StudentMarks->Subjects->find('threaded')
            ->contain(['Exams'=>function($q)use($exam_master_id){
                return $q->where(['rght-lft'=>1,'Exams.id IN'=>$exam_master_id]);
            }])
        ->where([$where,'subject_type_id'=>1,'elective'=>'No','Subjects.session_year_id'=>$sy_id]);

        $scholastic_subjects = json_decode(json_encode($scholastic_subjects->toArray()),true);

        $non_scholastic_subjects = $this->StudentMarks->Subjects->find()
        ->select($this->StudentMarks->Subjects)
        ->select(['type'=>'SubjectTypes.name'])
        ->contain(['SubjectTypes','StudentMarks'=>function($q)use($student_info_id,$exam_master_id){
                    return $q->select(['StudentMarks.id','StudentMarks.subject_id','exam'=>'ExamMasters.name','StudentMarks.student_number'])->where(['student_info_id'=>$student_info_id,'exam_master_id IN'=>$exam_master_id])->contain(['ExamMasters']);
                }])->where([$where,'rght-lft' => 1,'subject_type_id != '=>1]);

        $non_scholastic_subjects = json_decode(json_encode($non_scholastic_subjects->toArray()),true);

        foreach ($non_scholastic_subjects as $key => $subject)
            if(empty($subject['student_marks']))
                unset($non_scholastic_subjects[$key]);

       // pr($non_scholastic_subjects);exit;

        $this->set(compact('student','exams','scholastic_subjects','non_scholastic_subjects','marks_type','marks','last'));
    }

    public function saveMarks()
    {
        $data = $this->request->getData();
        unset($data['student_number']);
        $data['session_year_id'] = $this->Auth->user('session_year_id');
        if($this->StudentMarks->exists([$data]))
        {
            $mark = $this->StudentMarks->find()->where($data)->first();
            $mark->edited_by = $this->Auth->user('id');
        }
        else
        {
            $mark = $this->StudentMarks->newEntity();
            $mark->session_year_id = $data['session_year_id'];
            $mark->created_by = $this->Auth->user('id');
        }

        $mark_patch = $this->StudentMarks->patchEntity($mark,$this->request->getData());

        if($this->request->getData('student_number'))
            $save = $this->StudentMarks->save($mark_patch);
        else
            $save = $this->StudentMarks->delete($mark);

        if($save)
            $success = true;
        else
            $success = false;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['response','success']);
    }

    public function getMaxMarks()
    {
        $where['ExamMaxMarks.is_deleted'] = 'N';
        $where['ExamMaxMarks.session_year_id'] = $this->Auth->user('session_year_id');
        $save_to = $this->request->getData('save_to');
        foreach ($this->request->getData() as $key => $value) {
            if(!empty($value) && $key != 'save_to')
                $where['ExamMaxMarks.'.$key] = $value;
        }
        
        if($save_to == 'exam_master_id')
        {
            if($this->StudentMarks->ExamMasters->ExamMaxMarks->exists($where))
            {
                $success = 1;
                $response = $this->StudentMarks->ExamMasters->ExamMaxMarks->find()->where($where)->first()->max_marks;
            }
            else
            {
                $success = 1;
                $response = $this->StudentMarks->ExamMasters->get($this->request->getData('exam_master_id'))->max_marks;
            }
        }
        else
        {
            if($this->StudentMarks->ExamMasters->SubExams->exists(['id'=>$this->request->getData('exam_master_id')]))
            {
                $success = 1;
                $response = $this->StudentMarks->ExamMasters->SubExams->get($this->request->getData('exam_master_id'))->max_marks;
            }
        }

        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }

    public function createMarkSheet()
    { 
        $studentMark = $this->StudentMarks->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            $class_mapping = $this->StudentMarks->ClassMappings->get($data['class_mapping_id']);
            $student_class_id = $class_mapping->student_class_id;
            $stream_id = $class_mapping->stream_id;
            $exam_master_id = $data['exam_master_id'];

            $children = $this->StudentMarks->ExamMasters->find('children', ['for' => $exam_master_id]);

            if(!empty($children->toArray()))
            {
                foreach ($children as $key => $child) {
                    $exam_master_ids[] = $child->id;
                }

                $studentInfos = $this->StudentMarks->StudentInfos->find()->select(['StudentInfos.id','name'=>'Students.name','StudentInfos.roll_no','scholer_no'=>'Students.scholar_no','StudentInfos.student_class_id','StudentInfos.stream_id','StudentInfos.session_year_id'])->where(['StudentInfos.student_class_id'=>$student_class_id,'StudentInfos.stream_id'=>$stream_id])
                ->contain(['Students','Exams'=>function($q)use($exam_master_ids){
                    return $q->where(['Exams.id IN' => $exam_master_ids])->contain(['Subjects']);
                }]);
            }
            else
                $studentInfos = $this->StudentMarks->StudentInfos->find()->select(['StudentInfos.id','name'=>'Students.name','StudentInfos.roll_no','scholer_no'=>'Students.scholar_no','StudentInfos.student_class_id','StudentInfos.stream_id','StudentInfos.session_year_id'])->where(['StudentInfos.student_class_id'=>$student_class_id,'StudentInfos.stream_id'=>$stream_id])
                ->contain(['Students','Exams'=>function($q)use($exam_master_id){
                    return $q->where(['Exams.id' => $exam_master_id])->contain(['Subjects']);
                }]);

            $studentInfos = json_decode(json_encode($studentInfos->toArray()),true);
            $result_rows = [];
            $results = [];
            //pr($studentInfos);exit;
            foreach ($studentInfos as $info_key => $studentInfo)
            {
                $results[$info_key]['student_info_id'] = $studentInfo['id'];
                $results[$info_key]['exam_master_id'] = $exam_master_id;

                foreach ($studentInfo['exams'] as $exam_key => $exam)
                {
                    foreach ($exam['subjects'] as $sub_key => $subject) 
                    {
                        //check if exam has sub exams
                        if($this->StudentMarks->SubExams->exists(['exam_master_id'=>$exam['id']]))
                        {
                            $sub_exams = $this->StudentMarks->SubExams->find()->where(['exam_master_id'=>$exam['id']]);
                            
                            $total_marks = [];
                            $obtain_marks = [];
                            foreach ($sub_exams as $key => $sub_exam) {
                                if($this->StudentMarks->exists(['student_info_id'=>$studentInfo['id'],'sub_exam_id'=>$sub_exam['id'],'subject_id'=>$subject['id']]))
                                {
                                    $total_marks[] = $sub_exam['max_marks'];
                                    $obtain_marks[] = $this->StudentMarks->find()->where(['student_info_id'=>$studentInfo['id'],'sub_exam_id'=>$sub_exam['id'],'subject_id'=>$subject['id']])->first()->student_number;
                                }
                            }

                            //get max marks either from exam_max_marks or from exam_master
                            if($this->StudentMarks->ExamMasters->ExamMaxMarks->exists(['subject_id'=>$subject['id'],'exam_master_id'=>$exam['id'],'session_year_id'=>$this->Auth->user('session_year_id')]))
                            {
                                $total = $this->StudentMarks->ExamMasters->ExamMaxMarks->find()
                                ->where(['subject_id'=>$subject['id'],
                                            'exam_master_id'=>$exam['id'],
                                            'session_year_id'=>$this->Auth->user('session_year_id')])
                                ->first()->max_marks;
                            }
                            else
                                $total = $exam['max_marks'];

                            if(!empty($obtain_marks))
                            {
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['subject_id'] = $subject['id'];
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['subject_name'] = $subject['name'];
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['exam_master_id'] = $exam['id'];
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['exam_master_name'] = $exam['name'];
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['total'] = (Int)$total;
                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['obtain'] = (Int)round(array_sum($obtain_marks)/array_sum($total_marks) * $total);
                                $percent = round(array_sum($obtain_marks)/array_sum($total_marks)) * 100;

                                $results[$info_key]['result_rows'][$exam_key][$sub_key]['grade'] = $this->Grade->getGrade($student_class_id,$stream_id,$percent);
                            }
                        }
                        else
                        {
                            //find obtain marks
                            if($this->StudentMarks->exists(['student_info_id'=>$studentInfo['id'],'exam_master_id'=>$exam['id'],'subject_id'=>$subject['id']]))
                            {
                                $obtain_marks = $this->StudentMarks->find()
                                            ->where(['student_info_id'=>$studentInfo['id'],'exam_master_id'=>$exam['id'],'subject_id'=>$subject['id']])
                                            ->first()->student_number;

                                //get max marks either from exam_max_marks or from exam_master
                                if($this->StudentMarks->ExamMasters->ExamMaxMarks->exists(['subject_id'=>$subject['id'],'exam_master_id'=>$exam['id'],'session_year_id'=>$this->Auth->user('session_year_id')]))
                                {
                                    $total_marks = $this->StudentMarks->ExamMasters->ExamMaxMarks->find()
                                    ->where(['subject_id'=>$subject['id'],
                                                'exam_master_id'=>$exam['id'],
                                                'session_year_id'=>$this->Auth->user('session_year_id')])
                                    ->first()->max_marks;
                                }
                                else
                                    $total_marks = $exam['max_marks'];

                                if(!empty($obtain_marks))
                                {
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['subject_id'] = $subject['id'];
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['subject_name'] = $subject['name'];
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['exam_master_id'] = $exam['id'];
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['exam_master_name'] = $exam['name'];
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['total'] = (Int)$total_marks;
                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['obtain'] = is_numeric($obtain_marks)?(Int)round($obtain_marks):$obtain_marks;
                                    $percent = round($obtain_marks)/$total_marks * 100;

                                    $results[$info_key]['result_rows'][$exam_key][$sub_key]['grade'] = $this->Grade->getGrade($student_class_id,$stream_id,$percent);
                                }
                            }
                        }
                    }
                }
            }

            foreach ($results as $key => $result)
            {
                $total = 0;
                $obtain = 0;
                $subject_total = [];
                $subject_obtain = [];
                $fail = [];
                $supplementary = [];
                $distinction = [];
                if(isset($result['result_rows']))
                {
                    foreach ($result['result_rows'] as $key2 => $result_row) {
                        foreach ($result_row as $data) {
                            @$subject_total[$data['subject_id']]+= $data['total'];
                            @$subject_obtain[$data['subject_id']]+= $data['obtain'];
                            $total+= $data['total'];
                            $obtain+= $data['obtain'];
                            $results[$key]['result_rows'][] = $data;
                        }
                        unset($results[$key]['result_rows'][$key2]);
                    }
                
                    $percent = ($obtain/$total)*100;
                    $results[$key]['total'] = $total;
                    $results[$key]['obtain'] = $obtain;

                    if($percent < 36)
                        $results[$key]['status'] = 'Fail';
                    else
                        $results[$key]['status'] = 'Pass';

                    if($percent >= 36 && $percent < 49)
                        $results[$key]['division'] = 'Third';
                    if($percent >= 50 && $percent < 60)
                        $results[$key]['division'] = 'Second';
                    if($percent >= 60)
                        $results[$key]['division'] = 'First';

                    $results[$key]['percentage'] = $percent;
                    $results[$key]['grade'] = $this->Grade->getGrade($student_class_id,$stream_id,$percent);
                }

                // calculate subject wise fail supplementary and distinction
                foreach ($subject_total as $sub_total_key => $total) {
                    $percent = $subject_obtain[$sub_total_key] / $total * 100;
                    if($percent < 22)
                        $fail[] = $sub_total_key;
                    if($percent >= 22 && $percent < 36)
                        $supplementary[] = $sub_total_key;
                    if($percent > 80)
                        $distinction[] = $sub_total_key;
                }

                if(!empty($fail))
                    $results[$key]['fail'] = implode(',', $fail);

                if(!empty($supplementary))
                    $results[$key]['supplementary'] = implode(',', $supplementary);

                if(!empty($distinction))
                    $results[$key]['distinction'] = implode(',', $distinction);

                
            }

            //pr($results);

            $old_result = $this->StudentMarks->ExamMasters->Results->find()->where(['exam_master_id' => $exam_master_id]);

            $rr = $this->StudentMarks->ExamMasters->Results->newEntity();
            $rr = $this->StudentMarks->ExamMasters->Results->patchEntities($rr,$results);

            //pr($rr);exit;

            foreach ($old_result as $key => $old) {
                $this->StudentMarks->ExamMasters->Results->delete($old);
            }

            if($this->StudentMarks->ExamMasters->Results->saveMany($rr))
                $this->Flash->success('Mark Sheet Created');
            else
                $this->Flash->error('Unable to create Mark Sheet');
        }

        $data = $this->StudentMarks->ClassMappings->find();
        $data->select(['id'=>'ClassMappings.id','Mname'=>'Mediums.name','Cname'=>'StudentClasses.name','Sname'=>'Streams.name','SCname'=>'Sections.name'])
            ->where(['ClassMappings.session_year_id'=>$this->Auth->user('session_year_id')])
            ->group(['ClassMappings.medium_id','ClassMappings.student_class_id','ClassMappings.stream_id'])
            ->contain(['Mediums','StudentClasses','Streams','Sections']);
        
        foreach ($data as $key => $clss) {
            $name = '';
            foreach ($clss->toArray() as $key2 => $value)
            {
                if(!empty($value) && $key2 != 'id')
                {
                    if($key2 != 'Mname')
                        $name.=" > ";
                    $name.=$value;
                }
            }
            $classMappings[$clss->id] = $name;
        }

        $this->set(compact('studentMark', 'sessionYears', 'studentInfos', 'examMasters', 'subjects','classMappings','students'));
    }

    public function getParentExams()
    {
        $class_mapping = $this->StudentMarks->ClassMappings->get($this->request->getData('class_mapping_id'));
        $response = $this->StudentMarks->ExamMasters->find('threaded')
        ->where(['student_class_id'=>$class_mapping->student_class_id])
        ->where(['stream_id'=>$class_mapping->stream_id])
        ->where(['is_deleted'=>'N']);
        if($response)
            $success = 1;
        else
            $success = 0;

        $this->set(compact('success','response'));
        $this->set('_serialize', ['success','response']);
    }
}
