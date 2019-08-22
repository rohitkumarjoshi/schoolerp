<div class="box box-primary">
    <div class="box-header with-border">
        <label>Enquiry  Detail</label>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="box-body" >
                <?= $this->Form->create('') ?>
                <table class="table table-strip">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th style="text-align:center;"><?=__('Class Name')?></th>
                            <th style="text-align:center;"><?=__('Enquiry No')?></th>
                            <th style="text-align:center;"><?=__('Form No')?></th>
                            <th scope="col" style="text-align:center;"><?= __('Student Name ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Father Name ') ?></th>
                            <!-- <th scope="col" style="text-align:center;"><?= __('Status') ?></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $this->Form->control('class_id', ['options'=>$studentClasses,'empty' => 'Select Class','label'=>false,'class'=>'select2 student_search','style'=>'width:100%']); ?>
                            </td> 
                            <td>
                                <?php echo $this->Form->control('enquiry_no', ['type'=>'text','placeholder' => 'Enter Enquiry Number','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td>
                            <td>
                                <?php echo $this->Form->control('admission_form_no', ['type'=>'text','placeholder' => 'Admission Form Number','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td>
                            <td>
                                <?php echo $this->Form->control('name', ['type'=>'text','placeholder' => 'Enter Student Name','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td>
                            <td>
                               <?php echo $this->Form->control('father_name', ['type'=>'text','placeholder' => 'Enter Father Name','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td> 
                            <!-- <td> <?php //echo $this->Form->control('enquiry_status',['empty' => 'Select Status','label' => false,'class'=>'form-control student_search','options'=>$enquiryStatuses,'required'=>true]);?>
                            </td> -->
                        </tr>
                  </tbody>
                </table>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="box-body " style="width: 100% !important;">
               <table class="table" >
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th>#</th>
                            <th scope="col"><?=__('Enquiry No.')?></th>
                            <th scope="col"><?=__('Form No.')?></th>
                            <th scope="col"><?=__('Name') ?></th>
                            <th scope="col"><?=__('Gender') ?></th>
                            <th scope="col"><?= __('Father Name ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Medium ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Class ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Stream ') ?></th>
                            <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody id="replace_data">
                        <?php
                        $i=0;
                        foreach($enquiryFormStudents as $enquiryFormStudent){ ?>
                        <tr>
                            <td><?= ++$i; ?></td>
                            <td><?=h ($enquiryFormStudent->enquiry_no)?></td>
                            <td><?=h ($enquiryFormStudent->admission_form_no)?></td>
                            <td><?=h ($enquiryFormStudent->name)?></td>
                            <td><?=h ($enquiryFormStudent->gender->name)?></td>
                            <td><?=h ($enquiryFormStudent->father_name)?></td>
                            <td><?=h ($enquiryFormStudent->medium->name)?></td>
                            <td><?=h ($enquiryFormStudent->student_class->name)?></td>
                            <td><?=h (@$enquiryFormStudent->stream->name)?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-eye"></i> '), ['controller'=>'EnquiryFormStudents','action'=>'view', $EncryptingDecrypting->encryptData($enquiryFormStudent->id)],['class'=>'btn btn-info btn-xs viewbtn','escape'=>false, 'data-widget'=>'View Enquiry', 'data-toggle'=>'tooltip', 'data-original-title'=>'View Enquiry']) ?>
                                <?php if($enquiryFormStudent->admission_form_no == 0){ ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $enquiryFormStudent->id], ['confirm' => __('Are you sure you want to Deactive # {0}?'),'class'=>'btn btn-xs green']) ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?> 
<?php
$js="
$(document).ready(function(){
    $(document).on('keyup','input.student_search',function(){
        fetchData();
    });
    $(document).on('change','select.student_search',function(){
        fetchData();
    });
    function fetchData()
    {
       url = '".$this->Url->build(['action'=>'getEnquiryData.json'])."';
        $.ajax({
            url: url,
            type: 'post',
            data: $('form').serialize(),
            contentType: 'application/x-www-form-urlencoded',
            success: function(result)
            {
                var obj = JSON.parse(JSON.stringify(result));
                $('#replace_data').html(obj.response);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               $('#replace_data').html(errorThrown);
            }
        }); 
    }

});";
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>