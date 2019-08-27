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
<div class="row">
   <div class="col-md-4">
       <!--  <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Members</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
                <ul class="users-list clearfix">
                    <?php $i=1;foreach ($events as $event) {
                        if($i < 6){?>
                            <li>
                               <?= @$this->Html->image('/event.jpg'); ?>
                              <a class="users-list-name" href="#"><?= $event->description?></a>
                              <span class="users-list-date"><?= $event->date?></span>
                            </li>
                        <?php }
                        $i++;
                    } ?>
                </ul>
            </div>
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Users</a>
            </div>
        </div> -->
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $this->Html->link('Upcomig Events',['controller'=>'AcademicCalenders','action' => 'index', '?' => ['daterange' => '','CID'=>3]],['target'=>'_blank','escape'=>false]) ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Event</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php $i=1;foreach ($events as $event) {
                            if($i < 6){?>
                        <tr>
                            <td><?= $event->description?></td>
                            <td><?= $event->date?></td>
                        </tr>
                       <?php }
                            $i++;
                        } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
        </div>
    </div>
    <div class="col-sm-4">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?= $this->Html->link('Upcoming Alok Kids Events',['controller'=>'AcademicCalenders','action' => 'index', '?' => ['daterange' => '','CID'=>5]],['target'=>'_blank','escape'=>false]) ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php $i=1;foreach ($alok_kids as $alok_kid) {
                            if($i < 6){?>
                        <tr>
                            <td><?= $alok_kid->description?></td>
                            <td><?= $alok_kid->date ?></td>
                        </tr>
                       <?php }
                            $i++;
                        } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
    <div class="col-sm-4">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">  <?= $this->Html->link('Upcoming Holidays',['controller'=>'AcademicCalenders','action' => 'index', '?' => ['daterange' => '','CID'=>2]],['target'=>'_blank','escape'=>false]) ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Holidays</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php $i=1;foreach ($holidays as $holiday) {
                            if($i < 6){?>
                        <tr>
                            <td><?php $hol_desc=$holiday->description;
                                    echo wordwrap($hol_desc,15,"<br>\n");
                                ?></td>
                            <td><?= $holiday->date?></td>
                        </tr>
                       <?php }
                            $i++;
                        } ?>
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-footer -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 class="widgetText"><?php 
                foreach ($attendances as $attend) {
                echo $this->Number->format(@$attend->present_std).'/'.$this->Number->format(@$attend->total_std); } ?></h3>
                <p>Attendance Summary</p>
            </div>
            <div class="icon">
                <i class="ion-ios-bookmarks"></i>
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'EnquiryFormStudents','action'=>'enquiryReport'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
     <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3 class="widgetText"><?php 
                foreach ($leaves as $leave) {
                echo $this->Number->format(@$leave->pending_leave); } ?></h3>
                <p>Leave Request</p>
            </div>
            <div class="icon">
                <i class="ion-android-plane"></i>
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'EnquiryFormStudents','action'=>'enquiryReport'],['class'=>'small-box-footer','escape'=>false]) ?>
        </div>
    </div>
</div>