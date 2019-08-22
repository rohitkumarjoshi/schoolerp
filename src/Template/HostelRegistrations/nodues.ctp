<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> No Dues Form </label>
            </div><hr>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($hostelRegistration,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Student <span class="required" aria-required="true"> * </span></label>
                        </div>
                        <div class="col-md-8">
                           <?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','empty'=>'Select Student','style'=>'width:100%'])?>
                        </div>
                    </div> 
                    <span class="help-block"></span>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
                        </div>
                        <div class="col-md-8">
                           <?= $this->Form->control('hostel_tc_nodues', ['options' => $status,'label' => false, 'class'=>'select2','empty'=>'Select Status','style'=>'width:100%'])?>
                        </div>
                    </div> 
                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','id'=>'submit_member']); ?>
                                    </div>
                                </div>
                            </center>       
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
         <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
                <hr>
            </div> 
            <div class="box-body">
                <?php $page_no=$this->Paginator->current('hostelRegistrations'); $page_no=($page_no-1)*10; ?>
                 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Student ') ?></th>
                            <th scope="col"><?= __('No Dues Status ') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($nodue_data_stu_info as $nodue_data_stu_info): ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td >
                            <?php echo $nodue_data_stu_info->student->name;?>
                            </td>
                            <td >
                            <?php echo $nodue_data_stu_info->hostel_tc_nodues;?>
                            </td> 
                            
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 