<div class="row">
    <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <i class="fa fa-pencil-square-o fas" style="float:none !important;"></i> <label > Edit Vehicle Feedback </label>
                    <?php }else{ ?>
                        <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Create Vehicle Feedback </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($vehicleFeedback,['id'=>'ServiceForm']) ?>
                         <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">  Vehicle <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-11">
                                 <?= $this->Form->control('vehicle_id', ['options'=>$vehicles,'label' => false, 'class'=>'select2','empty'=>'Select Vehicle','style'=>'width:100%'])?>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">  Driver </label>
                            </div>
                            <div class="col-md-11">
                                <?= $this->Form->control('driver_id', ['options'=>$drivers,'label' => false, 'class'=>'select2','empty'=>'Select Driver','style'=>'width:100%'])?>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-11">
                               <?= $this->Form->control('date', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-M-yyyy'])?>
                            </div>
                        </div><br>
                         <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Comment <span class="required" aria-required="true"> * </span></label>
                            </div>
                            <div class="col-md-11">
                               <?= $this->Form->control('comment', ['label' => false, 'class'=>'form-control ','type'=>'textarea','placeholder'=>'Enter Comment'])?>
                            </div>
                        </div>

                        <?php if(!empty($id)){ ?>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Status </label>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <span class="help-block"></span>
                        <div class="box-footer">
                            <div class="row">
                                <center>
                                    <div class="col-md-12">
                                        <div class="col-md-offset-3 col-md-6">  
                                            <?php echo $this->Form->button('Submit',['class'=>'btn button','id'=>'submit_member']); ?>
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
        <div class="col-md-7">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
                </div> 
                <div class="box-body">
                    <?php $page_no=$this->Paginator->current('VehicleFeedbacks'); $page_no=($page_no-1)*10; ?>
                     <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Vehicle No ') ?></th>
                                <th scope="col"><?= __('Student') ?></th>
                                <th scope="col"><?= __('Date') ?></th>
                                <th scope="col"><?= __('Comment') ?></th>
                                <th scope="col"><?= __('Status') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($vehicleFeedbacks as $vehicleFeedback): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td >
                                    <?= $vehicleFeedback->has('vehicle')? $vehicleFeedback->vehicle->vehicle_no: '' ?>
                                </td> 
                                <td >
                                <?php echo $vehicleFeedback->student->name;?>
                                </td>
                                 <td >
                                <?php echo $vehicleFeedback->date;?>
                                </td> 
                                <td >
                                <?php echo $vehicleFeedback->comment;?>
                                </td>
                                <td>
                                <?php
                                if($vehicleFeedback->is_deleted=='Y')
                                {
                                    echo 'Deactive';
                                }
                                else{
                                    echo 'Active';
                                }
                                ?>
                                </td>
                                <td class="actions" align="center">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil-square-o"></i> '), ['action' => 'add', $EncryptingDecrypting->encryptData($vehicleFeedback->id)],['class'=>'btn btn-info btn-xs','escape'=>false, 'data-widget'=>'Edit Section', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Section']) ?>
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
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
           
            vehicle_id: {
                required: true
            },
            date: {
                required: true
            },
            comment: {
                required: true
            }
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?> 