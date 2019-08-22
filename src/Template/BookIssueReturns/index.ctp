<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookIssueReturn[]|\Cake\Collection\CollectionInterface $bookIssueReturns
 */
?>

<style type="text/css">
    .autofill_list{
        max-height: 100px;
        position: absolute;
        width: 100%;
        overflow: overlay;
        z-index: 1;
    }
</style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label> Book Issue & Returns </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create($bookIssueReturn,['autocomplete'=>'off','url'=>['action'=>'index']]) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Book Name</label>
                                <?= $this->Form->control('data[book_id]', ['options' => $books, 'empty' =>'--Select--','label'=>false,'class'=>'select4','style'=>'width:100%;','val'=>$bookIssueReturn->book_id]);?>
                                <div class="row col-sm-12">
                                    <div class="list-group autofill_list">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Student</label>
                                <?php echo $this->Form->control('data[student_id]', ['options' => $students, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'student-id']);?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Employee</label>
                                <?php echo $this->Form->control('data[employee_id]', ['options' => $employees, 'empty' =>'--Select--','label'=>false,'class'=>'select2','style'=>'width:100%;','id'=>'employee-id']);?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">  
                                <div class="form-group">
                                    <label class="control-label"> Date From to To
                                        </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?= $this->Form->control('data[daterange]',['class'=>'form-control pull-left daterangepicker','label'=>false,'placeholder'=>'Date range','readonly'=>true]) ?>
                                    </div>
                                </div>     
                            </div> 
                            <div class="col-sm-4">
                                <label class="control-lable"> Status </label>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <?= $this->Form->checkbox('data[issued]',['id'=>'issued','value'=>'','hiddenField'=>false,'checked'=>(1 == isset($_POST['data']['issued'])?'checked':false)]) ?> Issued
                                    </label>
                                    <label class="checkbox">
                                        <?= $this->Form->checkbox('data[returned]',['id'=>'returned','value'=>'','hiddenField'=>false,'checked'=>(1 == isset($_POST['data']['returned'])?'checked':false)]) ?> Returned
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <?= $this->Form->checkbox('data[date_to <]',['id'=>'overdue','value'=>date('Y-m-d'),'hiddenField'=>false,'checked'=>(1 == isset($_POST['data']['date_to <'])?'checked':false)]) ?> Overdue
                                    </label>
                                    <label class="checkbox"></label>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <?= $this->Form->submit('Search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                    </div>
                <?= $this->Form->end() ?>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-8 text-right">
                            <table class="pull-right">
                                <tr>
                                    <td>
                                        <?= $this->Form->create($bookIssueReturn,['autocomplete'=>'off','url'=>['action'=>'export']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th><?= __('Sr.No') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('book_id') ?></th>
                                <th scope="col"><?= 'Issue By' ?></th>
                                <th scope="col"><?= $this->Paginator->sort('date_from') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('date_to') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('return_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('fine_amount') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>         
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($bookIssueReturns as $bookIssueReturn): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $bookIssueReturn->has('book') ? $this->Html->link($bookIssueReturn->book->name, ['controller' => 'Books', 'action' => 'view', $EncryptingDecrypting->encryptData($bookIssueReturn->book->id)]) : '' ?></td>
                                <td><?= $bookIssueReturn->has('student') ? $bookIssueReturn->student->name : $bookIssueReturn->employee->name ?></td>
                                <td><?= h($bookIssueReturn->date_from) ?></td>
                                <td><?= h($bookIssueReturn->date_to) ?></td>
                                <td><?= h($bookIssueReturn->return_date) ?></td>
                                <td><?= $this->Number->format($bookIssueReturn->fine_amount) ?></td>
                                <td><?= h($bookIssueReturn->status) ?></td>
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
<?= $this->element('student_autofill',['selector'=>'#student-id']) ?>
<?= $this->element('employee_autofill',['selector'=>'#employee-id']) ?>
<?= $this->element('icheck') ?>
<?= $this->element('daterangepicker') ?>

<?php
$js ="
    $(document).ready(function() {

        $('#issued').on('ifChecked', function () {
            $(':checkbox#returned').iCheck('uncheck');
            $(':checkbox#overdue').iCheck('uncheck');
        });

        $('#returned').on('ifChecked', function () {
            $(':checkbox#issued').iCheck('uncheck');
            $(':checkbox#overdue').iCheck('uncheck');
        });

        $('#overdue').on('ifChecked', function () {
            $(':checkbox#issued').iCheck('uncheck');
            $(':checkbox#returned').iCheck('uncheck');
        });
    });
";

$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>