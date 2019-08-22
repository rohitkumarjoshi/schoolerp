<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                    <label>Add Vehicle Route</label>
            </div>
            <?= $this->Form->create($vehicleRoutes, ['id'=>'ServiceForm']) ?>
            <div class="portlet-body">
                <div class="row" style="margin-top:10px;padding: 0px 33px 0px 33px;">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <?= $this->Form->control('vehicle_id', ['options' => $vehicles,'label' => false, 'class'=>'select2','style'=>'width:100%','empty'=>'Select Vehicle','dataplaceholder'=>'Select Vehicle','required','value'=>$vehicle_id,'disabled'=>true])?>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-12" style="margin-top:10px;padding: 0px 33px 0px 33px;" id="main">
                        <table class="table " id="main_table">  
                            <thead class="bg_color" style="background-color: #21898e;color: #f1f2f3;">
                                <tr align="center">
                                    <th rowspan="2" style="text-align:center;">Sr</th>
                                    <th rowspan="2" style="text-align:center;">Station</th>
                                    <th rowspan="2" style="text-align:center;">Pick-Up Time</th>
                                    <th rowspan="2" style="text-align:center;">Drop Time</th>
                                    <th rowspan="2" style="text-align:center;">Station Order</th>
                                    <th rowspan="2" style="text-align:center;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="main_tbody">
                                <?php
                                $i=0;
                                foreach ($vehicleRoutes->vehicle_routes as $vehicleRoutess) {
                                    $i++;
                                    ?>
                                <tr class="main_tr">
                                    <td style="vertical-align: top !important;text-align:center;"></td>
                                    <td>
                                    
                                        <?php echo $this->Form->control('vehicle_station_id[]',['options' => $vehicleStations,
                                    'label' => false,'class'=>'select2','empty'=>'Select Station','style'=>'width:300px;','required','value'=>$vehicleRoutess->vehicle_station->id]);?></td>
                                    </td>
                                    <td class="item_subcategory_id">
                                        <div class="bootstrap-timepicker">
                                            <div class="input-group">
                                                <?php echo $this->Form->control('pickup_time[]',[
                                                'label' => false,'class'=>'form-control timepicker','type'=>'text','required','value'=>$vehicleRoutess->pickup_time]);?>
                                            </div>
                                        </div>  
                                    </td>
                                    <td>
                                        <div class="bootstrap-timepicker">
                                            <div class="input-group">
                                                <?php echo $this->Form->control('drop_time[]',[
                                                'label' => false,'class'=>'form-control timepicker','type'=>'text','required','value'=>$vehicleRoutess->drop_time]);?>
                                            </div>
                                        </div>
                                    </td>       
                                    <td>
                                        <?php echo $this->Form->control('station_order_by[]',[
                                    'label' => false,'class'=>'form-control ','placeholder'=>'Enter Order By','type'=>'text','required','value'=>$vehicleRoutess->station_order_by]);?>
                                    </td>
                                    <td>
                                        <?php
                                        if($i!=1)
                                        {
                                            echo $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger remove_row','type'=>'button']);
                                        }?>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).'Add Row',['class'=>'btn  btn-md btn-info add_row','type'=>'button']); ?></td>
                                    <td  colspan="2" style ="text-align:right; font-weight:bold;"></td> 
                                    <td>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <center>
                        <div class="col-md-12">
                            <div class="col-md-offset-3 col-md-6">  
                                <?php echo $this->Form->button('Submit',['class'=>'btn button submit','id'=>'submit_member']); ?>
                            </div>
                        </div>
                    </center>       
                </div>
            </div>
            <?= $this->Form->end(['data-type' => 'hidden']);?>
        </div>
    </div>
</div>
<?= $this->element('datepicker') ?>
<?php
    $js="
    $(document).ready(function() {
        
        $('#ServiceForm').validate({ 
            rules: {
                vehicle_id: {
                    required: true
                }
            },
            submitHandler: function () {
                $('#loading').show();
                $('#submit_member').attr('disabled','disabled');
                form.submit();
            }
        });
    
        $(document).on('click', '.add_row', function(e){
            add_row();
        });
        rename_rows();
        function add_row(){
            var tr = $('#sample tbody tr.main_tr').clone();
            $('#main_table tbody#main_tbody').append(tr);
            
            rename_rows();
            
        }
        $(document).on('click', '.remove_row', function(e)
        { 
            $(this).closest('tr').remove();
            rename_rows();
        });
        
        
        function rename_rows()
        {
            var i=0;
            $('#main_table tbody#main_tbody tr.main_tr').each(function(){

                $(this).find('td:nth-child(1)').html(i+1);
                $(this).find('td:nth-child(2) select').attr({name:'vehicle_routes['+i+'][vehicle_station_id]', id:'vehicle_routes-'+i+'-vehicle_station_id'
                    });
                $(this).find('td:nth-child(3) input').attr({name:'vehicle_routes['+i+'][pickup_time]', id:'vehicle_routes-'+i+'-pickup_time'
                        });
                 $(this).find('td:nth-child(4) input').attr({name:'vehicle_routes['+i+'][drop_time]', id:'vehicle_routes-'+i+'-drop_time'
                        });
                $(this).find('td:nth-child(5) input').attr({name:'vehicle_routes['+i+'][station_order_by]', id:'vehicle_routes-'+i+'-station_order_by'
                        });
                        $(this).find('select.selectadd').select2();
                        i++;
            });
            $('.timepicker').timepicker({
                    showInputs: false
                }); 
                
            
        }

    });
    ";

echo $this->Html->scriptBlock($js, array('block' => 'block_js')); ?>
<?= $this->element('selectpicker') ?> 
<?= $this->element('timepicker') ?> 
<?= $this->element('validate') ?>

<table id="sample" style="display:none;"width="1500px">
    <tbody>
        <tr class="main_tr">
            <td style="vertical-align: top !important;text-align:center;"></td>
            <td>
                <?php echo $this->Form->control('vehicle_station_id[]',['options' => $vehicleStations,
                                    'label' => false,'class'=>'selectadd','empty'=>'Select Station','style'=>'width:300px;','required']);?></td>
            </td>
            <td class="item_subcategory_id">
                <div class="bootstrap-timepicker">
                    <div class="input-group">
                        <?php echo $this->Form->control('pickup_time[]',[
                        'label' => false,'class'=>'form-control timepicker','type'=>'text','required']);?>
                    </div>
                </div>  
            </td>
            <td>
                <div class="bootstrap-timepicker">
                    <div class="input-group">
                        <?php echo $this->Form->control('drop_time[]',[
                        'label' => false,'class'=>'form-control timepicker','type'=>'text','required']);?>
                    </div>
                </div>  
            </td>       
            <td>
                <?php echo $this->Form->control('station_order_by[]',[
                'label' => false,'class'=>'form-control ','placeholder'=>'Enter Order By','type'=>'text','required']);?>
            </td>
            <td>
                <?= $this->Form->button(__('-'),['class'=>'btn btn-md btn-danger remove_row','type'=>'button']) ?>
            </td>
        </tr>
    </tbody>
</table>