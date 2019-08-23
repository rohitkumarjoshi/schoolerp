<?php 
foreach ($menus as $menu) {
    if(empty($menu->children))
    {
        ?>
        <li class="">
            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$menu->icon_class_name]).' '.$this->Html->tag('span', $menu->menu_name),['controller'=>$menu->controller,'action'=>$menu->action],['escape'=>false]) ?>
        </li>
        <?php
    }
    else if(!empty($menu->children))
    {
        ?>
        <li class="treeview">
            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$menu->icon_class_name]).' '.$this->Html->tag('span', $menu->menu_name).$this->Html->tag('span', $this->Html->tag('i', '', ['class'=>'fa fa-angle-left pull-right']), ['class'=>'pull-right-container']),'javascript:;',['escape'=>false]) ?>
            <ul class="treeview-menu">
        <?php
        foreach ($menu->children as $childrenMenu) {
            if(!empty($childrenMenu->children))
            {
                ?>
                <li class="treeview">
                    <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenMenu->menu_name).$this->Html->tag('span', $this->Html->tag('i', '', ['class'=>'fa fa-angle-left pull-right']), ['class'=>'pull-right-container']),'javascript:;',['escape'=>false]) ?>
                    <ul class="treeview-menu">
                    <?php
                    foreach ($childrenMenu->children as $childrenSubMenu) {
                        ?>
                        <li class="">
                            <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenSubMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenSubMenu->menu_name),['controller'=>$childrenSubMenu->controller,'action'=>$childrenSubMenu->action],['escape'=>false]) ?>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                </li>
                <?php
            }
            else
            {
                ?>
                <li class="">
                    <?= $this->Html->link($this->Html->tag('i', '', ['class'=>$childrenMenu->icon_class_name]).' '.$this->Html->tag('span', $childrenMenu->menu_name),['controller'=>$childrenMenu->controller,'action'=>$childrenMenu->action],['escape'=>false]) ?>
                </li>
                <?php
            }
                
        }
        ?>
            </ul>
        </li>
        <?php
    }
}
?>
<li class="treeview <?= (@$active_li=='Examination')?'active':'' ?>">
    <a href="#">
        <i class="fa fa-file-text"></i>
        <span>Examination</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">


        <li>
            <a href="<?= $this->Url->build(['controller'=>'SubjectTypes','action' =>'add'])?>"> Subject Types</a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Subjects</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'Subjects','action' =>'add'])?>"> Add</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'Subjects','action' =>'index'])?>"> View</a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Scaling</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'Scalings','action' =>'add'])?>"> Add</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'Scalings','action' =>'index'])?>"> View</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?= $this->Url->build(['controller'=>'FacultyClassMappings','action' =>'index'])?>"> Faculty Mapping</a>
        </li>



        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Exam Master</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'ExamMasters','action' =>'add'])?>"> Add</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'ExamMasters','action' =>'index'])?>"> View</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'SubExams','action' =>'index'])?>"> Sub Exams</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?= $this->Url->build(['controller'=>'ExamMaxMarks','action' =>'add'])?>"> Subject Max Marks</a>
        </li>

        <li>
            <a href="<?= $this->Url->build(['controller'=>'StudentElectiveSubjects','action' =>'index'])?>"> Student Elective Subjects</a>
        </li>

        <li>
            <a href="<?= $this->Url->build(['controller'=>'GradeMasters','action' =>'index'])?>"> Grade Master</a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Student Marks</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentMarks','action' =>'add'])?>"> Add</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentMarks','action' =>'index'])?>"> Subject Wise View</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentMarks','action' =>'examWiseReport'])?>"> Exam Wise View</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?= $this->Url->build(['controller'=>'HealthMasters','action' =>'index'])?>"> Health Master</a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Student Health</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentHealths','action' =>'add'])?>"> Add</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentHealths','action' =>'index'])?>"> View</a>
                </li>
            </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fas fa-bus-alt"></i>
                <span>Mark Sheet</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentMarks','action' =>'createMarkSheet'])?>"> Create</a>
                </li>
                <li> 
                    <a href="<?= $this->Url->build(['controller'=>'StudentMarks','action' =>'markSheet'])?>"> View</a>
                </li>
            </ul>
        </li>

    </ul>
</li>
<div align="center" style="margin-top:20px">   
 	<a class="btn" style="background: #FF6468;color: #fff;border-radius: 4px;width: 111px;" href="<?= $this->Url->build(['controller'=>'Users','action' =>'logout'])?>"><i class="fa fa-sign-out"></i> Logout</a>
</div>
