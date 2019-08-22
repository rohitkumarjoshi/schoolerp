<?php
namespace App\Controller\Api;
use Cake\Controller\Controller;
use Cake\Event\Event;
/* <?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController; */
//use Cake\I18n\FrozenDate;
//use Cake\I18n\FrozenTime;
class AppController extends Controller
{
  use \Crud\Controller\ControllerTrait;
  public $components = [
        'RequestHandler','Flash',
        'Crud.Crud' => [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]
    ];
	public function initialize()
    {
		$coreVariable = [
			'SiteUrl' => 'https://www.travelb2bhub.com/app/',
		];
		$this->loadComponent('FeeReceipt');
        $awsFileLoad=$this->loadComponent('AwsFile');
		$this->coreVariable = $coreVariable;
		$this->set(compact('coreVariable'));
 	}
	
	public function chatsOfUsers($user_id=null,$senduser_id=null,$project_id=null,$messages=null)
	{
		$this->loadModel('Chats');
		if(!empty($user_id)){
			foreach($user_id as $userId){
				$query = $this->Chats->query();
				$query->insert(['user_id', 'sendto_user_id', 'project_id', 'chat_messages'])
				->values([
				   'user_id' => $userId,
				   'sendto_user_id' => $senduser_id,
				  'project_id' => $project_id,
				  'chat_messages' => $messages
				]);
				if($query->execute()){
					 return true;
				}else{
				  return false;
				}
			}
		}
	}	
	
}
?>