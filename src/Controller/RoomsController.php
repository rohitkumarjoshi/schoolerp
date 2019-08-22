<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $this->paginate = [
            'contain' => ['Hostels'],
            'limit' => 10
        ];
        if(!$id)
        {
            $room = $this->Rooms->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $room = $this->Rooms->get($id, [
            'contain' => []
             ]);
        }
        if ($this->request->is(['post','put']))
         {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if(!$id)
            {
                $room->created_by =$user_id;
            }
            else
            {
                $room->edited_by =$user_id;
            }
            
           $error='';
            try 
            {
              if($this->Rooms->save($room))
              {
                $this->Flash->success(__('The room has been saved.'));
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
                $error_data='The room could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $hostels = $this->Rooms->Hostels->find('list');
            $hostels->select(['Hostels.id','no_of_rooms'])
            ->leftJoinWith('Rooms',function($q){
                return $q->select(['total_room'=>$q->func()->count('Rooms.id')])
                ->where(['Rooms.is_deleted'=>'N'])
                ;
            })
            ->group(['Rooms.hostel_id'])
            ->having(['no_of_rooms > total_room']);

        $status = array('N'=>'Active','Y'=>'Deactive');
        if ($this->request->getQuery('search')) 
        {
            $rooms = $this->Rooms->find();
            if(!empty($this->request->getQuery('hostel_id')))
            {
                $hostel_id = $this->request->getQuery('hostel_id');
                $rooms->where(['Rooms.hostel_id'=>$hostel_id]);
                
            }
            if(!empty($this->request->getQuery('room_no')))
            {
                $room_no = $this->request->getQuery('room_no');
                $rooms->where(function (QueryExpression $exp, Query $q) use($room_no) {
                    return $exp->like('Rooms.room_no', '%'.$room_no.'%');
                });
            }
            $rooms = $this->paginate($rooms);
        }
        else
        {
            $rooms = $this->paginate($this->Rooms);
        }
        $this->set(compact('rooms','hostels','room','id','status'));
    }
}
