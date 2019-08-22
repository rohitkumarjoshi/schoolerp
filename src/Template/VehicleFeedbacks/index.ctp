 <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label> View Feedbacks </label>
                </div> 
                <div class="box-body">
                    <?php $page_no=$this->Paginator->current('Sections'); $page_no=($page_no-1)*10; ?>
                     <table id="example1" class="table" >
                        <thead>
                            <tr>
                                <th scope="col"><?= __('Sr.No') ?></th>
                                <th scope="col"><?= __('Vehicle No ') ?></th>
                                <th scope="col"><?= __('Driver') ?></th>
                                <th scope="col"><?= __('Student') ?></th>
                                <th scope="col"><?= __(' Date') ?></th>
                                <th scope="col"><?= __('Comment') ?></th>
                                <th scope="col"><?= __('Status') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($vehicleFeedbacks as $vehicleFeedback): ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td >
                                <?= $vehicleFeedback->has('vehicle')? $vehicleFeedback->vehicle->vehicle_no: '' ?>
                                </td> 
                                <td >
                                    <?= $vehicleFeedback->has('driver')? $vehicleFeedback->driver->name: '' ?>
                                </td>
                                 <td >
                                <?php echo $vehicleFeedback->student->name;?>
                                </td>
                                 <td >
                                <?php echo $vehicleFeedback->date;?>
                                </td> 
                                <td >
                                <?php echo $vehicleFeedback->comment;?>
                                </td>
                                <td>
                                <?php
                                if($vehicleFeedback->is_deleted=='Y')
                                {
                                    echo 'Deactive';
                                }
                                else{
                                    echo 'Active';
                                }
                                ?>
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
<?= $this->element('validate') ?> 
<?php
$js="
$(document).ready(function(){

    $('#ServiceForm').validate({ 
        rules: {
            name: {
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
<?= $this->element('datepicker') ?> 