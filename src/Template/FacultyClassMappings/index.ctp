<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FacultyClassMapping[]|\Cake\Collection\CollectionInterface $facultyClassMappings
 */
?>

    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <?php if(!empty($id)){ ?>
                        <label > Edit Faculty Class Mapping </label>
                    <?php }else{ ?>
                        <label> Add Faculty Class Mapping </label>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <div class="form-group">    
                        <?= $this->Form->create($facultyClassMapping,['url'=>['action'=>'add'],'id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Class <span class="required" aria-required="true"> * </span></label>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-11">
                                <?php echo $this->Form->control('class_mapping_id', ['empty'=>'--Select--','options' => $classMappings,'class'=>'select2','style'=>'width:100%','label'=>false,'required']);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Employee <span class="required" aria-required="true"> * </span></label>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-11">
                                <?php echo $this->Form->control('employee_id', ['options' => $employees,'empty'=>'--Select--','class'=>'select2','style'=>'width:100%','label'=>false,'required']);?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Subject <span class="required" aria-required="true"> * </span></label>
                            </div>
						</div>
						<div class="row">
                            <div class="col-md-11">
                                <?php echo $this->Form->control('subject_ids[]', ['options' => [],'empty'=>'--Select--','class'=>'select2','style'=>'width:100%','label'=>false,'required','multiple'=>'multiple']);?>
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
                     <label> View List </label>
                </div> 
                <div class="box-body">
                    <!--<?php $page_no=$this->Paginator->current('achivementCategories'); $page_no=($page_no-1)*10; ?>-->
                     <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Class') ?></th>
                                <th scope="col"><?= __('Employee ') ?></th>
                                <th scope="col"><?= __('Subject ') ?></th>
                                <th scope="col" class="actions" style="text-align:center;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($facultyClassMappings as $facultyClassMapping): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td>
                                    <?= $facultyClassMapping->has('class_mapping') ? $facultyClassMapping->class_mapping->medium->name.' > '.$facultyClassMapping->class_mapping->student_class->name : '' ?>
                                    <?= $facultyClassMapping->class_mapping->has('stream') ? " > ".$facultyClassMapping->class_mapping->stream->name : '' ?>
                                    <?= $facultyClassMapping->class_mapping->has('section') ? " > ".$facultyClassMapping->class_mapping->section->name : '' ?>
                                </td>
                                <td><?= $facultyClassMapping->has('employee') ? $facultyClassMapping->employee->name : '' ?></td>
                                <td><?= $facultyClassMapping->has('subject') ? $facultyClassMapping->subject->name : '' ?></td>
                                <td class="actions">
                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $facultyClassMapping->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $facultyClassMapping->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['class'=>'filter_form','url'=>['controller'=>'FacultyClassMappings','action'=>'delete',$facultyClassMapping->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
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
<?= $this->element('validate') ?>
<?= $this->element('loading') ?>
<?php
$js="
$(document).ready(function(){

    $(document).on('change','#class-mapping-id',function(){
        $('#subject-ids').empty();
        $('#subject-ids').select2();
        var url = '".$this->Url->build(['action'=>'getSubjects.json'])."';
        
        $.post(url,{class_mapping_id: $(this).val()},function(result){
            var response = JSON.parse(JSON.stringify(result));
            var og = null;
            var optgroup = $();
            $.each(response.response, function (index, value) {
                if(value.parent != og)
                {
                    og = value.parent;
                    if(optgroup.children().length > 0)
                        $('#subject-ids').append(optgroup);

                    optgroup = $('<optgroup/>');
                    optgroup.attr('label',value.parent);
                }

                var o = $('<option/>', {value: value.id, text: value.name});

                if(optgroup.attr('label') !== null && optgroup.attr('label') !== undefined)
                    optgroup.append(o);
                else
                    $('#subject-ids').append(o);
            });

            if(optgroup.children().length > 0)
                $('#subject-ids').append(optgroup);
        });
    });

});";
$this->Html->scriptBlock($js,['block'=>'scriptPageBottom']);
?>