
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Notice </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($schoolNotice,['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label class="control-label"> Title <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('title',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Title','type'=>'text','required']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Valid Till <span class="required" aria-required="true"> * </span></label>
                                <?php echo $this->Form->control('valid_date',[
                                'label' => false,'class'=>'form-control datepicker','placeholder'=>'Date','type'=>'text','data-date-format'=>'dd-mm-yyyy','required']);?>
                            </div>  
                        </div>
                        
                        <span class="help-block"></span>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label"> Document File</label>
                                <?php echo $this->Form->control('doc_file',[
                                'label' => false,'class'=>'','placeholder'=>'Date','type'=>'file']);?>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label"> Description </label>
                                <?php echo $this->Form->control('description',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Description','rows'=>1]); ?>
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

<?= $this->element('validate') ?> 
<?= $this->element('datepicker') ?>  
<?php
$js='
$(document).ready(function() { 
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
    $(document).on("click","#submit_member",function(){
       var description = $("#description").val();;
       var doc = $("#doc-file").val();
        if(doc =="" && description ==""){
            alert("Please fill description or upload document");
            return false;
        }
        else
        {            
        }
    });


    // validate signup form on keyup and submit
     $("#ServiceForm").validate({ 
        rules: { 
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
 
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 