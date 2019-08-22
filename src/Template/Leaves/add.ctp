<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <label> Leave  </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($leave,['id'=>'ServiceForm']) ?>
                    <div class="row">
                         <div class="col-md-6">
                             <label class="control-label"> Date From <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('date_from', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y')])?>

                        </div> 
                         <div class="col-md-6">
                             <label class="control-label"> Date To <span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('date_to', ['label' => false, 'class'=>'form-control default-date-picker datepicker','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y')])?>
                              
                        </div> 
                    </div>
                     <span class="help-block"></span>
                     <div class="row">
                       <div class="col-md-4">
                            <label class="control-label"> Half Day </label>
                                <br>
                                <?php
                                echo $this->Form->radio(
                                'half_day',
                                [
                                    ['value' => 'yes', 'text' => ' Yes'],
                                    ['value' => 'no', 'text' => ' No','checked'],
                                    
                                ],
                                ['class'=>'half_day']
                                ); ?>
                            </div> 
                            <div class="col-md-4 halfday_type">
                                <label class="control-label"> Half Day Type </label>
                                <br>
                                <?php
                                echo $this->Form->radio(
                                'halfday_type',
                                [
                                    ['value' => 'first', 'text' => ' First Half','Checked'],
                                    ['value' => 'second', 'text' => ' Second Half'],
                                    
                                ],
                                ['class'=>'halfday_type_value']
                                ); ?>
                            </div>
                            <div class="col-md-4 halfday_date">
                             <label class="control-label"> Half Day<span class="required" aria-required="true"> * </span></label>
                              <?= $this->Form->control('halfday_date', ['label' => false, 'class'=>'form-control default-date-picker datepicker halfDayDateD','type'=>'text','placeholder'=>'Select Date','data-date-format'=>'dd-mm-yyyy'])?>

                            </div> 
                        </div> 
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label"> Reason <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('reason',[
                                'label' => false,'class'=>'form-control ','placeholder'=>'Enter reason here','type'=>'textarea','required','rows'=>2]);?>
                            </div>
                        </div>
                  <?php if(!empty($id)){ ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"> Status </label>
                            <div class="form-group">
                                <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'select2','label'=>false,'style'=>'width:100%')) ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <span class="help-block"></span>
                    </div>
                </div>
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
</div>
<?= $this->element('selectpicker') ?> 
<?= $this->element('datepicker') ?>
<?= $this->element('icheck') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('validate') ?> 


<?php
$js="
$(document).ready(function(){



   $('.halfday_type').hide();
   $('.halfday_date').hide();
    $(document).on('ifChecked', '.half_day', function(){
        var isNow= $(this).val();
        if(isNow == 'yes'){
            $('.halfday_type').show();
            $('.halfday_date').show();
            $('.halfDayDateD').prop('required', true);
        }
        else{
            $('.halfday_type').hide();
            $('.halfday_date').hide();
            $('.halfDayDateD').prop('required', false);
        }
    });

    $('#ServiceForm').validate({ 
        rules: {
            vehicle_id: {
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
$js.='
$(document).ready(function(){
    $(document).on("change", "#date-to,#date-from", function(){
        var txtStartDate = $("#date-from").val();
        var txtEndDates = $("#date-to").val();
        
        var Sdate = txtStartDate.split("-");
        var Syear= Sdate[2];
        var Smonth= Sdate[1];
        var Sday= Sdate[0];
        var SYMDDate = Syear + "-" + Smonth + "-" + Sday;
        var newdate= new Date(SYMDDate);
        var StartDateStrToTime=newdate.getTime();

        var Edate = txtEndDates.split("-");
        var Eyear= Edate[2];
        var Emonth= Edate[1];
        var Eday= Edate[0];
        var EYMDDate = Eyear + "-" + Emonth + "-" + Eday;
        var newdates= new Date(EYMDDate);
        var EndDateStrToTime=newdates.getTime(); 
        if(EndDateStrToTime>=StartDateStrToTime)
        {}
        else
        {
           $("#date-to").val("");
        } 

    });

    $(document).on("change", "#halfday-date", function(){
        var txtStartDate = $("#date-from").val();
        var txtEndDates = $("#date-to").val();
        var selectedDate = $(this).val();
        //-- YMD
        var Sdate = txtStartDate.split("-");
        
        var Syear= Sdate[2];
        var Smonth= Sdate[1];
        var Sday= Sdate[0];
        var SYMDDate = Syear + "-" + Smonth + "-" + Sday;
        var newdate= new Date(SYMDDate);
        var StartDateStrToTime=newdate.getTime();

        var Edate = txtEndDates.split("-");
        var Eyear= Edate[2];
        var Emonth= Edate[1];
        var Eday= Edate[0];
        var EYMDDate = Eyear + "-" + Emonth + "-" + Eday;
        var newdates= new Date(EYMDDate);
        var EndDateStrToTime=newdates.getTime();

        var Cdate = selectedDate.split("-");
        var Cyear= Cdate[2];
        var Cmonth= Cdate[1];
        var Cday= Cdate[0];
        var CYMDDate = Cyear + "-" + Cmonth + "-" + Cday;
        var newdateses= new Date(CYMDDate);
        var SelectedDateStrToTime=newdateses.getTime();
 
        if((SelectedDateStrToTime>=StartDateStrToTime) && (SelectedDateStrToTime<=EndDateStrToTime))
        {}
        else
        {
            //alert("Please Select date between "+txtStartDate+" to " +txtEndDates+".");
            $(this).val(txtEndDates);
        } 
    });
});';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>

