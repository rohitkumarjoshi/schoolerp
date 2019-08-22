<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;

/**
 * DirectorMessages Controller
 *
 * @property \App\Model\Table\DirectorMessagesTable $DirectorMessages
 *
 * @method \App\Model\Entity\DirectorMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DirectorMessagesController extends AppController
{
    public function directorMessage($id=null)
    {
        $user_type = $this->request->getQuery('user_type');
        $message_by = $this->request->getQuery('message_by');
        $where=[];
        if($user_type=='Employee'){
            $where['DirectorMessages.role_type !=']='Student';
        }
        else{
            $where['DirectorMessages.role_type !=']='Teacher';
        }
        $where['DirectorMessages.message_by']=$message_by;
        $directorMessages = $this->DirectorMessages->find()->where($where)->order(['edited_on '=>'DESC'])->limit(1)->first();;
        $success=true;
        $message=''; 
        $this->set(compact('success', 'message', 'directorMessages'));
        $this->set('_serialize', ['success', 'message', 'directorMessages']); 
    }
}
