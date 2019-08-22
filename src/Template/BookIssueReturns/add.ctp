<style type="text/css">
    .control-label{
        display: block;
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
				<label> Issue Book </label>
			</div>
			<div class="box-body">
				<div class="form-group">  
					<div class="row">
						<?= $this->Form->create($book,['url'=>['action'=>'getBook.json'],'id'=>'accession','autocomplete'=>'off'])?>
							<div class="col-sm-4 col-sm-offset-4">
								<?=$this->Form->control('accession_no',['class'=>'form-control','placeholder'=>'Accession No.','label'=>false])?>
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
										<th><?= __('Sr.No') ?></th>
										<th><?= $this->Paginator->sort('name') ?></th>
										<th><?= $this->Paginator->sort('author_name') ?></th>
										<th><?= $this->Paginator->sort('edition') ?></th>
										<th><?= $this->Paginator->sort('volume') ?></th>
										<th><?= $this->Paginator->sort('total_page') ?></th>
										<th><?= $this->Paginator->sort('book_condition') ?></th>
										<th><?= $this->Paginator->sort('book_category_id') ?></th>
										<th><?= $this->Paginator->sort('price') ?></th>
										<th><?= $this->Paginator->sort('accession_no') ?></th>
										<th class="actions"><?= __('Actions') ?></th>                            
									</tr>
								</thead>
								<tbody id="tbody"></tbody>
							</table>
						</div>
						<div class="col-sm-4">
							<label class="control-label">Issue To</label>
							<div class="form-group">
								<label class="radio-inline" id="student">
									<input type="radio" id="option1" value="Student" name="issue_to" checked>Student
								</label>
								<label class="radio-inline" id="employee">
									<input type="radio" id="option2" value="Employee" name="issue_to">Employee
								</label>
							</div>
						</div>
						<div class="col-sm-4 student">
							<label class="control-label">Select Student</label>
							<?= $this->Form->control('student_id', ['options' => [], 'empty' => '--Select--','class'=>'form-control','label'=>false,'id'=>'student-id','required']);?>
						</div>
						<div class="col-sm-4 employee">
							<label class="control-label">Select Employee</label>
							<?= $this->Form->control('employee_id', ['options' => [], 'empty' => '--Select--','class'=>'form-control','label'=>false,'id'=>'employee-id']);?>
						</div>
						<div class="col-sm-4">
							<?= $this->Form->submit('Issue Books',['class'=>'btn btn-success btnClass']);?>
						</div>
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->element('student_autofill',['selector'=>'#student-id']) ?>
<?= $this->element('employee_autofill',['selector'=>'#employee-id']) ?>
<?= $this->element('icheck') ?>
<?php

$js ="
    $(document).ready(function() {
        $('#accession-no').focus();
        $('.employee').addClass('hidden');

        function addSrno()
        {
            var i = 0;
            $('.index').each(function(){
                i++;
                $(this).html(i);
            });
        }

        $('#option1').on('ifChecked', function () {
                $('.employee').addClass('hidden');
                $('.student').removeClass('hidden');
                $('#student-id').attr('required','required');
                $('#employee-id').removeAttr('required');
        });

        $('#option2').on('ifChecked', function () {
                $('.student').addClass('hidden');
                $('.employee').removeClass('hidden');
                $('#employee-id').attr('required','required');
                $('#student-id').removeAttr('required');
        });

        $(document).on('click','.remove_book', function() { 
            var conf = confirm('Do you want to delete this book?');
            if(conf)
                $(this).parent().parent().remove();
                $('#accession-no').focus();
                addSrno();
        });

        $(document).on('submit','#ServiceForm', function( event ) {
            if(!($(\"input[name='book_id[]']\").length > 0))
            {
                alert('Please scan or enter atleast one barode.');
                event.preventDefault();
            }
        });

        $(document).on('submit','#accession', function( event ) { 
            event.preventDefault();

            if($('#accession-no').hasClass('processing'))
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

                    $('#accession-no').val('');
                    $('#accession-no').focus();
                    $('#accession-no').removeClass('processing');
                });
            }
            else
            {
                alert('Book is already in list');
                $('#accession-no').removeClass('processing');
            }
        });
    });
";
$this->Html->scriptBlock($js, ['block' => 'scriptPageBottom']);
?>
