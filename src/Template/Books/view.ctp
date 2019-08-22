<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-gift fas" style="float:none !important;"></i> <b> View Book </b>
                </div> 
                <div class="box-body">
                    <h3><?= h($book->name) ?></h3>
                    <table class="table table-bordered table-striped" style="border-collapse:collapse;">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($book->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Author Name') ?></th>
                            <td><?= h($book->author_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Edition') ?></th>
                            <td><?= h($book->edition) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Volume') ?></th>
                            <td><?= h($book->volume) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Publisher') ?></th>
                            <td><?= h($book->publisher) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Medium') ?></th>
                            <td><?= $book->has('medium') ? $book->medium->name : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Class') ?></th>
                            <td><?= $book->has('student_class') ? $book->student_class->name : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Book Condition') ?></th>
                            <td><?= h($book->book_condition) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Book Category') ?></th>
                            <td><?= $book->has('book_category') ? $book->book_category->name : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Subject') ?></th>
                            <td><?= $book->has('subject') ? $this->Html->link($book->subject->name, ['controller' => 'Subjects', 'action' => 'view', $book->subject->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Accession No') ?></th>
                            <td><?= h($book->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Total Page') ?></th>
                            <td><?= $this->Number->format($book->total_page) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Price') ?></th>
                            <td><?= $this->Number->format($book->price) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

