<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                    <h3><?= h($visitor->name) ?></h3>
                </div>
                    <table class="vertical-table">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($visitor->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Mobile No') ?></th>
                            <td><?= h($visitor->mobile_no) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Vehicle No') ?></th>
                            <td><?= h($visitor->vehicle_no) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('City') ?></th>
                            <td><?= $visitor->has('city') ? $this->Html->link($visitor->city->name, ['controller' => 'Cities', 'action' => 'view', $visitor->city->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Person To Meet') ?></th>
                            <td><?= h($visitor->person_to_meet) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= h($visitor->remarks) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id Card') ?></th>
                            <td><?= h($visitor->id_card) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id Card No') ?></th>
                            <td><?= h($visitor->id_card_no) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Photo') ?></th>
                            <td><?= h($visitor->photo) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Visitor Type') ?></th>
                            <td><?= h($visitor->visitor_type) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Deleted') ?></th>
                            <td><?= h($visitor->is_deleted) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($visitor->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created By') ?></th>
                            <td><?= $this->Number->format($visitor->created_by) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Edited By') ?></th>
                            <td><?= $this->Number->format($visitor->edited_by) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('In Date') ?></th>
                            <td><?= h($visitor->in_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('In Time') ?></th>
                            <td><?= h($visitor->in_time) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Out Date') ?></th>
                            <td><?= h($visitor->out_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Out Time') ?></th>
                            <td><?= h($visitor->out_time) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created On') ?></th>
                            <td><?= h($visitor->created_on) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Edited On') ?></th>
                            <td><?= h($visitor->edited_on) ?></td>
                        </tr>
                    </table>
                    <div class="row">
                        <h4><?= __('Address') ?></h4>
                        <?= $this->Text->autoParagraph(h($visitor->address)); ?>
                    </div>
                    <div class="row">
                        <h4><?= __('Reason') ?></h4>
                        <?= $this->Text->autoParagraph(h($visitor->reason)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
