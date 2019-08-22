 
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Event Edit</label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($gallery,['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Select Role <span class="required" aria-required="true"> * </span></label>
                                <?php $type['All']='All';?>
                                <?php $type['Teacher']='Teacher';?>
                                <?php $type['Student']='Student';?>
                                <?php echo $this->Form->control('role_type',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type,'required'=>true]);?>
                            </div> 
                            <div class="col-md-4">
                                <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('title',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Event Location <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('event_location',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Event Location','type'=>'text','required']);?>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Date From <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date_from',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y',strtotime($gallery->date_from))]);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Date to <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('date_to',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y',strtotime($gallery->date_to))]);?>
                            </div>
                            <div class="col-md-4">
                                <div class="bootstrap-timepicker"> 
                                    <label class="control-label"> Event Time <span class="required" aria-required="true"> * </span></label>
                                            <?php echo $this->Form->control('time_start',[
                                'label' => false,'class'=>'form-control timepicker','placeholder'=>'Time','type'=>'text','required']);?>
                                </div>
                            </div>
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Cover Image </label>
                                <?php echo $this->Form->control('cover_image',[
                                'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Description <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>2,'required']);?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label"> Shareable</label>
                                 <?= $this->Form->control('shareable', ['type' => 'checkbox','label'=>false,'class'=>'checkDisable','value'=>1])?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Status </label>
                                <div class="form-group">
                                    <?php 
                                        $status[]=['value'=>'N','text'=>'Active'];
                                        $status[]=['value'=>'Y','text'=>'Deactive'];
                                    ?>
                                    <?= $this->Form->control('is_deleted',array('options' => $status,'class'=>'form-control','label'=>false,'style'=>'width:100%')) ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <fieldset><legend>Event Schedule</legend>
                                <center>                        
                                <table style="width:80%;align:center" class="table table-bordered table-hover" id="parant_table" >
                                    <thead>
                                        <tr style="background-color:#8a8a8a2e;">    
                                            <th style="text-align:center">Event Name</th>
                                            <th style="text-align:center">Date </th>
                                            <th style="text-align:center">Time</th>
                                            <th colspan="2" style="text-align:center">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="parant_table">
                                    <?php  $y=1;
                                        foreach ($gallery->event_schedules as $event_schedule) { 
                                        ?>    

                                        <tr class="hello">
                                            <td>
                                                <?php echo $this->Form->control('ss',[
                                        'label' => false,'class'=>'form-control name','placeholder'=>'Name','type'=>'text','required','value'=>$event_schedule->name]);?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->control('ss',[
                                        'label' => false,'class'=>'form-control datepicker schedule_date','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required','value'=>date('d-m-Y',strtotime($event_schedule->schedule_date))]);?>
                                                 
                                            </td>
                                            <td>
                                                <div class="bootstrap-timepicker"> 
                                                    <?php echo $this->Form->control('ss',[
                                        'label' => false,'class'=>'form-control timepicker schedule_time','placeholder'=>'Time','type'=>'type','required','value'=>$event_schedule->schedule_time]);?>
                                                </div> 
                                            </td>
                                            <td>
                                                <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
                                            </td>
                                            <?php if($y==1){ echo "<td></td>";}
                                            else{
                                            ?>
                                            <td>
                                                <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        $y++;
                                        } ?>
                                    </tbody>
                                </table>
                                </center>
                            </fieldset>
                        </div>
  -->
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

<table id="sample" style="display:none;">
    <tbody>
        <tr class="hello">
        <td><?php echo $this->Form->control('ss',[
                                'label' => false,'class'=>'form-control name','placeholder'=>'Name','type'=>'text']);?>
        </td>
        <td>
            <?php echo $this->Form->control('ss',[
                                'label' => false,'class'=>'form-control datepicker schedule_date ','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy']);?>
        </td>
        <td>
            <div class="bootstrap-timepicker" > 
            <?php echo $this->Form->control('ss',[
                                'label' => false,'class'=>'form-control schedule_time timepicker','placeholder'=>'Time','type'=>'text']);?>
            </div>
        </td>
        <td>
            <button type="button" onClick="add_row()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button>
        </td>
        <td>
            <button type="button"  class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash-o"></i></button>
        </td>
        </tr>
    </tbody> 
</table>

 

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('icheck') ?> 
<?php
$js='
$(document).ready(function() { 
    remaneRows();
    remaneRows2();
    $(document).on("click", ".remove_row", function(){
        $(this).closest("#parant_table tr").remove();
        remaneRows();
    });
    $(document).on("click", ".remove_row2", function(){
        $(this).closest("#parant_table2 tr").remove();
        remaneRows2();
    });
    $(document).on("change", "#date-to", function(){
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

    $(document).on("change", ".schedule_date", function(){
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

    // validate signup form on keyup and submit
     $("#ServiceForm").validate({ 
        rules: {
            description: {
                required: true
            },
            academic_category_id: {
                required: true
            },
            date: {
                required: true
            }
        },
        submitHandler: function () {
            $("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
});

function add_row(){  
    var new_line=$("#sample tbody").html();
    $("#parant_table tbody.parant_table").append(new_line);
    $(".timepicker").timepicker({
      showInputs: false
    });
    $(".datepicker").datepicker();
    remaneRows();
}
function remaneRows(){
    var x = 0;
    $("#parant_table tbody.parant_table tr.hello").each(function(){  
        $(this).find("td input.name").attr({name:"event_schedules["+x+"][name]", id:"event_schedules["+x+"][name]"});
        $(this).find("td input.schedule_date").attr({name:"event_schedules["+x+"][schedule_date]", id:"event_schedules["+x+"][schedule_date]"});
        $(this).find("td input.schedule_time").attr({name:"event_schedules["+x+"][schedule_time]",id:"event_schedules["+x+"][schedule_time]"});
        x++;
    });
}

function add_row2(){  
    var new_line=$("#sample2 tbody").html();
    $("#parant_table2 tbody.parant_table2").append(new_line); 
    remaneRows2();
}
function remaneRows2(){
    var f =0;
     
}
    
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 