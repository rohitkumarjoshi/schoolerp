<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title" >Search Student</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
           <div class="box-body table-responsive" >
                <?= $this->Form->create('') ?>
               <table class="table table-strip">
                    <thead>
                        <tr style="white-space: nowrap;">

                            <th style="text-align:center;"><?=__('Scholar No')?></th>
                            <th style="text-align:center;"><?=__('Class Name')?></th>
                            <th scope="col" style="text-align:center;"><?= __('Student Name ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Father Name ') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $this->Form->control('scholar_number', ['type'=>'text','placeholder' => 'Enter Scholar Number','label'=>false,'class'=>'form-control student_search','style'=>'width:100%','autofocus'=>true]);?>
                            </td>
                            <td>
                                <?php echo $this->Form->control('class_id', ['options'=>$StudentClasses,'empty' => 'Select Class','label'=>false,'class'=>'select2 student_search','style'=>'width:100%']); ?>
                            </td> 
                            <td>
                                <?php echo $this->Form->control('student_name', ['type'=>'text','placeholder' => 'Enter Student Name','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td>
                            <td>
                               <?php echo $this->Form->control('father_name', ['type'=>'text','placeholder' => 'Enter Father Name','label'=>false,'class'=>'form-control student_search','style'=>'width:100%']);?>
                            </td>
                        </tr>
                  </tbody>
               </table>
               <?php echo $this->Form->hidden('fee_type', ['label'=>false,'class'=>'form-control ','value'=>$fee_type]);?>
                <?= $this->Form->end() ?>
                <table class="table" >
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th style="text-align:center !important;">Sr. No</th>
                            <th style="text-align:center !important;">Class Name</th>
                            <th style="text-align:center !important;">Scholar No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th style="text-align:center !important;">Action</th>
                        </tr>
                    </thead> 
                    <tbody id="replace_data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
