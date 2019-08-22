<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;

/**
 * UnAuthorized Controller
 *
 */
class UnAuthorizedController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['unAuthorized','pageNotFound']);
    }
	public function unAuthorized()
	{
		$this->viewBuilder()->layout('unauthorized_layout');
		
	}
	public function pageNotFound()
	{
		$this->viewBuilder()->layout('unauthorized_layout');
	}
}
?>