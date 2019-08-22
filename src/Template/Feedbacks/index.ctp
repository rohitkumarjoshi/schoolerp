<div class="box box-primary">
    <div class="box-header with-border"> 
        <label > Feedback List</label> 
    </div>
    <div class="box-body" >
       <?php if(!empty($feedbacks)) { ?>
        <?php $page_no=$this->Paginator->current('Feedbacks'); $page_no=($page_no-1)*20; ?>
        <div class="row">
            <div class="col-md-12">  
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th>#</th>
                            <th>Person Name</th>
                            <th>Mobile No</th>
                            <th>Description</th>
                            <th>Feedback Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($feedbacks as $feedback) :?>
                            <tr>
                                <td> <?php echo $i; ?></td>
                                <td>
                                    <?php  
                                    if(!empty($feedback->student_id))
                                        {
                                          echo @$feedback->student->name;    
                                         }
                                        else
                                        {
                                            echo @$feedback->employee->name;
                                        }
                                    ?>
                                </td>
                                <td><?= h($feedback->mobile_no) ?> </td>
                                <td><?= h($feedback->description) ?> </td>
                                <td><?= h(date('d-M-Y',strtotime(h($feedback->created_on)))) ?> </td>
                               <td>
                                <?php
                                if($feedback->is_deleted=='Y')
                                {
                                    echo 'Deactive';
                                }
                                else{
                                    echo 'Active';
                                }
                                ?>
                                </td>
                                 <td> 
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $EncryptingDecrypting->encryptData($feedback->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit feedback', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit feedback']) ?>
                                  </td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
   </div>
   <div class="box-footer">
        <?= $this->element('pagination') ?> 
   </div>
</div>  
