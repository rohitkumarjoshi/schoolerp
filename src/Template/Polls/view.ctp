<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <h3 class="box-title" >  View Polls Report</h3>
                 <hr>
                    <div class="col-md-4 pull-right">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Here" class="form-control input-medium" />
                    </div>
                </div>
                <div class="box-body">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td scope="col"><label class="control-label"><?= h('Poll Type:') ?> </label></td>
                                <td><?= $polls->poll_type  ?></td>
                                <td scope="col"><label class="control-label"><?= h('Question:') ?> </label></td>
                                <td><?= $polls->question  ?></td>
                                <td scope="col"><label class="control-label"><?= h('Correct Answer Type:') ?> </label></td> 
                                <td><?= $polls->poll_rows[0]->objective  ?></td>
                            </tr>
                        </thead>     
                    </table>
                    
                <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col"><?= h('S.No.') ?></th> 
                                <th scope="col"><?= h('Answer By') ?></th>
                                <th scope="col"><?= h('Answer') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=0; foreach ($polls->poll_results as $poll): ?>
                                <tr>
                                    <td><?= ++$x ?></td>
                                    <td>
                                        <?php if(!empty($poll->student_id)){ 
                                            echo $poll->student->name;
                                        }
                                        else{
                                            echo $poll->employee->name;
                                        }
                                    ?>
                                    </td>
                                    <td><?= $poll->poll_row->objective ?></td>  
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- <?= $this->element('pagination') ?>  -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('daterangepicker') ?> 
<?= $this->element('validate') ?> 
<?php
$js='

';
$this->Html->scriptBlock($js,['block'=>'block_js']);
?>
<script>
function myFunction() {
   var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  var findout=norecord=0;
  for (i = 0; i < tr.length; i++) {
      findout=0;
      for(var j=1; j<=3; j++)
      {
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  findout++;
                  norecord++;
                tr[i].style.display = "";
              } else {
                  if(findout==0)
                  {
                      tr[i].style.display = "none";
                  }
                
              }
            }  
      }
  }
  
  if(norecord == 0)
  {
      $('.no-record').css('display','block');
  }
  else
  {
      $('.no-record').css('display','none');
  }
}
</script>