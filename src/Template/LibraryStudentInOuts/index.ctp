<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View List </b>
            </div> 
            <div class="box-body">
                <div class="row">
                    <?= $this->Form->create($inout,['autocomplete'=>'off']) ?>
                        <div class="col-sm-3">
                            <label class="control-lable"> Student </label>
                            <?= $this->Form->control('data[student_id]',['options'=>$students,'empty'=>'--Select--','class'=>'select2','style'=>'width: 100%;','label'=>false])?>
                        </div>

                        <div class="col-sm-3">
                            <label class="control-lable"> Date From </label>
                            <?= $this->Form->control('data[in_date >=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy'])?>
                        </div>

                        <div class="col-sm-3">
                            <label class="control-lable"> Date To </label>
                            <?= $this->Form->control('data[in_date <=]',['class'=>'datepicker form-control','label'=>false,'data-date-format'=>'dd-mm-yyyy'])?>
                        </div>

                        <div class="col-sm-3">
                            <?= $this->Form->submit('search',['class'=>'btn btn-success btnClass'])?>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                   
                <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                 <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th><?= __('Sr.No') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('in_date') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('out_date') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($libraryStudentInOuts as $libraryStudentInOut): ?>
                        <tr>
                            <td><?php echo ++$page_no;?></td>
                            <td><?= $libraryStudentInOut->student->name ?></td>
                            <td><?= h($libraryStudentInOut->in_date) ?></td>
                            <td><?= h($libraryStudentInOut->in_time) ?></td>
                            <td><?= h($libraryStudentInOut->out_date) ?></td>
                            <td><?= h($libraryStudentInOut->out_time) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?= $this->element('pagination') ?> 
            </div>
        </div>
    </div>
</div>
<?= $this->element('selectpicker') ?>
<?= $this->element('datepicker') ?>

<?php 
$js ="
    $().ready(function(){

        var data = [];

        // for(var i=0;i<10;i++)
        // {
        //     data[i] = new Option('vivek'+i, i, true, true);
        // }

        // var newState = new Option('vivek', '2', true, true);
        // //alert(data);
        // // Append it to the select
        // $('#data-student-id').append(newState).trigger('reset');

    });
";

$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
 ?>