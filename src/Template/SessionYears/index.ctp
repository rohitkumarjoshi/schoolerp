
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <?php if(!empty($id)){ ?>
                     <label > Edit Session </label>
                <?php }else{ ?>
                   <label> Add Session </label>
                <?php } ?>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($sessionYear,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Date From <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>  
                    <div class="row">   
                        <div class="col-md-11">
                            <?php echo $this->Form->control('from_date',[
                            'label' => false,'class'=>'form-control datepicker','placeholder'=>'Ex. 1-Apr-2018','type'=>'text','data-date-format'=>'dd-M-yyyy']);?>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Date To <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>  
                    <div class="row">   
                        <div class="col-md-11">
                            <?php echo $this->Form->control('to_date',[
                            'label' => false,'class'=>'form-control datepicker','placeholder'=>'Ex. 31-Mar-2019','type'=>'text','data-date-format'=>'dd-M-yyyy']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Session Name <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>  
                    <div class="row">   
                        <div class="col-md-11">
                            <?php echo $this->Form->control('session_name',[
                            'label' => false,'class'=>'form-control','placeholder'=>'Ex. 2018-2019','type'=>'text']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Session Year <span class="required" aria-required="true"> * </span></label>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-11">
                            <?php echo $this->Form->control('session_year_name',[
                            'label' => false,'class'=>'form-control','placeholder'=>'Ex. 2018','type'=>'text']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <?= $this->Form->control('status',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
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
                 <label> View Session List </label>
            </div> 
            <div class="box-body">
                 <table id="example1" class="table table-striped" >
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th>
                            <th scope="col"><?= __('Date From ') ?></th>
                            <th scope="col"><?= __('Date To ') ?></th>
                            <th scope="col"><?= __('Session Name ') ?></th>
                            <th scope="col"><?= __('Session Year ') ?></th>
                            <th scope="col"><?= __('Status ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($sessionYears as $sessionYear): ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>
                            <?php echo $sessionYear->from_date;?>
                            </td>
                            <td>
                            <?php echo $sessionYear->to_date;?>
                            </td>
                            <td>
                            <?php echo $sessionYear->session_name;?>
                            </td>
                            <td>
                            <?php echo $sessionYear->session_year_name;?>
                            </td>
                            <td>
                            <?php echo $sessionYear->status;?>
                            </td>
                            <td class="actions" align="center">
                                <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'index', $EncryptingDecrypting->encryptData($sessionYear->id)],['class'=>'btn btn-info btn-xs editbtn','escape'=>false, 'data-widget'=>'Edit Session', 'data-toggle'=>'tooltip', 'data-original-title'=>'Edit Session']) ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            from_date: {
                required: true
            },
            to_date: {
                required: true
            },
            session_name: {
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