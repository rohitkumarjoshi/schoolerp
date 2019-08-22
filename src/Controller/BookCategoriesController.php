<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BookCategories Controller
 *
 * @property \App\Model\Table\BookCategoriesTable $BookCategories
 *
 * @method \App\Model\Entity\BookCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $active_li='Library';
        $active_sub_li='categories';

        $user_id = $this->Auth->User('id');
        $head_title = 'Book Categories';
        if (is_null($id))
            $category = $this->BookCategories->newEntity();
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $category = $this->BookCategories->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->is('post')){
                    $category->created_by = $user_id; 
            }else{
                $category->edited_by = $user_id; 
            }

            $category = $this->BookCategories->patchEntity($category,$this->request->getData());

            if($this->BookCategories->save($category))
            {
                $this->Flash->success("Category has been submitted");
                $this->redirect(['action'=>'index']);
            }
            else
                $this->Flash->error("Unable to submit category");
        }

        $categories = $this->paginate($this->BookCategories->find('all'));
        $this->set(compact('active_li','active_sub_li','categories','category','id','head_title'));
    }

    /**
     * View method
     *
     * @param string|null $id Book Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $active_li='Library';
    //     $active_sub_li='categories';
    //     $bookCategory = $this->BookCategories->get($id, [
    //         'contain' => ['Books']
    //     ]);

    //     $this->set('bookCategory', $bookCategory);
    // }

    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $active_li='Library';
    //     $active_sub_li='categories';
    //     $bookCategory = $this->BookCategories->newEntity();
    //     if ($this->request->is('post')) {
    //         $bookCategory = $this->BookCategories->patchEntity($bookCategory, $this->request->getData());
    //         if ($this->BookCategories->save($bookCategory)) {
    //             $this->Flash->success(__('The book category has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The book category could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('active_li','active_sub_li','bookCategory'));
    // }

    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id Book Category id.
    //  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Network\Exception\NotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $active_li='Library';
    //     $active_sub_li='categories';
    //     $bookCategory = $this->BookCategories->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $bookCategory = $this->BookCategories->patchEntity($bookCategory, $this->request->getData());
    //         if ($this->BookCategories->save($bookCategory)) {
    //             $this->Flash->success(__('The book category has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The book category could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('active_li','active_sub_li','bookCategory'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Book Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookCategory = $this->BookCategories->get($id);
        if ($this->BookCategories->delete($bookCategory)) {
            $this->Flash->success(__('The book category has been deleted.'));
        } else {
            $this->Flash->error(__('The book category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
