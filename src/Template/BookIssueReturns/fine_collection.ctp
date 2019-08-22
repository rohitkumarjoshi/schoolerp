<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<style type="text/css">
    .text-capitalize{
        text-transform: capitalize;
    }
    td{
        text-align: center;
    }
    .iradio_minimal-blue{
        margin-right: 5px;
        margin-left: 5px;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" >
                    <label>Fine Collection </label>
                </div>
                <div class="box-body">
                    <div class="form-group">   

                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <div class="form-group">
                                    <label class="control-label">Receive From</label>
                                    <label class="radio-inline" id="student">
                                        <input type="radio" id="option1" value="Student" name="return_from" checked>Student
                                    </label>
                                    <label class="radio-inline" id="employee">
                                        <input type="radio" id="option2" value="Employee" name="return_from">Employee
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?= $this->Form->create($bookIssueReturn,['url'=>['action'=>'getFine.json'],'id'=>'user','autocomplete'=>'off'])?>

                            <div class="col-sm-4 col-sm-offset-4">
                                <?=$this->Form->control('student_id',['class'=>'form-control','placeholder'=>'Student ID','label'=>false,'type'=>'text','id'=>'user_id','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])?>
                                <label class="control-label"></label>
                            </div>
                            <?=$this->Form->end()?>
                        </div> 

                        <?= $this->Form->create($bookIssueReturn,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table" >
                                    <thead>
                                        <tr>
                                            <th class="text-capitalize"><?= __('Sr.No') ?></th>
                                            <th class="text-capitalize">book name</th>
                                            <th class="text-capitalize">accession no.</th>
                                            <th class="text-capitalize">issue by</th>
                                            <th class="text-capitalize">issue on</th>
                                            <th class="text-capitalize">return before</th>
                                            <th class="text-capitalize">return on</th>
                                            <th class="text-capitalize">delay</th>
                                            <th class="text-capitalize">total fine</th>
                                            <th class="text-capitalize">
                                                <label class="checkbox-inline all_fine"><input type="checkbox" id="all_fine">Fine Paid</label>
                                            </th>
                                            <th class="actions"><?= __('Actions') ?></th>                            
                                        </tr>
                                    </thead>

                                    <tbody id="tbody">
                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-4 col-sm-offset-4">
                                <?= $this->Form->submit('Submit Fine',['class'=>'btn button btnClass']);?>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->element('icheck') ?>
<?= $this->element('loading') ?>
<?php

$js ="
    $(document).ready(function() {
        $('form').not('.hidden').find('input[type=number]').focus();

        function addSrno()
        {
            var i = 0;
            var book_no = [];

            $('.book_no').each(function(){
                if(!!~jQuery.inArray($(this).text(), book_no))
                    $(this).parent().remove();
                else
                    book_no.push($(this).html());
            });

            $('#tbody').find('tr').each(function(){
                i++;
                $(this).find('.index').html(i);
                $(this).find('td').each(function(){
                    $(this).find('.issue_id').attr('name','book_fine['+i+'][id]');
                    $(this).find('.fine_check').attr('name','book_fine['+i+'][fine]');
                });
            });
        }

        function total()
        {
            var i = 0;
            $('#tbody').find('tr').each(function(){
                i += $(this).find('.fine_amount').html(i);
            });
        }

        //check all fine checkbox

        $('#all_fine').on('ifChecked', function () {
            $(':checkbox.fine_check').prop('checked',true);
        });

        $('#all_fine').on('ifUnchecked', function () {
            $(':checkbox.fine_check').prop('checked',false);
        });

        //return by student or employee
        $('#option1').on('ifChecked', function () {
            $('#user_id').attr('name','student_id');
            $('#user_id').attr('placeholder','Student ID');
            $('#user_id').focus();
        });

        $('#option2').on('ifChecked', function () {
                $('#user_id').attr('name','employee_id');
                $('#user_id').attr('placeholder','Employee ID');
                $('#user_id').focus();
        });

        $(document).on('click','.remove_book', function() { 
            var conf = confirm('Do you want to delete this book?');
            if(conf)
                $(this).parent().parent().remove();
                $('form').not('.hidden').find('input[type=number]').focus();
                addSrno();
        });

        
        //if book submit by student or employee.
        $(document).on('submit','#user', function( event ) { 
            event.preventDefault();

            if($('#user_id').hasClass('processing'))
                    return;
                    
            $('#user_id').addClass('processing');

            var check = true;

            if(check)
            {
                url = $(this).attr('action');
                $.post(url, $(this).serialize(), function(result) {

                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success == 1)
                    {
                        $('#tbody').append(obj.response);
                    }
                    addSrno();

                    $('form').not('.hidden').find('input[type=number]').focus();
                    $('form').not('.hidden').find('input[type=number]').val('');
                    $('#user_id').removeClass('processing');
                });
            }
            else
            {
                alert('Book is already in list');
                $('#user_id').removeClass('processing');
                $('form').not('.hidden').find('input[type=number]').val('');
            }
        });
    });
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>
