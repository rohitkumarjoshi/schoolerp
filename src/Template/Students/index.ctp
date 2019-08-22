<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3 class="widgetText"><?= $this->Number->format($total_enquiry) ?></h3>
                <p>Total Enquiry</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-contacts"></i>
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'EnquiryFormStudents','action'=>'enquiryReport'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3 class="widgetText"><?= $this->Number->format($total_admission_form) ?></h3>
                <p>Total Admission Form</p>
            </div>
            <div class="icon">
                <i class="ion ion-map"></i>
            </div>
             <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Students','action'=>'admissionFormReport'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 class="widgetText"><?= $this->Number->format($total_admission) ?></h3>
                <p>Total Admission</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Students','action'=>'admissionFormReport'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 class="widgetText">
                    <?php
                    foreach ($dailyAmounts as $dailyAmount) {
                        echo $this->Number->format($dailyAmount->daily_amount,['places'=>2]);
                    }
                    ?>
                </h3>
                <p>Today Collection</p>
            </div>
            <div class="icon">
                &#8377;
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'feeCategories','action'=>'dailyCollection'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
</div>