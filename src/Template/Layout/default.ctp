<?php
/*if(!in_array($menuFind->id,$userRightsIds))
{
    $unAthorizedUrl=$this->Url->build(['controller'=>'UnAuthorized','action'=>'un_authorized']);
    echo "<meta http-equiv='refresh' content='0;url=".$unAthorizedUrl."'/>";
    exit;
}*/
?>
<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <title><?= isset($head_title)?$head_title:'School ERP' ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
        <?php echo $this->Html->css('/assets/Lato2OFLWeb/Lato2OFLWeb/Lato/latofonts.css'); ?>
        <?php echo $this->Html->css('/assets/bootstrap/css/bootstrap.css'); ?> 
        
        <?php echo $this->Html->css('/assets/font-awesome/css/font-awesome.min.css'); ?> 
        <?php echo $this->Html->css('/assets/ionicons/css/ionicons.min.css'); ?> 
        <?php echo $this->Html->css('/assets/css/font-nunito-sans.css'); ?> 
        <?php //echo $this->Html->css('/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.min.css'); ?> 
        <?php echo $this->Html->css('/assets/dist/css/AdminLTE.css'); ?>
        <?php echo $this->Html->css('/assets/dist/css/skins/_all-skins.min.css'); ?>
        <?php echo $this->Html->css('/assets/js/bootstrap-toastr/toastr.min.css'); ?>
       <?= $this->fetch('select2css'); ?>
        <?= $this->fetch('datepickercss'); ?>
        <?= $this->fetch('daterangepickercss'); ?>
        <?= $this->fetch('timepickercss'); ?>
        <?= $this->fetch('icheckcss'); ?>
        <?= $this->fetch('taginputcss'); ?>
        <?= $this->fetch('adminStyle'); ?>
        <?php
        echo $this->Html->meta(
        'favicon.ico',
        '/images/shortcut_icon/favicon.ico',
        ['type' => 'icon']
    );
    ?>
    <style>
    fieldset{
        margin-bottom: 10px;
    }
    body{
    font-family: 'LatoHairline';
    font-size:14px;
    }
    .self-table > tbody > tr > td, .self-table > tr > td
    {
    border-top:none !important;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        vertical-align:middle !important;
    }
    label{
        vertical-align: text-top;
    }
    div.radio div.radio-div:not(:first-child) {
        margin-left: 5px !important;
    }
    .checkbox, .radio {
    margin-bottom: 5px !important;
    margin-top: 5px !important;
    }

     @media print {
            .box-header,.hide_print{
               display:none;
           }
       }
       .slimScrollBar{
            background: rgb(255, 100, 104) none repeat scroll 0% 0% !important;
            width: 6px !important;
       }
       
    .slimScrollDiv ul li a i {
        font-size: 16px;
    }
    .slimScrollDiv ul li a span {
        font-size: 14px;
        /*margin-left: 5px;*/
    }
    .text-center{
        text-align: center !important;
    }
    label.error,label.help-block{
        color: #c24747;
    }
    .btnClass{
        margin-top: 23px;
    }
    .row{
        margin-bottom: 5px;
    }
    /*thead{
        background-color: #f1f1f1;
    }*/
    body {
        font-size: 13px !important;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    .box .box-body .table {
        margin-bottom: 20px !important;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    fieldset {
        padding: 5px ;
        margin-right: 15px;
        margin-left: 15px;
        border: 1px solid #e6e6e6 !important;
        border-radius:5px;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    legend{
        margin-left: 15px;
        color:#144277;
        font-size: 17px;
        margin-bottom:0px;
        border:none;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    .required {
        color:#a94442 !important;
    }
    img{
        border:none !important;
    }
    .btn-danger
    {
        background-color:#FB6542 !important;
        color:#FFF;
        border-color:#FB6542 !important;
        font-family: 'Nunito Sans', sans-serif !important;
    }

    .form-group.has-error .form-control {
        border-color: #a94442 !important;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    .form-group.has-error label {
        color: #585858 !important;
        font-family: 'Nunito Sans', sans-serif !important;
    }
    .capitalize
    {
        text-transform:capitalize;
    }
    .file-input{
        display: inline-block;
    }
    .fileinput-remove{
        display: inline-flex;
    }
    .file-preview-image
    {
        width: 100% !important;
        height:160px !important;
    }
    .file-preview-frame
    {
        display: contents;
        float:none !important;
    }
    .kv-file-zoom
    {
        display:none;
    }
    .link{
        color:#3c8dbc;
    }
    .link:hover{
        color:#3c8dbc;
    }
    .widgetText{
        font-size: 30px !important;
    }
    .box{
        padding-bottom: 13px;
    }
    .content-scroll {
        width: 100%;
        height: 600px;
        overflow: scroll;
    }
    .mCSB_container_wrapper {
        margin-right: 0px !important;
        margin-bottom: 15px !important;
    }
    th
    {
        font-weight: 600 !important;
    }

    b,strong{
        font-weight: 600;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: 'Nunito Sans', sans-serif !important;
    }
    .modal-title{

            font-family: 'Nunito Sans', sans-serif;
    }
    .object{
        width: 20px;
        height: 20px;
        background-color: #F15340;
        float: left;
        margin-right: 20px;
        margin-top: 65px;
        -moz-border-radius: 50% 50% 50% 50% !important;
        -webkit-border-radius: 50% 50% 50% 50% !important;
        border-radius: 50% 50% 50% 50% !important;
    }
    #loading{
        background-color: rgba(0, 0, 0, 0.21);
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999999;
        margin-top: 0px;
        top: 0px;
        display:none;
    }
    #loading-center{
        width: 100%;
        height: 100%;
        position: relative;
    }
    #loading-center-absolute {
        position: absolute;
        left: 50%;
        top: 50%;
        height: 150px;
        width: 150px;
        margin-top: -75px;
        margin-left: -75px;
    }

    #object_one {   
        -webkit-animation: object_one 1.5s infinite;
        animation: object_one 1.5s infinite;
        }
    #object_two {
        -webkit-animation: object_two 1.5s infinite;
        animation: object_two 1.5s infinite;
        -webkit-animation-delay: 0.25s; 
        animation-delay: 0.25s;
        }
    #object_three {
        -webkit-animation: object_three 1.5s infinite;
        animation: object_three 1.5s infinite;
        -webkit-animation-delay: 0.5s;
        animation-delay: 0.5s;
        
        }
    @-webkit-keyframes object_one {
    75% { -webkit-transform: scale(0); }
    }

    @keyframes object_one {

      75% { 
        transform: scale(0);
        -webkit-transform: scale(0);
      }

    }
    @-webkit-keyframes object_two {
      75% { -webkit-transform: scale(0); }
    }

    @keyframes object_two {
      75% { 
        transform: scale(0);
        -webkit-transform:  scale(0);
      }

    }

    @-webkit-keyframes object_three {
      75% { -webkit-transform: scale(0); }
    }

    @keyframes object_three {

      75% { 
        transform: scale(0);
        -webkit-transform: scale(0);
      }
      
    }
    .deletebtn {
        border-radius: 50px !important;
        background-color: #FFE0E0 !important;
        border: none !important;
        padding: 5px 8px 5px 8px !important;
        color:coral;
    }
    .pagination > li > a{
        color: #636365 !important;
        background-color:#F6F5F5 !important;
        border-color: #F6F5F5 !important;
        border-top: 1px solid #ddd !important;
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 14px;
    }
    .button{
      background-color: #FF6468 !important;
      border-color: #FF6468 !important;
      color:#FFFFFF !important;
      text-transform: uppercase;
      padding: 8px 30px 8px 30px;
      font-size: 16px;
      font-weight: 600;
    }
    .button:hover{
        color :#ffffff !important;
        background-color: #FF6468 !important;
    }
    .pagination>li {
        display: inline;
        color: #393636 !important;
        font-weight: 600;
    }
    .pagination > li > a:hover{
        background-color:#FF6468 !important;
        border-color: #FF6468 !important;
        color:#fff !important;
    }
    .actions{
     text-align:center !important; 
    }
    .topheader{
        font-size: 17px !important;
        font-weight: 600 !important;
        padding-left: 16px !important;
        padding-bottom: 5px !important;

    }
    .viewbtn{
        border-radius: 50px;
        background-color: #e06262  !important;
        color:white !important;
        border: none;
        padding: 5px 8px 5px 8px !important;
        margin-right: 2px;
        margin-top: 2px;
    }
    .viewbtn>i{
            color: #white;
    }
    .imaage {width:80px;}
    .ImagePnl img
    {
        border-radius: 100%;
        height:30px;
        width: 37%; 
        border: 1px solid #252525 !important;
        float: left;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 34px !important;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        height: 34px !important;
    }
    </style>
    <?php echo $this->Html->css('mystyles'); ?>
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
            </div>
        </div>
    </div>
