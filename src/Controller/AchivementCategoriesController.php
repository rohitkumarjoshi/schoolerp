<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AchivementCategories Controller
 *
 * @property \App\Model\Table\AchivementCategoriesTable $AchivementCategories
 *
 * @method \App\Model\Entity\AchivementCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AchivementCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id=null)
    {
        $user_id = $this->Auth->User('id');
		if(!$id){
			$achivementCategory = $this->AchivementCategories->newEntity();
		}
		else{
			 $id = $this->EncryptingDecrypting->decryptData($id);
			 $achivementCategory = $this->AchivementCategories->get($id, [
			'contain' => []
			]);
			} 
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $achivementCategory =  $this->AchivementCategories->patchEntity($achivementCategory, $this->request->getData());
			if(!$id)
            {
				$achivementCategory->created_by =$user_id;
			}
			else{
				$achivementCategory->edited_by =$user_id;
			}
			$error='';
			try 
            {
				if ($this->AchivementCategories->save($achivementCategory)) {
					//-- Cover Image
		            $image = $this->request->getData('image_path_data');
		            if(empty($image['error']))
                	{ 
                		if(!empty($achivementCategory->image_path))
                		{
                			if($this->AwsFile->doesObjectExistFile($achivementCategory->image_path))
	                		{
	                			$this->AwsFile->deleteObjectFile($achivementCategory->image_path);
	                		}
                		}
			            $ext=explode('/',$image['type']);
			            $file_name='achivement'.time().rand().'.'.$ext[1]; 
			            $keyname = 'achivement/'.$achivementCategory->id.'/'.$file_name;
	                	$this->AwsFile->putObjectFile($keyname,$image['tmp_name'],$image['type']);
	                	$query = $this->AchivementCategories->query();
	                	$query->update()->set(['image_path'=>$keyname])->where(['id' => $achivementCategory->id])->execute();
	                }
					$this->Flash->success(__('The achivement category has been saved.'));
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
                 $error_data='The achivement category could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
		$status[]=['value'=>'N','text'=>'Active'];
		$status[]=['value'=>'Y','text'=>'Deactive'];
		$achivementCategories = $this->paginate($this->AchivementCategories->find()->order(['id'=>'DESC']),['limit'=>10]);
        $this->set(compact('achivementCategory','id','achivementCategories','status'));
    }
}
