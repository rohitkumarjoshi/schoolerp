<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
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
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> Opac </b>
                    
                </div> 
                <div class="box-body">
                    <div class="row">
                            <?= $this->Form->create($book,['autocomplete'=>'off']) ?>
                            <div class="col-sm-4">
                                <label>Book Name</label>
                                <?= $this->Form->control('name',['options'=>[],'empty'=>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'keyField'=>'name','valueField'=>'name'])?>
                            </div>

                            <div class="col-sm-4">
                                <label>Author</label>
                                <?= $this->Form->control('author_name',['options'=>[],'empty'=>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'keyField'=>'author_name','valueField'=>'author_name'])?>
                            </div>

                            <div class="col-sm-4">
                                <label>Publisher</label>
                                <?= $this->Form->control('publisher',['options'=>[],'empty'=>'--Select--','class'=>'form-control autofill','label'=>false,'required'=>false,'keyField'=>'publisher','valueField'=>'publisher'])?>
                                <div class="row col-sm-12">
                                    <div class="list-group autofill_list">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Subject</label>
                                <?php echo $this->Form->control('subject_id', ['options' => $subjects, 'empty' =>'--Select--','label'=>false,'class'=>'form-control select4']);?>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label"> Book Category</label>
                                <?php echo $this->Form->control('book_category_id', ['options' => $bookCategories, 'empty' =>'--Select--','label'=>false,'class'=>'form-control select4']);?>
                            </div>

                            <div class="col-sm-4">
                                <?= $this->Form->submit('search',['class'=>'btn btn-success btnClass'])?>
                            </div>
                            <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="box-footer">
                    <?php if (isset($books)): ?>
                        <table id="example1" class="table table-bordered table-striped" style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th><?= __('Sr.No') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('author_name') ?></th>
                                    <th><?= $this->Paginator->sort('edition') ?></th>
                                    <th><?= $this->Paginator->sort('volume') ?></th>
                                    <th><?= $this->Paginator->sort('total_page') ?></th>
                                    <th><?= $this->Paginator->sort('book_category_id') ?></th>
                                    <th><?= $this->Paginator->sort('price') ?></th>
                                    <th><?= $this->Paginator->sort('accession_no') ?></th>
                                    <th>Available</th>             
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($books as $book): ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?= $this->Html->link($book->name, ['action' => 'view', $EncryptingDecrypting->encryptData($book->id)]) ?></td>
                                    <td><?= h($book->author_name) ?></td>
                                    <td><?= h($book->edition) ?></td>
                                    <td><?= h($book->volume) ?></td>
                                    <td><?= $this->Number->format($book->total_page) ?></td>
                                    <td><?= $book->has('book_category') ? $book->book_category->name: '' ?></td>
                                    <td><?= $this->Number->format($book->price) ?></td>
                                    <td><?= h($book->accession_no) ?></td>
                                    <td><?= !empty($book->book_issue_returns)?'Issued':'Available'?></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?= $this->element('autofill',['table'=>'Books','selector'=>'.autofill']) ?>