<?php /*$this->Form->templates([
                'inputContainer' => '{{content}}'
            ]); */
        ?>
<div id="wrapper">
    <header class="main-header no-print">
        <?= $this->Html->link('<span class="logo-lg">'.$this->Html->image('school_logo/headerlogo.png',['style'=>  'margin-top: 0px;height: 50px;align-content: center; background-color: #f9eded00 !important;']).'</span>','javascript:void(0)',['class'=>'logo','escape'=>false]) ?>
        <nav class="navbar navbar-static-top">
        <a href="#" class="hidden-lg hidden-md hidden-sm sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><?= $this->Html->link($auth->User('session_name'),'javascript:void(0)') ?></li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if($auth->User('user_type')=='Employee'){
                            $LoginName = $auth->User('employee.name');
                        }
                        else{
                            $LoginName = $auth->User('student.name'); 
                        } 
                        ?>
                       <i class="fa fa-user "></i>
                                <span><?= $LoginName; ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" style="padding: 10px;width: 225px;margin-top: 2px;">
                        <li class="">
                            <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'changepassword']); ?>"><i class="fa fa-cog"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li class="">
                            <a href="<?php echo $this->Url->build(["controller" => "Users",'action'=>'logout']); ?>"><i class="fa fa-power-off "></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
          </div>
        </nav>
    </header>
    <aside class="main-sidebar no-print">
        <section class="sidebar"> 
            <ul class="sidebar-menu">
                <?= $this->element('menu'); ?>
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
         <section class="content">
            <?= $this->Flash->render() ?>
            <?php echo $this->fetch('content'); ?>
         </section>
    </div>
