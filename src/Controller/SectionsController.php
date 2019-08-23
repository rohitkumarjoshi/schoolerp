<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 *
 * @method \App\Model\Entity\Section[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SectionsController extends AppController
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
            $section = $this->Sections->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $section = $this->Sections->get($id);
        }
        if ($this->request->is(['post','put'])) {
            
            $section = $this->Sections->patchEntity($section, $this->request->getData()); 

            if(!$id)
            {
                $section->created_by =$user_id;
                $section->session_year_id =$session_year_id;

           
            }
            else
            {
                $section->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->Sections->save($section))
              {
                $this->Flash->success(__('The section has been saved.'));
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
                $error_data='The section could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $this->paginate = [
            'order' => ['id'=>'DESC'],
            'limit' => 10
        ];
        if ($this->request->getQuery('search')) 
        { 
            $sections = $this->Sections->find();
            if(!empty($this->request->getQuery('name')))
            {
                $name = $this->request->getQuery('name');
                $sections->where(function (QueryExpression $exp, Query $q) use($name) {
                    return $exp->like('Sections.name', '%'.$name.'%');
                });
            }
            $sections = $this->paginate($sections);
        }
        else
        {
            $sections = $this->paginate($this->Sections);
        }
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('sections','section','id','status','name'));
    }
}
