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
                    <label>Return Book</label>
                </div>
                <div class="box-body">
                    <div class="form-group">   
						<div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <div class="form-group">
                                    <label class="control-label">Return By</label>
                                    <label class="radio-inline" id="by_accession">
                                        <input type="radio" id="by_accession_" value="Employee" name="return_by" checked>By Accession
                                    </label>
									<label class="radio-inline" id="by_user">
                                        <input type="radio" id="by_user_" value="Student" name="return_by">By User
                                    </label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <?= $this->Form->create($book,['url'=>['action'=>'getBookByAccession.json'],'id'=>'accession','autocomplete'=>'off'])?>
                                <div class="col-sm-4 col-sm-offset-4">
                                    <?=$this->Form->control('accession_no',['class'=>'form-control','placeholder'=>'Accession No.','label'=>false,'type'=>'text','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])?>
                                    <label class="control-label"></label>
                                </div>
                            <?=$this->Form->end()?>
                        </div> 
						<div class="row">
                            <?= $this->Form->create($book2,['url'=>['action'=>'getBookByUser.json'],'id'=>'user','autocomplete'=>'off','class'=>'hidden'])?>
							<div class="col-sm-4">
                                <label class="control-label">Return From</label>
                                <div class="form-group">
                                    <label class="radio-inline" id="student">
                                        <input type="radio" id="option1" value="Student" name="return_from" checked>Student
                                    </label>
                                    <label class="radio-inline" id="employee">
                                        <input type="radio" id="option2" value="Employee" name="return_from">Employee
                                    </label>
                                </div>
                            </div>
							<div class="col-sm-4">
                                <?=$this->Form->control('student_id',['class'=>'form-control','placeholder'=>'Student ID','label'=>false,'type'=>'text','id'=>'user_id','required','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])?>
                                <label class="control-label"></label>
                            </div>
                            <?=$this->Form->end()?>
                        </div> 

                        <?= $this->Form->create($bookIssueReturn,['id'=>'ServiceForm']) ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-capitalize"><?= __('Sr.No') ?></th>
                                            <th class="text-capitalize">book name</th>
                                            <th class="text-capitalize">accession no.</th>
                                            <th class="text-capitalize">price</th>
                                            <th class="text-capitalize">issue by</th>
                                            <th class="text-capitalize">issue on</th>
                                            <th class="text-capitalize">return before</th>
                                            <th class="text-capitalize">return date</th>
                                            <th class="text-capitalize">
                                                <label class="checkbox-inline all_reissue"><input type="checkbox" id="all_reissue">Re Issue</label>
                                            </th>
                                            <th class="actions"><?= __('Actions') ?></th>
										</tr>
                                    </thead>
									<tbody id="tbody"></tbody>
                                </table>
                            </div>
							<div class="col-sm-4 col-sm-offset-4">
                                <?= $this->Form->submit('Return Books',['class'=>'btn button btnClass']);?>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->element('datepicker') ?>
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
                    $(this).find('.issue_id').attr('name','issue_id['+i+'][id]');
                    $(this).find('.datepicker').attr('name','issue_id['+i+'][return_date]');
                    $(this).find('.reissue').attr('name','issue_id['+i+'][reissue]');
                });
            });
        }

        //check all reissue checkbox

        $('#all_reissue').on('ifChecked', function () {
            $(':checkbox.reissue').prop('checked',true);
        });

        $('#all_reissue').on('ifUnchecked', function () {
            $(':checkbox.reissue').prop('checked',false);
        });

        $('#by_accession_').on('ifChecked', function () {
            $('#user').addClass('hidden');
            $('#accession').removeClass('hidden');
            $('form').not('.hidden').find('input[type=number]').focus();
        });
        
        // return by book or user

        $('#by_user_').on('ifChecked', function () {
            $('#accession').addClass('hidden');
            $('#user').removeClass('hidden');
            $('form').not('.hidden').find('input[type=number]').focus();
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
            var conf = confirm('Do you want to delete this book into list?');
            if(conf)
                $(this).parent().parent().remove();
                $('form').not('.hidden').find('input[type=number]').focus();
                addSrno();
        });

        $(document).on('submit','#ServiceForm', function( event ) {
            if(!($(\"input.issue_id\").length > 0))
            {
                alert('Please scan or enter atleast one barcode.');
                event.preventDefault();
            }
        });
        
        //if book submit by accession no.
        $(document).on('submit','#accession', function( event ) { 
            event.preventDefault();

            if($('#accession-no').hasClass('processing') || $('#accession-no').val() == '')
                    return;
                    
            $('#accession-no').addClass('processing');

            var check = true;
            $('.book_no').each(function(){
                if($(this).html() == $('#accession-no').val())
                    check = false;
            });

            if(check)
            {
                url = $(this).attr('action');
                $.post(url, $(this).serialize(), function(result) {

                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success == 1)
                        $('#tbody').append(obj.response);
                    else
                        alert(obj.response);
                    addSrno();
                    $('.datepicker').datepicker();
                    $.fn.datepicker.defaults.autoclose = true;
                    $('#accession-no').val('');
                    $('form').not('.hidden').find('input[type=number]').focus();
                    $('#accession-no').removeClass('processing');
                });
            }
            else
            {
                alert('Book is already in list');
                $('#accession-no').removeClass('processing');
                $('form').not('.hidden').find('input[type=number]').val('');
            }
        });

        
        //if book submit by student or employee.
        $(document).on('submit','#user', function( event ) { 
            event.preventDefault();

            if($('#accession-no').hasClass('processing'))
                    return;
                    
            $('#accession-no').addClass('processing');

            var check = true;

            if(check)
            {
                url = $(this).attr('action');
                $.post(url, $(this).serialize(), function(result) {

                    var obj = JSON.parse(JSON.stringify(result));
                    
                    if(obj.success == 1)
                        $('#tbody').append(obj.response);
                    else
                        alert(obj.response);
                    addSrno();

                    $('form').not('.hidden').find('input[type=number]').focus();
                    $('form').not('.hidden').find('input[type=number]').val('');
                    $('#accession-no').removeClass('processing');
                    $('.datepicker').datepicker();
                });
            }
            else
            {
                alert('Book is already in list');
                $('#accession-no').removeClass('processing');
                $('form').not('.hidden').find('input[type=number]').val('');
            }
        });
    });
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>