</div>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/bootstrap/js/bootstrap.min.js'); ?>
 
<?php echo $this->Html->script('/assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>
<?php //echo $this->Html->script('/assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min'); ?>
<?php echo $this->Html->script('/assets/plugins/fastclick/fastclick.js'); ?>
<?= $this->fetch('page_level_js'); ?>
<?= $this->fetch('webcamjs'); ?>
<?= $this->fetch('select2js'); ?>
<?= $this->fetch('datepickerjs'); ?>
<?= $this->fetch('daterangepickerjs'); ?>
<?= $this->fetch('timepickerjs'); ?>
<?= $this->fetch('fileinputjs'); ?>
<?= $this->fetch('icheckjs'); ?>
<?= $this->fetch('taginputjs'); ?>
<?= $this->fetch('validatejs'); ?>
<?= $this->fetch('dataTablesjs'); ?>
<script type="text/javascript">
    /////////////  Selected Menu //////////
$('form').attr('autocomplete','off');
$('input').attr('autocomplete','off');

</script>

<?= $this->fetch('block_js'); ?>
<?= $this->fetch('editorJs'); ?>
<?php echo $this->Html->script('/assets/dist/js/app.min.js'); ?>
<?php echo $this->Html->script('/assets/dist/js/demo.js'); ?>
<?php echo $this->Html->script('/assets/js/bootstrap-toastr/toastr.min.js'); ?>
<?= $this->fetch('advancedFormjs'); ?>
<script type="text/javascript">
    /////////////  Selected Menu //////////
    $('.alert').fadeOut(5000);
    $(window).load(function(){
        var menuSelect=$("a[href='<?php echo $this->request->getAttribute('here');  ?>']");
        menuSelect.parents('li:not(.first,.prev,.next,.last,.paginator-number)').addClass('active');
    });
    ////////////////////////////////////
    //////////// Take Photo ///////////////////
    var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? '<?php echo $this->Url->build(['controller'=>'shutter.ogg']); ?>' : '<?php echo $this->Url->build(['controller'=>'shutter.mp3']); ?>';
    $(document).on('click','#take_snapshot',function(){
        // take snapshot and get image data
        try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
        shutter.play();
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML ='<img width="200px" height="150px" src="'+data_uri+'"/>';
            $('#snapshot').val(data_uri);
        });
    });
    //////////////////////////////////////
    window.onerror = function(msg, url, linenumber) {
        $('#loading').hide();
        return false;
    }
    
    var csrf = <?=json_encode($this->request->getParam('_csrfToken'))?>;
    $.ajaxSetup({
        headers: { 'X-CSRF-Token': csrf },
        error: function(){
        //toastr.error('ajex error');
    }
    });

    $( document ).ajaxError(function( event, request, settings ) {
      //$( "head" ).append( "<li>Error requesting page " + settings.url + "</li>" );
    });

    $(document).on('submit','form',function(){
        $(this).find('button[type=submit]').addClass('disabled');
        $(this).find('button[type=submit]').text('Please wait...');
    });

    /*$(window).load(function(){
        $.mCustomScrollbar.defaults.scrollButtons.enable=true; 
        $.mCustomScrollbar.defaults.axis='yx'; 
        $('.content-scroll').mCustomScrollbar({theme:'dark-3'});
       
    });*/
    function round(value, exp) { 
      if (typeof exp === 'undefined' || +exp === 0)
        return Math.round(value);

      value = +value;
      exp = +exp;

      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        return 0;

      // Shift
      value = value.toString().split('e');
      value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

      // Shift back
      value = value.toString().split('e');
      return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?= $this->fetch('scriptPageBottom'); ?>
<?= $this->Html->script('select2-tab-fix.min.js') ?>

</body>
</html>