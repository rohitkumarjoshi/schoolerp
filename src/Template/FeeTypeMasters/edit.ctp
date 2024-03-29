<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Edit Form </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($feeTypeMaster,['id'=>'ServiceForm']) ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Fee Category <span class="required" aria-required="true"> * </span></label>
                            <?php echo $this->Form->control('fee_category_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Fee Category---','options'=>$feeCategories,'required'=>true, 'id'=>'fee_category_id']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Fee Type <span class="required" aria-required="true"> * </span></label>
                           <?php echo $this->Form->control('fee_type_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Fee Type---','required'=>true,'id'=>'fee_type_id']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Vehicle Station</label>
                           <?php echo $this->Form->control('vehicle_station_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Station---','options'=>$vehicleStations,'id'=>'vehicle_station_id']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Gender</label>
                            <?php echo $this->Form->control('gender_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Gender---','options'=>$genders]);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Hostel</label>
                            <?php echo $this->Form->control('hostel_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Hostel---']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Medium</label>
                            <?php echo $this->Form->control('medium_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Medium---','options'=>$mediums,'id'=>'medium_id']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Class</label>
                            <?php echo $this->Form->control('student_class_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Class---','id'=>'student_class_id']);?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Stream</label>
                            <?php echo $this->Form->control('stream_id',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Stream---','id'=>'stream_id']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Student Type </label>
                            <?php 
                            $student_wise[]=['value'=>'New','text'=>'New'];
                            $student_wise[]=['value'=>'Old','text'=>'Old']; 
                            echo $this->Form->control('student_wise',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Student Type---','id'=>'student_wise','options'=>$student_wise]);?>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"> Status <span class="required" aria-required="true"> * </span></label>
                            <?php 
                            
                            echo $this->Form->control('is_deleted',[
                            'label' => false,'class'=>'form-control','empty'=>'---Select Student Type---','id'=>'student_wise','options'=>$status,'required'=>true]);?>
                        </div>
                    </div>
                    <span class="help-block"></span>
                    <div class="box-footer">
                        <div class="row">
                            <center>
                                <div class="col-md-12">
                                    <div class="col-md-offset-3 col-md-6">  
                                        <?php echo $this->Form->button('Next',['class'=>'btn btn-primary','id'=>'next','type'=>'button']); ?>
                                    </div>
                                </div>
                            </center>       
                        </div>
                    </div>
                    <div id="feeStructure">

                        <table class="table table-bordered table-hover" id="tab">
                            <thead>
                            <tr>
                                <th width="15%">
                                    Fee Category:
                                </th>
                                <td width="35%">
                                    <?= $feeTypeMaster->fee_category->name;?>
                                </td>
                             
                                <th width="15%">
                                    Fee Type:
                                </th>
                                <td width="35%">
                                    <?= $feeTypeMaster->fee_type->name;?>
                                </td> 
                            </tr>
                            </thead>
                            <tbody>
                         
                            <?php if($feeTypeMaster->fee_category_id==1){ ?>
                                <tr>
                                    <td colspan="10" >
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td>Month</td>
                                            <?php
                                                $y=0;
                                                foreach ($feeMonths as $key => $value) {
                                                    echo " <td>".$value->name."</td>";
                                                    echo $this->Form->control('fee_type_master_rows['.$y.'][fee_month_id]',['label' => false,'type'=>'hidden','value'=>$value->id]);
                                                 $y++;
                                                }

                                            ?>
                                            </tr>
                                            <tr>
                                                <td>Fee</td>
                                            <?php
                                            $x=0;
                                                foreach ($feeMonths as $key => $value) { 
                                                    echo " <td>".$this->Form->control('fee_type_master_rows['.$x.'][amount]',['label' => false,'class'=>'form-control input-small','placeholder'=>'Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'id'=>'fee_type_master_rows['.$x.'][amount]','value'=>$feeTypeMaster->fee_type_master_rows[$x]->amount])."</td>";
                                                    $x++;
                                                }
                                            ?>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>   
                            <?php
                            }
                            else if($feeTypeMaster->fee_category_id==6){ $installment=sizeof($feeTypeMaster->fee_type_master_rows);

                                ?>
                                <tr id="install">
                                    <th> <lable style="line-height: 3.429;">Enter Installment</lable>
                                    </th>
                                    <td colspan="3">
                                        <?php echo $this->Form->control('installment',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Installment','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id'=>'installmentWise','required'=>'required','value'=>$installment]);?>
                                    </td>
                                <tr>
                                <?php
                                if($installment > 0){
                                    $xy=0; 
                                    $yx=1; 
                                    foreach ($feeTypeMaster->fee_type_master_rows as $key => $value) {
                                    ?>
                                    <tr class="copiedtr">
                                        <td>
                                            <lable style="line-height: 3.429;">Installment <?= $yx; ?></lable>
                                        </td>
                                        <td colspan='3'>
                                                <?= $this->Form->control('fee_type_master_rows['.$xy.'][amount]',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Fee Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'required'=>'required','value'=>$value->amount]); 
                                                echo $this->Form->control('fee_type_master_rows['.$xy.'][fee_month_id]',['label' => false,'type'=>'hidden','value'=>0]);
                                                ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $xy++;
                                    $yx++;
                                    }
                                }
                                ?>
                            <?php
                            }
                            else{ ?>
                                <tr>
                                    <th> <lable style="line-height: 3.429;">Enter Fee</lable>
                                    </th>
                                    <td colspan="3">
                                        <?php echo $this->Form->control('fee_type_master_rows[0][amount]',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Fee Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');,'id'=>'fee_type_master_rows[0][amount]'",'value'=>$feeTypeMaster->fee_type_master_rows[0]->amount]);
                                        echo $this->Form->control('fee_type_master_rows[0][fee_month_id]',['label' => false,'type'=>'hidden','value'=>0]);
                                        ?>
                                    </td>
                                <tr>
                            <?php
                            } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11" align="center">
                                        <?php echo $this->Form->button('Submit',['class'=>'btn btn-primary','type'=>'submit']); ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="main_table" style="display:none">
    <tbody> 
     <tr class="copiedtr">
        <td>
            <lable style="line-height: 3.429;">Installment</lable>
        </td>
        <td colspan='3'>
                <?= $this->Form->control('amount',['label' => false,'class'=>'form-control ','placeholder'=>'Enter Fee Amount','type'=>'text','oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",'required'=>'required']); 
                echo $this->Form->control('fee_month_id',['label' => false,'type'=>'hidden','value'=>0]);
                ?>
        </td>
    </tr>
    </tbody>
</table>
<?= $this->element('validate') ?> 
<?php
 
$js="

$(document).ready(function(){
    var kk=1;
    $(document).on('click', '#next', function(e){
        url = '".$this->Url->build(['action'=>'getFeeStructure'])."';
        kk++;
        $.ajax({
            url: url,
            type: 'post',
            data: $('form').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'text',
            async:false,
            success: function(response) 
            {
                $('#feeStructure').html(response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               $('#feeStructure').html(textStatus);
            }
        });
    });
    $(document).on('change', '#fee_category_id', function(e){
        var fee_category_id = $(this).val();
        url = '".$this->Url->build(['action'=>'getFeeType.json'])."';
        $.post(
            url, 
            {fee_category_id: fee_category_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#fee_type_id').html(obj.response);
        });
    });
    $(document).on('change', '#medium_id', function(e){
        var medium_id = $(this).val();
        url = '".$this->Url->build(['action'=>'getClass.json'])."';
        $.post(
            url, 
            {medium_id: medium_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#student_class_id').html(obj.response);
        });
    });
    $(document).on('keyup', '#installmentWise', function(e){
        var numberOfTaxtbox = $(this).val();
        if(numberOfTaxtbox !=''){
           var taxtboxt = $('#main_table tbody').html();
            for (var i=0; i < numberOfTaxtbox ; i++) { 
              $('table#tab tbody').append(taxtboxt); 
            }
            renamerows();
        }
        else{
            $('table#tab tbody tr.copiedtr').remove();
        }
    });

    $(document).on('change', '#student_class_id', function(e){
        var student_class_id = $(this).val();
        url = '".$this->Url->build(['action'=>'getStream.json'])."';
        $.post(
            url, 
            {student_class_id: student_class_id}, 
            function(result) {
                var obj = JSON.parse(JSON.stringify(result));
                $('#stream_id').html(obj.response);
        });
    });
    $('#ServiceForm').validate({ 
        rules: {
            fee_category_id: {
                required: true
            },
            fee_type_id: {
                required: true
            }, 
            amount: {
                required: true
            },
            'fee_type_master_rows[0][amount]':{
                required: true
            },
        },
        submitHandler: function () {
            $('#loading').show();
            $('#submit_member').attr('disabled','disabled');
            form.submit();
        }
    });

});
    function renamerows(){
        var i=0;
        var inc=0;
        $('#tab tbody tr.copiedtr').each(function(){
            inc = i+1
            $(this).find('td:nth-child(1) lable').html('Installment ' + inc);
            $(this).find('td:nth-child(2) input[type=text]').attr({name:'fee_type_master_rows['+i+'][amount]',id:'fee_type_master_rows['+i+'][amount]'});
            $(this).find('td:nth-child(2) input[type=hidden]').attr({name:'fee_type_master_rows['+i+'][fee_month_id]',id:'fee_type_master_rows['+i+'][fee_month_id]'});
            i++;
        });
    }


";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

