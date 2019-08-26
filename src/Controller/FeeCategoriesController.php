<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * FeeCategories Controller
 *
 * @property \App\Model\Table\FeeCategoriesTable $FeeCategories
 *
 * @method \App\Model\Entity\FeeCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
         
        $this->Security->setConfig('unlockedActions', ['feeComponentLedger','concessionList']);
    }
    public function index($id = null)
    {
        $user_id = $this->Auth->User('id');
        $session_year_id = $this->Auth->User('session_year_id');
        if(!$id)
        {
            $feeCategory = $this->FeeCategories->newEntity();
        }
        else
        {
            $id = $this->EncryptingDecrypting->decryptData($id);
            $feeCategory = $this->FeeCategories->get($id);
        }
        if ($this->request->is(['post','put'])) {
            $name = $this->request->getData('name');
            $feeCategories = $this->FeeCategories->find()->select(['id'])->where(['name'=>$name])->first();
            $feeCategory = $this->FeeCategories->get($feeCategories->id);
            $feeCategory = $this->FeeCategories->patchEntity($feeCategory, $this->request->getData());            
            if(!$id)
            {
                $feeCategory->created_by =$user_id;
            }
            else
            {
                $feeCategory->edited_by =$user_id;
            }
            
            $error='';
            try 
            {
              if($this->FeeCategories->save($feeCategory))
              {
                $this->Flash->success(__('The Fee Category has been saved.'));
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
                $error_data='The Fee Category could not be saved. Please, try again.';
            }
            $this->Flash->error(__($error_data));
        }
        $feeCategories = $this->paginate($this->FeeCategories,['limit'=>10]);
        $status = array('N'=>'Active','Y'=>'Deactive');
        $this->set(compact('feeCategories','feeCategory','id','status'));
    }

      public function exportReceiptDetailReport($medium_id,$student_class_id,$stream_id,$date_from,$date_to,$payment_type)
    {
        $this->viewBuilder()->layout('');
         $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
            
            // $daterange=explode('/',$daterange);
            // $date_from=date('Y-m-d',strtotime($daterange[0]));
            // $date_to=date('Y-m-d',strtotime($daterange[1]));
            
            $expenses=$this->FeeCategories->Expenses->find();
                $expenses->where(['Expenses.expense_date >='=>$date_from,'Expenses.expense_date <='=>$date_to,'payment_mode'=>'Cash'])
                ->select(['total_amount'=>$expenses->func()->sum('amount')]);
               
            $getFeeCategories = $this->FeeCategories->find();
            $getFeeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>['FeeTypeRoles']]);
            $srno=0;
            foreach ($getFeeCategories as $feeCategory) 
            {
                $fee_category_id=$feeCategory->id;
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($fee_category_id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                            return $q
                                    ->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                                     $q->where(['payment_type IN'=>$payment_type])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                                        $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if($medium_id!="-")
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if($student_class_id!="-")
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if($stream_id!="-")
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students','StudentClasses']);
                                            return $q;
                                        }]);
                                        return $q;
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->order('FeeReceiptDatas.receipt_date');
                        }]
                    ]);
                    
                    foreach ($feeReceiptsMonthly->fee_types as $fee_receipt)
                    { //echo $fee_receipt->fee_receipt_data->total_amount;
                        $dailyCollection[strtotime($fee_receipt->fee_receipt_data->receipt_date)][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date,'fine_amount'=>$fee_receipt->fee_receipt_data->fine_amount,'amount'=>$fee_receipt->fee_receipt_data->amount,'total_amount'=>$fee_receipt->fee_receipt_data->total_amount,'class'=>@$fee_receipt->fee_receipt_data->student_info->student_class->name,'stream'=>@$fee_receipt->fee_receipt_data->student_info->stream->name,'pay_mode'=>$fee_receipt->fee_receipt_data->payment_type,'cheque_no'=>$fee_receipt->fee_receipt_data->cheque_no,'bank'=>$fee_receipt->fee_receipt_data->bank,'cheque_date'=>$fee_receipt->fee_receipt_data->cheque_date,'transaction_no'=>$fee_receipt->fee_receipt_data->transaction_no,'fee_type'=>$fee_receipt->name];
                        $srno++;
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                                    $q->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['payment_type IN'=>$payment_type])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->order('FeeReceipts.receipt_date');
                                       
                                       $q->leftJoinWith('StudentInfos',function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if($medium_id!="-")
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if($student_class_id!="-")
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if($stream_id!="-")
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students','StudentClasses']);
                                            return $q;
                                        });
                                        return $q;
                                        
                            }]
                    ]);
                    foreach ($feeReceipts->fee_receipts as $fee_receipt)
                    {
                        $dailyCollection[$feeReceipts->name][strtotime($fee_receipt->receipt_date)][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>@$fee_receipt->student_info->student->name,'father_name'=>@$fee_receipt->student_info->student->father_name,'scholar_no'=>@$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date,'fine_amount'=>$fee_receipt->fine_amount,'amount'=>$fee_receipt->amount,'total_amount'=>$fee_receipt->total_amount,'class'=>@$fee_receipt->student_info->student_class->name,'stream'=>@$fee_receipt->student_info->stream->name,'pay_mode'=>$fee_receipt->payment_type,'cheque_no'=>$fee_receipt->cheque_no,'bank'=>$fee_receipt->bank,'cheque_date'=>$fee_receipt->cheque_date,'transaction_no'=>$fee_receipt->transaction_no,'fee_type'=>$feeReceipts->name];
                        $srno++;
                    }
                }
            }
            
        
        ksort($dailyCollection);
      
        $mediums = $this->FeeCategories->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->FeeCategories->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->FeeCategories->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('dailyCollection','date_from','date_to','mediums','getFeeCategories','studentClasses','streams','expenses'));
    }

    public function receiptDetail()
    {
         $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $payment_type=$this->request->getData('payment_type');

            //pr($payment_type);exit;
            
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));

            //pr($date_to);exit;

            
            $expenses=$this->FeeCategories->Expenses->find();
                $expenses->where(['Expenses.expense_date >='=>$date_from,'Expenses.expense_date <='=>$date_to,'payment_mode'=>'Cash'])
                ->select(['total_amount'=>$expenses->func()->sum('amount')]);
               
            $getFeeCategories = $this->FeeCategories->find();
            $getFeeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>['FeeTypeRoles']]);
            $srno=0;
            foreach ($getFeeCategories as $feeCategory) 
            {
                $fee_category_id=$feeCategory->id;
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($fee_category_id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                            return $q
                                    ->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                                     $q->where(['payment_type IN'=>$payment_type])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                                        $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students','StudentClasses']);
                                            return $q;
                                        }]);
                                        return $q;
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->order('FeeReceiptDatas.receipt_date');
                        }]
                    ]);
                    
                    foreach ($feeReceiptsMonthly->fee_types as $fee_receipt)
                    { //echo $fee_receipt->fee_receipt_data->total_amount;
                        $dailyCollection[strtotime($fee_receipt->fee_receipt_data->receipt_date)][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date,'fine_amount'=>$fee_receipt->fee_receipt_data->fine_amount,'amount'=>$fee_receipt->fee_receipt_data->amount,'total_amount'=>$fee_receipt->fee_receipt_data->total_amount,'class'=>@$fee_receipt->fee_receipt_data->student_info->student_class->name,'stream'=>@$fee_receipt->fee_receipt_data->student_info->stream->name,'pay_mode'=>$fee_receipt->fee_receipt_data->payment_type,'cheque_no'=>$fee_receipt->fee_receipt_data->cheque_no,'bank'=>$fee_receipt->fee_receipt_data->bank,'cheque_date'=>$fee_receipt->fee_receipt_data->cheque_date,'transaction_no'=>$fee_receipt->fee_receipt_data->transaction_no,'fee_type'=>$fee_receipt->name];
                        $srno++;
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id,$payment_type){
                                    $q->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['payment_type IN'=>$payment_type])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->order('FeeReceipts.receipt_date');
                                       
                                       $q->leftJoinWith('StudentInfos',function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students','StudentClasses']);
                                            return $q;
                                        });
                                        return $q;
                                        
                            }]
                    ]);
                    foreach ($feeReceipts->fee_receipts as $fee_receipt)
                    {
                        $dailyCollection[$feeReceipts->name][strtotime($fee_receipt->receipt_date)][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>@$fee_receipt->student_info->student->name,'father_name'=>@$fee_receipt->student_info->student->father_name,'scholar_no'=>@$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date,'fine_amount'=>$fee_receipt->fine_amount,'amount'=>$fee_receipt->amount,'total_amount'=>$fee_receipt->total_amount,'class'=>@$fee_receipt->student_info->student_class->name,'stream'=>@$fee_receipt->student_info->stream->name,'pay_mode'=>$fee_receipt->payment_type,'cheque_no'=>$fee_receipt->cheque_no,'bank'=>$fee_receipt->bank,'cheque_date'=>$fee_receipt->cheque_date,'transaction_no'=>$fee_receipt->transaction_no,'fee_type'=>$feeReceipts->name];
                        $srno++;
                    }
                }
            }
            
        }
        ksort($dailyCollection);
      
        $mediums = $this->FeeCategories->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->FeeCategories->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->FeeCategories->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('dailyCollection','date_from','date_to','mediums','getFeeCategories','studentClasses','streams','expenses','medium_id','student_class_id','stream_id','payment_type'));
    }
    public function searchReceipt()
    {
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $feeReceipts=$this->FeeCategories->FeeReceipts->find();
                $feeReceipts->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id]);
            if($this->request->getData('search_cheque_no')=='Search')
            {
                $cheque_no=$this->request->getData('cheque_no');
                $feeReceipts->where(['FeeReceipts.cheque_no'=>$cheque_no]);
            }
            else if($this->request->getData('search_receipt_no')=='Search')
            {
                $receipt_no=$this->request->getData('receipt_no');
                $feeReceipts->where(['FeeReceipts.receipt_no'=>$receipt_no]);
            }
                $feeReceipts->contain(['FeeCategories','EnquiryFormStudents','StudentInfos'=>['Students']]);
                $feeReceipts->leftJoinWith('EnquiryFormStudents');
                $feeReceipts->leftJoinWith('StudentInfos');
            //pr($feeReceipts->toArray()); exit;
            $this->set(compact('feeReceipts','date_from','date_to'));
        }
    }
    public function exportNonScholarRegister()
    {
         $this->viewBuilder()->layout('');
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
       
                $date_from=date('Y-m-d');
                $date_to=date('Y-m-d');
           
            $feeReceipts=$this->FeeCategories->FeeReceipts->find();
                $feeReceipts->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id]);
                $feeReceipts->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to]);
                $feeReceipts->where(['FeeReceipts.enquiry_form_student_id IS'=>NULL,'FeeReceipts.old_fee_id IS'=>NULL,'FeeReceipts.student_info_id IS'=>NULL]);
                $feeReceipts->contain(['FeeReceiptRows'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>'FeeTypes']]]);
                $feeReceipts->order(['FeeReceipts.receipt_date'=>'ASC']);
            $this->set(compact('feeReceipts','date_from','date_to'));
        
    }
    public function nonScholarRegister()
    {
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put','get'])) 
        {
            if(!empty($this->request->getData('daterange')))
            {
                $daterange=explode('/',$this->request->getData('daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
            }
            else
            {
                $date_from=date('Y-m-d');
                $date_to=date('Y-m-d');
            }
            $feeReceipts=$this->FeeCategories->FeeReceipts->find();
                $feeReceipts->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id]);
                $feeReceipts->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to]);
                $feeReceipts->where(['FeeReceipts.enquiry_form_student_id IS'=>NULL,'FeeReceipts.old_fee_id IS'=>NULL,'FeeReceipts.student_info_id IS'=>NULL]);
                $feeReceipts->contain(['FeeReceiptRows'=>['FeeTypeMasterRows'=>['FeeTypeMasters'=>'FeeTypes']]]);
                $feeReceipts->order(['FeeReceipts.receipt_date'=>'ASC']);
            $this->set(compact('feeReceipts','date_from','date_to'));
        }
    }
    public function dailyCollection()
    {
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put','get'])) 
        {
            if(!empty($this->request->getData('daterange')))
            {
                $daterange=explode('/',$this->request->getData('daterange'));
                $date_from=date('Y-m-d',strtotime($daterange[0]));
                $date_to=date('Y-m-d',strtotime($daterange[1]));
            }
            else
            {
                $date_from=date('Y-m-d');
                $date_to=date('Y-m-d');
            }
            $feeCategories = $this->FeeCategories->find();
                $feeCategories->where(['is_deleted'=>'N']);
            foreach ($feeCategories as $feeCategory) {
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to){
                            return $q->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to){
                                return $q->select(['FeeReceiptDatas.receipt_date',
                                                'receipt_min_no'=>$q->func()->min('receipt_no'),
                                                'receipt_max_no'=>$q->func()->max('receipt_no'),
                                                'total_amount'=>$q->func()->sum('total_amount'),
                                                ])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->group(['FeeReceiptDatas.fee_type_role_id','FeeReceiptDatas.receipt_date'])
                            ->order('FeeReceiptDatas.receipt_date');
                        }]
                    ]);
                    $feeGrossReceiptsMonthly[]=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to){
                            return $q->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to){
                                return $q->select([
                                                'receipt_min_no'=>$q->func()->min('receipt_no'),
                                                'receipt_max_no'=>$q->func()->max('receipt_no'),
                                                'total_amount'=>$q->func()->sum('total_amount'),
                                                ])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->group(['FeeReceiptDatas.fee_type_role_id']);
                        }]
                    ]);
                    foreach ($feeReceiptsMonthly->fee_types as $feeReceiptsMonth) {
                        $dailyCollection[strtotime($feeReceiptsMonth->fee_receipt_data->receipt_date)][$feeReceiptsMonth->name]=['receipt_min_no'=>$feeReceiptsMonth->receipt_min_no,'receipt_max_no'=>$feeReceiptsMonth->receipt_max_no,'total_amount'=>$feeReceiptsMonth->total_amount];
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to){
								$publishedCase = $q->newExpr()
								->addCase(
								$q->newExpr()->add(['payment_type' => 'Cash']),
								$q->newExpr()->add(['total_amount']),
								'integer'
								);
								$unpublishedCase = $q->newExpr()
								->addCase(
								$q->newExpr()->add(['payment_type !=' => 'Cash']),
								$q->newExpr()->add(['total_amount']),
								'integer'
								);
                                return $q->select(['FeeReceipts.fee_category_id','FeeReceipts.receipt_date',
                                                'receipt_min_no'=>$q->func()->min('receipt_no'),
                                                'receipt_max_no'=>$q->func()->max('receipt_no'),
                                                'total_amount'=>$q->func()->sum('total_amount'),'number_published' => $q->func()->sum($publishedCase),
												'number_unpublished' => $q->func()->sum($unpublishedCase),
                                                ])
                                        ->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->group(['FeeReceipts.fee_category_id','FeeReceipts.receipt_date'])
                                        ->order('FeeReceipts.receipt_date');
                            }]
                    ]);
					
                    $feeGrossReceipts[]=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to){
								$publishedCase = $q->newExpr()
								->addCase(
								$q->newExpr()->add(['payment_type' => 'Cash']),
								$q->newExpr()->add(['total_amount']),
								'integer'
								);
								$unpublishedCase = $q->newExpr()
								->addCase(
								$q->newExpr()->add(['payment_type !=' => 'Cash']),
								$q->newExpr()->add(['total_amount']),
								'integer'
								);
                                return $q->select(['FeeReceipts.fee_category_id',
                                                'receipt_min_no'=>$q->func()->min('receipt_no'),
                                                'receipt_max_no'=>$q->func()->max('receipt_no'),
                                                'total_amount'=>$q->func()->sum('total_amount'),
												'number_published' => $q->func()->sum($publishedCase),
												'number_unpublished' => $q->func()->sum($unpublishedCase),
                                                ])
                                        ->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->group(['FeeReceipts.fee_category_id']);
                            }]
                    ]);
                    foreach ($feeReceipts->fee_receipts as $fee_receipt) {
                        $dailyCollection[strtotime($fee_receipt->receipt_date)][$feeReceipts->name]=['receipt_min_no'=>$fee_receipt->receipt_min_no,'receipt_max_no'=>$fee_receipt->receipt_max_no,'total_amount'=>$fee_receipt->total_amount,'cash'=>$fee_receipt->number_published,'others'=>$fee_receipt->number_unpublished];
                    }
                }
            }
           //pr($feeGrossReceipts); exit;
            $this->set(compact('dailyCollection','feeGrossReceipts','feeGrossReceiptsMonthly','date_from','date_to'));
        }
    }

    public function exportConcessionListReport()
    {
        $this->viewBuilder()->layout('');
        $url=$this->request->here();
        $url=parse_url($url,PHP_URL_QUERY);
    
    
        $medium_id=$this->request->query('medium_id'); 
        $student_class_id=$this->request->query('student_class_id'); 
        $stream_id=$this->request->query('stream_id'); 
        $fee_type_role_ids=$this->request->query('fee_type_role_id'); 
        $fee_category_ids=$this->request->query('fee_category_id'); 
        $daterange=$this->request->query('daterange'); 
        $date_from=date('Y-m-d',strtotime($daterange[0]));
        $date_to=date('Y-m-d',strtotime($daterange[1]));
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        
            
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            if($fee_type_role_ids!="-")
            {
                $getFeeTypeRoles = $this->FeeCategories->FeeTypes->find()
                            ->select(['fee_category_id'])
                            ->where(['fee_type_role_id IN'=>$fee_type_role_ids])
                            ->first();
                $fee_category_ids[]=$getFeeTypeRoles->fee_category_id;
            }
            
            $getFeeCategories = $this->FeeCategories->find()->where(['id IN'=>$fee_category_ids]);
            $getFeeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>['FeeTypeRoles']]);

            foreach ($getFeeCategories as $feeCategory) {
                $fee_category_id=$feeCategory->id;
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($fee_category_id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to,$fee_type_role_ids,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                            return $q->where(['FeeTypes.fee_type_role_id IN'=>$fee_type_role_ids])
                                    ->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                     $q->select(['FeeReceiptDatas.receipt_date','FeeReceiptDatas.id',
                                                'FeeReceiptDatas.fee_category_id',
                                                'FeeReceiptDatas.fee_type_role_id',
                                                'FeeReceiptDatas.id','concession_amount','receipt_no'
                                                ])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                                        $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students']);
                                            return $q;
                                        }]);
                                        return $q;
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->order('FeeReceiptDatas.receipt_date')
                            ->having(['FeeReceiptDatas.concession_amount >'=>0]);
                        }]
                    ]);
                   // pr($feeReceiptsMonthly->toArray());
                    $srno=0;
                    foreach ($feeReceiptsMonthly->fee_types as $fee_receipt)
                    {
                        if(!empty($fee_receipt->fee_receipt_data->student_info->stream->name))
                        {
                            $dailyCollection[$fee_receipt->fee_receipt_data->student_info->student_class_id][$fee_receipt->fee_receipt_data->student_info->stream->name][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date];
                        }
                        else
                        {

                            $dailyCollection[$fee_receipt->fee_receipt_data->student_info->student_class_id][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date];
                        }
                        $srno++;
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                    $q->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->order('FeeReceipts.receipt_date')
                                        ->having(['FeeReceipts.concession_amount >'=>0]);
                                       $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students']);
                                            return $q;
                                        }]);
                                        return $q;
                                        
                            }]
                    ]);
                    $srno=0;
                    foreach ($feeReceipts->fee_receipts as $fee_receipt)
                    {
                        if(!empty($fee_receipt->student_info->stream))
                        {
                            $dailyCollection[$fee_receipt->student_info->student_class_id][$fee_receipt->student_info->stream->name][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>$fee_receipt->student_info->student->name,'father_name'=>$fee_receipt->student_info->student->father_name,'scholar_no'=>$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date,'stream'=>''];
                        }
                        else
                        {
                            $dailyCollection[$fee_receipt->student_info->student_class_id][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>$fee_receipt->student_info->student->name,'father_name'=>$fee_receipt->student_info->student->father_name,'scholar_no'=>$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date];
                        }

                        $srno++;
                    }
                }
            }
            
        
        
        ksort($dailyCollection);
        $feeTypeRoles = $this->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->FeeCategories->find()->where(['id !='=>2]);
        $feeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $mediums = $this->FeeCategories->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->FeeCategories->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->FeeCategories->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('dailyCollection','date_from','date_to','feeCategories','feeTypeRoles','mediums','getFeeCategories','studentClasses','streams'));
    }

    public function concessionList()
    {
        $dailyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $fee_type_role_ids=$this->request->getData('fee_type_role_id');
            $fee_category_ids=$this->request->getData('fee_category_id');
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            if(!empty($fee_type_role_ids))
            {
                $getFeeTypeRoles = $this->FeeCategories->FeeTypes->find()
                            ->select(['fee_category_id'])
                            ->where(['fee_type_role_id IN'=>$fee_type_role_ids])
                            ->first();
                $fee_category_ids[]=$getFeeTypeRoles->fee_category_id;
            }
            
            $getFeeCategories = $this->FeeCategories->find()->where(['id IN'=>$fee_category_ids]);
            $getFeeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>['FeeTypeRoles']]);

            foreach ($getFeeCategories as $feeCategory) {
                $fee_category_id=$feeCategory->id;
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($fee_category_id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to,$fee_type_role_ids,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                            return $q->where(['FeeTypes.fee_type_role_id IN'=>$fee_type_role_ids])
                                    ->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                     $q->select(['FeeReceiptDatas.receipt_date','FeeReceiptDatas.id',
                                                'FeeReceiptDatas.fee_category_id',
                                                'FeeReceiptDatas.fee_type_role_id',
                                                'FeeReceiptDatas.id','concession_amount','receipt_no'
                                                ])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to]);
                                        $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students']);
                                            return $q;
                                        }]);
                                        return $q;
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->order('FeeReceiptDatas.receipt_date')
                            ->having(['FeeReceiptDatas.concession_amount >'=>0]);
                        }]
                    ]);
                   // pr($feeReceiptsMonthly->toArray());
                    $srno=0;
                    foreach ($feeReceiptsMonthly->fee_types as $fee_receipt)
                    {
                        if(!empty($fee_receipt->fee_receipt_data->student_info->stream->name))
                        {
                            $dailyCollection[$fee_receipt->fee_receipt_data->student_info->student_class_id][$fee_receipt->fee_receipt_data->student_info->stream->name][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date];
                        }
                        else
                        {

                            $dailyCollection[$fee_receipt->fee_receipt_data->student_info->student_class_id][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'name'=>$fee_receipt->fee_receipt_data->student_info->student->name,'father_name'=>$fee_receipt->fee_receipt_data->student_info->student->father_name,'scholar_no'=>$fee_receipt->fee_receipt_data->student_info->student->scholar_no,'date'=>$fee_receipt->fee_receipt_data->receipt_date];
                        }
                        $srno++;
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                    $q->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->order('FeeReceipts.receipt_date')
                                        ->having(['FeeReceipts.concession_amount >'=>0]);
                                       $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                            $q->select(['StudentInfos.id','StudentInfos.student_class_id','StudentInfos.medium_id','StudentInfos.stream_id']);
                                            if(!empty($medium_id))
                                            {
                                                $q->where(['medium_id'=>$medium_id]);
                                            }
                                            if(!empty($student_class_id))
                                            {
                                                $q->where(['student_class_id'=>$student_class_id]);
                                            }
                                            if(!empty($stream_id))
                                            {
                                                $q->where(['stream_id'=>$stream_id]);
                                            }
                                            $q->contain(['Mediums','Streams','Students']);
                                            return $q;
                                        }]);
                                        return $q;
                                        
                            }]
                    ]);
                    $srno=0;
                    foreach ($feeReceipts->fee_receipts as $fee_receipt)
                    {
                        if(!empty($fee_receipt->student_info->stream))
                        {
                            $dailyCollection[$fee_receipt->student_info->student_class_id][$fee_receipt->student_info->stream->name][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>$fee_receipt->student_info->student->name,'father_name'=>$fee_receipt->student_info->student->father_name,'scholar_no'=>$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date,'stream'=>''];
                        }
                        else
                        {
                            $dailyCollection[$fee_receipt->student_info->student_class_id][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'concession_amount'=>$fee_receipt->concession_amount,'name'=>$fee_receipt->student_info->student->name,'father_name'=>$fee_receipt->student_info->student->father_name,'scholar_no'=>$fee_receipt->student_info->student->scholar_no,'date'=>$fee_receipt->receipt_date];
                        }

                        $srno++;
                    }
                }
            }
            
        }
        
        ksort($dailyCollection);
        $feeTypeRoles = $this->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->FeeCategories->find()->where(['id !='=>2]);
        $feeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $mediums = $this->FeeCategories->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->FeeCategories->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->FeeCategories->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('dailyCollection','date_from','date_to','feeCategories','feeTypeRoles','mediums','getFeeCategories','studentClasses','streams','fee_type_role_ids','fee_category_id','medium_id','stream_id','student_class_id','daterange'));
    }
    public function feeComponentLedger()
    {
        $dailyCollection=[];
        $monthlyCollection=[];
        $session_year_id = $this->Auth->User('session_year_id');
        if ($this->request->is(['post','put'])) 
        {
            $feeMonthAlls=$this->FeeCategories->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find('list')->select(['id','name'])->order(['id'=>'ASC']);
            
            $medium_id=$this->request->getData('medium_id');
            $student_class_id=$this->request->getData('student_class_id');
            $stream_id=$this->request->getData('stream_id');
            $fee_type_role_ids=$this->request->getData('fee_type_role_id');
            $fee_category_ids=$this->request->getData('fee_category_id');
            $daterange=explode('/',$this->request->getData('daterange'));
            $date_from=date('Y-m-d',strtotime($daterange[0]));
            $date_to=date('Y-m-d',strtotime($daterange[1]));
            if(!empty($fee_type_role_ids))
            {
                $getFeeTypeRoles = $this->FeeCategories->FeeTypes->find()
                            ->select(['fee_category_id'])
                            ->where(['fee_type_role_id IN'=>$fee_type_role_ids])
                            ->first();
                $fee_category_ids[]=$getFeeTypeRoles->fee_category_id;
            }
            
            $getFeeCategories = $this->FeeCategories->find()->where(['id IN'=>$fee_category_ids]);
            $getFeeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>['FeeTypeRoles']]);
            $srno=0;
            foreach ($getFeeCategories as $feeCategory) {
                 $fee_category_id=$feeCategory->id;
                if($feeCategory->fee_collection=='Individual')
                {
                    $feeReceiptsMonthly=$this->FeeCategories->get($fee_category_id,[
                            'contain' => ['FeeTypes'=>function($q) use($session_year_id,$date_from,$date_to,$fee_type_role_ids,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                            return $q->where(['FeeTypes.fee_type_role_id IN'=>$fee_type_role_ids])
                                    ->contain(['FeeReceiptDatas'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                     $q->select(['FeeReceiptDatas.receipt_date',
                                                'FeeReceiptDatas.fee_category_id',
                                                'FeeReceiptDatas.fee_type_role_id',
                                                'FeeReceiptDatas.id','concession_amount','receipt_no','fine_amount','total_amount'
                                                ])
                                        ->where(['FeeReceiptDatas.is_deleted'=>'N','FeeReceiptDatas.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceiptDatas.receipt_date >='=>$date_from,'FeeReceiptDatas.receipt_date <='=>$date_to])
                                        ->contain(['FeeReceiptRows'=>function($q){
                                            return $q->select(['FeeReceiptRows.fee_receipt_id','total_month_amount'=>$q->func()->sum('FeeReceiptRows.amount')])
                                            ->group(['FeeReceiptRows.fee_receipt_id']);
                                        }]);
                                        
                                        if($fee_category_id!=2)
                                        {
                                            $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                                $q->select(['StudentInfos.id']);
                                                if(!empty($medium_id))
                                                {
                                                    $q->where(['medium_id'=>$medium_id]);
                                                }
                                                if(!empty($student_class_id))
                                                {
                                                    $q->where(['student_class_id'=>$student_class_id]);
                                                }
                                                if(!empty($stream_id))
                                                {
                                                    $q->where(['stream_id'=>$stream_id]);
                                                }
                                                return $q;
                                            }]);
                                        }
                                        else
                                        {
                                            $q->leftJoinWith('EnquiryFormStudents',function($q)use($medium_id,$student_class_id,$stream_id){
                                                $q->select(['EnquiryFormStudents.id']);
                                                if(!empty($medium_id))
                                                {
                                                    $q->where(['medium_id'=>$medium_id]);
                                                }
                                                if(!empty($student_class_id))
                                                {
                                                    $q->where(['student_class_id'=>$student_class_id]);
                                                }
                                                if(!empty($stream_id))
                                                {
                                                    $q->where(['stream_id'=>$stream_id]);
                                                }
                                                return $q;
                                            });
                                        }
                                        return $q;
                            }])
                            ->where(['FeeTypes.is_deleted'=>'N','FeeTypes.session_year_id'=>$session_year_id])
                            ->order('FeeReceiptDatas.receipt_date');
                            //->group(['FeeTypes.id']);
                        }]
                    ]);
                    //pr($feeReceiptsMonthly->toArray()); exit;
                    foreach ($feeReceiptsMonthly->fee_types as $fee_receipt)
                    {
                        $dailyCollection[strtotime($fee_receipt->fee_receipt_data->receipt_date)][$feeReceiptsMonthly->id][$srno]=['fee_type_role_id'=>$fee_receipt->fee_type_role_id,'receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'total_amount'=>$fee_receipt->fee_receipt_data->total_amount,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'fine_amount'=>$fee_receipt->fee_receipt_data->fine_amount];
                        
                        $month_no=date('m',strtotime($fee_receipt->fee_receipt_data->receipt_date));
                        $feeMonths=$this->FeeCategories->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->where(['month_number '=>$month_no])->first();
                        $monthlyCollection[$feeMonths->id][$feeReceiptsMonthly->id][$srno]=['receipt_no'=>$fee_receipt->fee_receipt_data->receipt_no,'total_amount'=>$fee_receipt->fee_receipt_data->total_amount,'concession_amount'=>$fee_receipt->fee_receipt_data->concession_amount,'fine_amount'=>$fee_receipt->fee_receipt_data->fine_amount];
                        $sr_no_rows=0;
                        foreach ($fee_receipt->fee_receipt_data->fee_receipt_rows as $fee_receipt_row) 
                        { 
                           $dailyCollection[strtotime($fee_receipt->fee_receipt_data->receipt_date)][$feeReceiptsMonthly->id][$srno][$fee_receipt->fee_receipt_data->fee_type_role_id]=$fee_receipt_row->total_month_amount;
                           $monthlyCollection[$feeMonths->id][$feeReceiptsMonthly->id][$srno][$fee_receipt->fee_receipt_data->fee_type_role_id]=$fee_receipt_row->total_month_amount;
                        }
                        $srno++;
                    }
                }
                else
                {
                    $feeReceipts=$this->FeeCategories->get($feeCategory->id,[
                            'contain' => ['FeeReceipts'=>function($q) use($session_year_id,$date_from,$date_to,$medium_id,$student_class_id,$stream_id,$fee_category_id){
                                 $q->select(['FeeReceipts.fee_category_id','FeeReceipts.receipt_date','FeeReceipts.id','concession_amount','receipt_no','fine_amount','total_amount','FeeReceipts.old_fee_id'
                                                ])
                                        ->where(['FeeReceipts.is_deleted'=>'N','FeeReceipts.session_year_id'=>$session_year_id])
                                        ->where(['FeeReceipts.receipt_date >='=>$date_from,'FeeReceipts.receipt_date <='=>$date_to])
                                        ->order('FeeReceipts.receipt_date')
                                        
                                        ->contain(['FeeReceiptRows'=>['FeeTypeMasterRows'=>['FeeTypeMasters'],'FeeTypeStudentMasters'=>['FeeTypeMasterRows'=>['FeeTypeMasters']]]]);

                                        if($fee_category_id!=2)
                                        {
                                            $q->contain(['StudentInfos'=>function($q)use($medium_id,$student_class_id,$stream_id){
                                                $q->select(['StudentInfos.id']);
                                                if(!empty($medium_id))
                                                {
                                                    $q->where(['medium_id'=>$medium_id]);
                                                }
                                                if(!empty($student_class_id))
                                                {
                                                    $q->where(['student_class_id'=>$student_class_id]);
                                                }
                                                if(!empty($stream_id))
                                                {
                                                    $q->where(['stream_id'=>$stream_id]);
                                                }
                                                return $q;
                                            }]);
                                        }
                                        else
                                        {
                                            $q->leftJoinWith('EnquiryFormStudents',function($q)use($medium_id,$student_class_id,$stream_id){
                                                $q->select(['EnquiryFormStudents.id']);
                                                if(!empty($medium_id))
                                                {
                                                    $q->where(['medium_id'=>$medium_id]);
                                                }
                                                if(!empty($student_class_id))
                                                {
                                                    $q->where(['student_class_id'=>$student_class_id]);
                                                }
                                                if(!empty($stream_id))
                                                {
                                                    $q->where(['stream_id'=>$stream_id]);
                                                }
                                                return $q;
                                            });
                                        }
                                        return $q;
                                        
                            }]
                    ]);
                    
                   // pr($feeReceipts);exit;
                    foreach ($feeReceipts->fee_receipts as $fee_receipt)
                    {
                        $dailyCollection[strtotime($fee_receipt->receipt_date)][$fee_receipt->fee_category_id][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'total_amount'=>$fee_receipt->total_amount,'concession_amount'=>$fee_receipt->concession_amount,'fine_amount'=>$fee_receipt->fine_amount];
                        $month_no=date('m',strtotime($fee_receipt->receipt_date));
                        $feeMonths=$this->FeeCategories->FeeReceipts->FeeTypeMasters->FeeTypeMasterRows->FeeMonths->find()->select(['id','name'])->where(['month_number '=>$month_no])->first();
                        $monthlyCollection[$feeMonths->id][$fee_receipt->fee_category_id][$srno]=['receipt_no'=>$fee_receipt->receipt_no,'total_amount'=>$fee_receipt->total_amount,'concession_amount'=>$fee_receipt->concession_amount,'fine_amount'=>$fee_receipt->fine_amount];
                        foreach ($fee_receipt->fee_receipt_rows as $fee_receipt_row) {
                            if(!empty($fee_receipt_row->fee_type_student_master))
                            {
                                $fee_type_id=$fee_receipt_row->fee_type_student_master->fee_type_master_row->fee_type_master->fee_type_id;
                            }
                            else if(!empty($fee_receipt_row->fee_type_master_row))
                            {
                                @$fee_type_id=$fee_receipt_row->fee_type_master_row->fee_type_master->fee_type_id;
                            }
                            else
                            {
                                @$fee_type_id=$fee_receipt->fee_category_id.'_oldfee';
                                /*if($feeCategory->id==1 || $feeCategory->id==6)
                                {
                                    
                                }
                                else
                                {
                                    
                                @$fee_type_id='';
                                }*/
                            }

                           $dailyCollection[strtotime($fee_receipt->receipt_date)][$fee_receipt->fee_category_id][$srno][$fee_type_id][]=$fee_receipt_row->amount;
                           $monthlyCollection[$feeMonths->id][$fee_receipt->fee_category_id][$srno][$fee_type_id][]=$fee_receipt_row->amount;
                        }
                        $srno++;
                    }
                }
            }
        }
        
        ksort($dailyCollection);
        ksort($monthlyCollection);
        //pr($dailyCollection); exit;
        $feeTypeRoles = $this->FeeCategories->FeeTypes->FeeTypeRoles->find();
        $feeCategories = $this->FeeCategories->find();
        $feeCategories->where(['is_deleted'=>'N'])->contain(['FeeTypes'=>'FeeTypeRoles']);
        $mediums = $this->FeeCategories->Mediums->find('list')->where(['is_deleted'=>'N']);
        $studentClasses = $this->FeeCategories->StudentClasses->find('list')->where(['is_deleted'=>'N']);
        $streams = $this->FeeCategories->Streams->find('list')->where(['is_deleted'=>'N']);
        $this->set(compact('monthlyCollection','dailyCollection','date_from','date_to','feeCategories','feeTypeRoles','mediums','getFeeCategories','studentClasses','streams','feeMonthAlls'));
    }
    
}
