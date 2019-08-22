<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                 <label> Daily Thoughts </label> 
            </div> 
            <div class="box-body"> 
                <!--<?php $page_no=$this->Paginator->current('DailyThoughts'); $page_no=($page_no-1)*10; ?>-->
                 <table id="example1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('Sr.No') ?></th> 
                            <th scope="col"><?= __('Thought ') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($dailyThoughts as $dailyThought): ?>
                        <tr>
                            <td width="15%"><?php echo ++$page_no;?></td> 
                            <td><?= h(@$dailyThought->description) ?></td> 
                             
                        </tr>
                    <?php $i++; endforeach; ?>
                    </tbody>
            </table> 
            </div>
        </div>
    </div>
</div>