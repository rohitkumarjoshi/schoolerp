<?= $this->Form->create('') ?>
                <table class="table table-strip">
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th style="text-align:center;"><?=__('Class Name')?></th>
                            <th style="text-align:center;"><?=__('Enquiry No')?></th>
                            <th style="text-align:center;"><?=__('Form No')?></th>
                            <th scope="col" style="text-align:center;"><?= __('Student Name ') ?></th>
                            <th scope="col" style="text-align:center;"><?= __('Father Name ') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $this->Form->control('class_id', ['options'=>$StudentClasses,'empty' => 'Select Class','label'=>false,'class'=>'select2 student_search','style'=>'width:100%']); ?>
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
                        </tr>
                  </tbody>
                </table>
                <?= $this->Form->end() ?>
                <table class="table" >
                    <thead>
                        <tr style="white-space: nowrap;">
                            <th style="text-align:center !important;">Sr. No</th>
                            <th style="text-align:center !important;">Class Name</th>
                            <th style="text-align:center !important;">Enquiry No</th>
                            <th style="text-align:center !important;">Form No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th style="text-align:left !important;">Action</th>
                        </tr>
                    </thead> 
                    <tbody id="replace_data">

                    </tbody>
                </table>