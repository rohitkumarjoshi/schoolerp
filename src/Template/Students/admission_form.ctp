<style type="text/css">
    .form-control{
        margin-bottom: 5px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" >
                <i class="fa fa-hand-o-right fas" style="float:none !important;"></i> <label> Admission Form </label>
            </div>
           
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Student First Name <span class="required" aria-required="true"> * </span></label>
                        <?php echo $this->Form->control('first_name',[
                        'label' => false,'class'=>'form-control ','placeholder'=>'First Name']);?>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>