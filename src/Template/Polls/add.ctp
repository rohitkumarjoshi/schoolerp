
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <label > Poll </label>
            </div>
            <div class="box-body">
                <div class="form-group">    
                    <?= $this->Form->create($poll,['id'=>'ServiceForm','type'=>'file']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Select Role <span class="required" aria-required="true"> * </span></label> 
                                <?php $type['All']='All';?>
                                <?php $type['Teacher']='Teacher';?>
                                <?php $type['Student']='Student';?>
                                <?php echo $this->Form->control('poll_type',[
                                'label' => false,'class'=>'form-control','empty'=>'Select...','options' => $type,'required'=>true]);?>
                            </div>  
                            <div class="col-md-8">
                                <label class="control-label"> Question <span class="required" aria-required="true"> * </span></label> 
                                <?php echo $this->Form->control('question',[
                                'label' => false,'class'=>'form-control','placeholder'=>'Question','required'=>true,'type'=>'text']);?>
                            </div>  
                        </div>
                        <span class="help-block"></span>
                        <div class="row">
                            <fieldset><legend>Poll Options</legend>
                                <center>                        
                                <table style="width:80%;align:center" class="table table-bordered table-hover" id="parant_table" >
                                    <thead>
                                        <tr style="background-color:#8a8a8a2e;">    
                                            <th style="text-align:center">Option</th>
                                            <th style="text-align:center">Correct </th>  
                                        </tr>
                                    </thead>
                                    <tbody class="parant_table">
                                    <tr class="hello">
                                        <td>
                                            <?php echo $this->Form->control('ss',[
                                    'label' => false,'class'=>'form-control objective','placeholder'=>'Option 1','type'=>'text','required'=>true]);?>
                                        </td> 
                                        <td>
                                             <?php $types[]=['text'=>'Correct' , 'value'=>'Correct' , 'class' =>'correct'];?>
                                            <?php $types[]=['text'=>'Incorrect' , 'value'=>'Incorrect' ,'selected' =>'selected'];?>
                                            <?php echo $this->Form->control('correct_answer',[
                                            'label' => false,'class'=>'form-control correct_answer two','id'=>'correct_answer','empty'=>'Select...','options' => $types,'required'=>true]);?>
                                        </td> 
                                    </tr>
                                    <tr class="hello">
                                        <td>
                                            <?php echo $this->Form->control('ss',[
                                    'label' => false,'class'=>'form-control objective','placeholder'=>'Option 2','type'=>'text','required'=>true]);?>
                                        </td> 
                                        <td> 
                                            <?php echo $this->Form->control('correct_answer',[
                                            'label' => false,'class'=>'form-control correct_answer two','empty'=>'Select...','options' => $types,'required'=>true]);?>
                                        </td> 
                                    </tr>
                                    <tr class="hello">
                                        <td>
                                            <?php echo $this->Form->control('ss',[
                                    'label' => false,'class'=>'form-control objective','placeholder'=>'Option 3','type'=>'text','required'=>true]);?>
                                        </td> 
                                        <td> 
                                            <?php echo $this->Form->control('correct_answer',[
                                            'label' => false,'class'=>'form-control correct_answer two','empty'=>'Select...','options' => $types,'required'=>true]);?>
                                        </td> 
                                    </tr>
                                    <tr class="hello">
                                        <td>
                                            <?php echo $this->Form->control('ss',[
                                    'label' => false,'class'=>'form-control objective','placeholder'=>'Option 4','type'=>'text','required'=>true]);?>
                                        </td> 
                                        <td> 
                                            <?php echo $this->Form->control('correct_answer',[
                                            'label' => false,'class'=>'form-control correct_answer two','empty'=>'Select...','options' => $types,'required'=>true]);?>
                                        </td> 
                                    </tr>
                                    </tbody>
                                </table>
                                </center>
                            </fieldset>
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
<?php
$js='
$(document).ready(function() { 
   remaneRows();  
     

    $(document).on("change", ".correct_answer", function(){
       var selecteds = $(this).val();
        var correct=0;
        $(".correct_answer").each(function(){
            var selectedVal = $(this).val();
            if(selectedVal == "Correct"){
                $(this).removeClass("two"); 
                $(this).addClass("one"); 
                correct++;
            }
            else{
                $(this).removeClass("one"); 
                $(this).addClass("two");  
            }
        });
 
        $(".two").each(function(){ 
            if(correct>0){
                $(".two option.correct").attr("disabled",true); 
            }
            else{
                $(".two option.correct").removeAttr("disabled",false); 
            }
        });

    });


    $("form").submit(function () {
        var corrects=0;
        $(".correct_answer").each(function(){
            var selectedVal = $(this).val();
            if(selectedVal == "Correct"){ 
                corrects++;
            }
        });
        if(corrects==0){
            alert("Please select one currect answer.")
            return false;
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
            //$("#submit_member").attr("disabled","disabled");
            form.submit();
        }
    }); 
});

 
function remaneRows(){
    var x = 0;
    $("#parant_table tbody.parant_table tr.hello").each(function(){  
        $(this).find("td select.correct_answer").attr({name:"poll_rows["+x+"][correct_answer]", id:"poll_rows["+x+"][correct_answer]"});
        $(this).find("td input.objective").attr({name:"poll_rows["+x+"][objective]", id:"poll_rows["+x+"][objective]"}); 
        x++;
    });
}
';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
 