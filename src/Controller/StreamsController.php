<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Streams Controller
 *
 * @property \App\Model\Table\StreamsTable $Streams
 *
 * @method \App\Model\Entity\Stream[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StreamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $stream = $this->Streams->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $stream = $this->Streams->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $stream = $this->Streams->patchEntity($stream, $this->request->getData());            
            if(!$id)
            {
                $stream->created_by =$user_id;
                $stream->session_year_id =$session_year_id;
            }
            else
            {
                $stream->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->Streams->save($stream))
              {
                $this->Flash->success(__('The stream has been saved.'));
                return $this->redirect(['action' => 'index']);
              }
            } catch (\Exception $e) {
               $error = $e->getMessage();
            }
            
            if (strpos($error, '1062') !== false) 
            {
                $error_data='Duplicate entry. Please, try again.';
            }
            else
            {
                 $error_data='The stream could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $streams = $this->paginate($this->Streams,['limit'=>10]);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('streams','stream','id','status'));
    }

}
