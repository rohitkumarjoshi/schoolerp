<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class GradeComponent extends Component
{
	function initialize(array $config) 
	{
		parent::initialize($config);
	}
	
	function getGrade($student_class_id,$stream_id = null,$percent)
    {
        $abc = new AppController;

        $this->GradeMasters = TableRegistry::get('GradeMasters'); //cakephp 3.6
        //$this->GradeMasters = TableRegistry::getTableLocator()->get('GradeMasters'); // cakephp 3.7+ 
        
        $where['student_class_id'] = $student_class_id;
        $where['is_deleted'] = 'N';
        $where['session_year_id'] = $abc->Auth->user('session_year_id');
        $where['min_marks <='] = $percent;
        $where['max_marks >='] = $percent;
        if($stream_id)
            $where['stream_id'] = $stream_id;
        if($this->GradeMasters->exists($where))
            $grade = $this->GradeMasters->find()->where($where)->first()->grade;
        else
            $grade = '';

        return $grade;
  	}
}
?>