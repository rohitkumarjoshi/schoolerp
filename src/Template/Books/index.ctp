<?php
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>

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
                   <label> View List </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create($book,['autocomplete'=>'off']) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Book Name</label>
                                <?= $this->Form->control('name', ['options' => '', 'empty' =>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'valueField'=>'name','keyField'=>'name'])?>
								 <div class="row col-sm-12">
                                    <div class="list-group autofill_list">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Author</label>
                                <?= $this->Form->control('author_name', ['options' => '', 'empty' =>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'valueField'=>'author_name','keyField'=>'author_name'])?>
                                <div class="row col-sm-12">
                                    <div class="list-group autofill_list">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Publisher</label>
                                <?= $this->Form->control('publisher', ['options' => '', 'empty' =>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'valueField'=>'publisher','keyField'=>'publisher'])?>
                                <div class="row col-sm-12">
                                    <div class="list-group autofill_list">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label"> Subject</label>
                                <?php echo $this->Form->control('subject_id', ['options' => $subjects, 'empty' =>'--Select--','label'=>false,'class'=>'select4','style'=>'width:100%;']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Book Category</label>
                                <?php echo $this->Form->control('book_category_id', ['options' => $bookCategories, 'empty' =>'--Select--','label'=>false,'class'=>'select4','style'=>'width:100%;']);?>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label"> Reserved</label>
                                <?php echo $this->Form->radio('is_reserved',[
                                    ['value'=>'No','text'=>'No','checked','class'=>'radio-inline'],
                                    ['value'=>'Yes','text'=>'Yes','class'=>'radio-inline'],
                                ]);?>
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
                                    <td style="padding: 5px;">
                                        <?= $this->Form->create($book,['autocomplete'=>'off','url'=>['action'=>'bookExport']]) ?>
                                            <?php if (isset($where)): ?>
                                                <?php foreach ($where as $key => $value): ?>
                                                    <?= $this->Form->hidden($key,['value'=>$value]) ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= $this->Form->submit('Export',['class'=>'btn btn-sm btn-info'])?>
                                        <?= $this->Form->end() ?>
                                    <td>    
                                        <a class="btn btn-sm btn-info" href="<?= $this->Url->build(['action'=>'add'])?>"><i class="fa fa-plus fas" style="float:none !important;"></i> Add Book</a>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <?php $page_no=$this->Paginator->current('categories'); $page_no=($page_no-1)*20; ?>
                     <table id="example1" class="table  table-striped" style="border-collapse:collapse;">
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
                        <tbody>
                            <?php $i=1; foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo ++$page_no;?></td>
                                <td><?= $book->name ?></td>
                                <td><?= h($book->author_name) ?></td>
                                <td><?= h($book->edition) ?></td>
                                <td><?= h($book->volume) ?></td>
                                <td><?= $this->Number->format($book->total_page) ?></td>
                                <td><?= h($book->book_condition) ?></td>
                                <td><?= $book->has('book_category') ? $book->book_category->name: '' ?></td>
                                <td><?= $this->Number->format($book->price) ?></td>
                                <td>
                                    <?php
                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book->id, $generator::TYPE_CODE_39,1.2,'20')) . '" style="width:100px;height:25px">';
                                    echo '<br/><center>'.$book->id.'</center>'

                                    ?>
                                </td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> '), ['action' => 'edit', $EncryptingDecrypting->encryptData($book->id)],['class'=>'btn btn-info btn-lg editbtn','escape'=>false]) ?>

                                    <a class=" btn btn-danger btn-lg deletebtn" data-target="#deletemodal<?php echo $book->id; ?>" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                    <div id="deletemodal<?php echo $book->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-md" >
                                        <?= $this->Form->create('',['id'=>'ServiceForm','url'=>['controller'=>'Books','action'=>'delete',$book->id]]) ?>
                                                <div class="modal-content">
                                                  <div class="modal-header" style=" background-color: #5ea3af;color:#fff;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" >
                                                            Stay Attention
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    <h4 class="modal-title">
                                                        Are you sure you want to remove this book ?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn  btn-sm btn-info">Yes</button>
                                                        <button type="button" class="btn  btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </td>
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

<?= $this->element('autofill',['table'=>'Books','selector'=>'.autofill']) ?>
<?= $this->element('icheck') ?>