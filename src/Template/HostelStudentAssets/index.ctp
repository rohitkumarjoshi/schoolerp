<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
            </div> 
            <div class="box-body " >
            	 <div class="row ">
                    <div class="col-md-12">
                    <?= $this->Form->create(' ',['id'=>'ServiceForm']) ?>
                            <div class="col-md-12 " >
                                <div class="row"> 
                                    <div class="col-md-3">
                                        <label class="control-label">Search By Student</label>
                                       <?= $this->Form->control('student_id', ['options' => $students,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select All Student','dataplaceholder'=>'Select Student'])?>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label"  style=" visibility: hidden;">Search</label>
                                         <?php echo $this->Form->button('Search',['class'=>'btn btn-md btn-success filter','id'=>'submit_member','name'=>'search_report','value'=>'yes','style'=>'margin-right: 0px;color:white !important;height:38px;']); ?> 
                                    </div>
                                    
                                </div>
                           
                        </div>
                         <?= $this->Form->end() ?>
                    </div>
                </div>
                <?php if($data_exist=='data_exist') { ?>
                <?php $page_no=$this->Paginator->current('hostelStudentAssets'); $page_no=($page_no-1)*10; ?>
                 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Name ') ?></th>
                            <th scope="col"><?= __('Assets ') ?></th>
                            <th scope="col"><?= __('Quantity ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($hostelStudentAssets as $hostelStudentAsset): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td >
                            <?php echo $hostelStudentAsset->student->name;?>
                            </td> 
                            <td >
                            <?php echo $hostelStudentAsset->hostel_room_asset->name;?>
                            </td>
                             <td >
                            <?php 
                            $quantity=0;
                            if(!empty($hostelStudentAsset->hostel_student_asset_returns))
                            {
                                foreach ($hostelStudentAsset->hostel_student_asset_returns as $hostel_student_asset_return) {
                                    $quantity+=$hostel_student_asset_return->quantity;
                                }
                                
                            }
                            echo $hostelStudentAsset->quantity-$quantity;
                            ?>
                            </td> 
                            <td>
                            <?php
                            if($hostelStudentAsset->is_deleted=='Y')
                            {
                                echo 'Deactive';
                            }
                            else{
                                echo 'Active';
                            }
                            ?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($hostelStudentAsset->student_id)],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>' Edit Assets', 'data-toggle'=>'tooltip', 'data-original-title'=>' Edit Assets']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
            <?php } else { ?>
                     <div class="row">
                        <div class="col-md-12 text-center">
                            <h3> <?= $data_exist ?></h3>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 