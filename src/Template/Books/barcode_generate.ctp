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
                   <label> Generate Barcode </label>
                </div> 
                <div class="box-body">
                    <?= $this->Form->create('',['autocomplete'=>'off','url'=>['action'=>'barcodePrint'],'target'=>'_blank']) ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <label>Accession No. From</label>
                                <?= $this->Form->control('accession_from', ['class'=>'form-control','label'=>false,'required'=>true,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'placeholder'=>'From No.']); ?>
                            </div>
                            <div class="col-sm-2">
                                <label>Accession No. To</label>
                                <?= $this->Form->control('accession_to', ['class'=>'form-control','label'=>false,'required'=>true,'oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'placeholder'=>'To No.']); ?>
								
                            </div>
                            <div class="col-sm-2">
                                <label style="visibility: hidden;">Generate</label>
                                <?= $this->Form->submit('Generate',['class'=>'btn button','name'=>'range'])?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <hr/>
                 <div class="box-body">
                    <?= $this->Form->create('',['autocomplete'=>'off','url'=>['action'=>'barcodePrint'],'target'=>'_blank']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label ">Custom Accession</label>
                                 <?php echo $this->Form->control('accession_no',[
                            'label' => false,'class'=>'form-control ','placeholder'=>'Accession No.','data-role'=>'tagsinput','id'=>'accession_no','oninput'=>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'required'=>true]);?>
                            </div>
                            <div class="col-sm-2">
                                <label style="visibility: hidden;">Generate</label>
                                <?= $this->Form->submit('Generate',['class'=>'btn button','name'=>'custome'])?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <?= $this->element('taginput') ?> 