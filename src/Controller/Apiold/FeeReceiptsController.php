<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Controller\Component;
/**
 * FeeReceipts Controller
 *
 * @property \App\Model\Table\FeeReceiptsTable $FeeReceipts
 *
 * @method \App\Model\Entity\FeeReceipt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeReceiptsController extends AppController
{
	
	
	 public function index()
		{
			$student_info_id = $this->request->getQuery('student_info_id');
			$session_year_id = $this->request->getQuery('session_year_id');
			
			 $feeMonth = $this->FeeReceipts->FeeReceiptRows->FeeMonths->find()->order(['id'=>'DESC'])->first();
			 $feeData=$this->FeeReceipt->dueFee($student_info_id,$session_year_id,1,$feeMonth->id); 
			
				$totalSubmitted=0;
				$totalFee=0;$monthlyDues=0;
				foreach ($feeData as $feeTypeMaster){

					foreach ($feeTypeMaster->fee_type_master_rows as $fee_type_master_row) {
						if(!empty($fee_type_master_row->fee_type_student_masters))
		                {
		                    foreach ($fee_type_master_row->fee_type_student_masters as $fee_type_student_master) {
		                        $fee_store[$Fee_data_show->fee_type->name][]=$fee_type_student_master->amount;
		                    }
		                }
		                else
		                {
		                    $fee_store[$Fee_data_show->fee_type->name][]=$fee_type_master_row->amount;
		                }
						
						$submittedAmounts = @$fee_type_master_row->fee_receipt_rows[0]->total_amount;
						$totalFee+=$FeeAmount;
						$totalSubmitted+=$submittedAmounts;
						$monthlyDues+=$FeeAmount-$submittedAmounts;

					}
				}
			
			$feeReceipts=[];
			$feeReceipts = $this->FeeReceipts->find();
			$feeReceipts->where(['session_year_id'=>$session_year_id,'FeeReceipts.is_deleted'=>'N','FeeReceipts.student_info_id'=>$student_info_id])->toArray();
			
				if($feeReceipts){
					$success=true;
					$message="Record found";


				}else{
					$success=false;
					$message="Record not found";
				}			
				
			$this->set(compact('success', 'message','feeReceipts','totalFee','monthlyDues'));
			$this->set('_serialize', ['success', 'message','totalFee','monthlyDues','feeReceipts']);
		}
   

}
