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
                            <td><?php $eve=$event->description;
                             echo mb_strimwidth($eve, 0, 30, "...");

                            ?></td>
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
                            <td><?php $alok=$alok_kid->description;
                                    echo mb_strimwidth($alok, 0, 30, "...");

                            ?></td>
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
                            <td><?php $holi=$holiday->description;
                            echo mb_strimwidth($holi, 0, 30, "...");
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
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Attendances','action'=>'summaryAttendance'],['class'=>'small-box-footer','escape'=>false,'target'=>'_blank']) ?>
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
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Leaves','action'=>'leaveApproval'],['class'=>'small-box-footer','escape'=>false,'target'=>'_blank']) ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 class="widgetText"><?php 
                foreach ($feedbacks as $feedback) {
                echo $this->Number->format(@$feedback->total); } ?></h3>
                <p>Feedbacks</p>
            </div>
            <div class="icon">
                <i class="icon ion-ios-people"></i>
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Feedbacks','action'=>'index'],['class'=>'small-box-footer','escape'=>false,'target'=>'_blank']) ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3 class="widgetText"><?php 
                foreach ($notices as $notice) {
                echo $this->Number->format(@$notice->total); } ?></h3>
                <p>Notice</p>
            </div>
            <div class="icon">
                <i class="icon ion-ios-book"></i>     
            </div>
            <?= $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>',['controller'=>'Notices','action'=>'index'],['class'=>'small-box-footer','escape'=>false,'target'=>'_blank']) ?>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-sm-12">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">  <?= $this->Html->link('Recent Feedbacks',['controller'=>'Feedbacks','action' => 'index'],['target'=>'_blank','escape'=>false]) ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                      <tr>
                        <th>Feedback</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php $i=1;foreach ($feedbacks as $feedback) {
                            if($i < 6){?>
                        <tr>
                            <td><?php $feed=$feedback->description;
                                    echo mb_strimwidth($feed, 0, 160, "...");

                            ?></td>
                            <td><?= date('Y-m-d',strtotime($feedback->created_on))?></td>
                        </tr>
                       <?php }
                            $i++;
                        } ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div> -->