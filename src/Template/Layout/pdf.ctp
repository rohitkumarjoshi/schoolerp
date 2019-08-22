<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= isset($head_title)?$head_title:'School ERP' ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
            <?= $this->fetch('timepickercss'); ?>
            <?= $this->fetch('taginputcss'); ?>
            <?= $this->fetch('adminStyle'); ?>
		<style>
        @media print
        {    
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
        .btnClass{
            margin-top: 23px;
        }
        .row{
            margin-bottom: 5px;
        }
        thead{
            background-color: #f1f1f1;
        }
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
    width: 510px;
    height: 400px;
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
		</style>
		<link rel="shortcut icon" href="<?php echo $this->Url->build('/img/favicon.png'); ?>"/>
       
    </head>
    <body class="skin-blue fixed" >
        
        <div>
            <aside class="">
					<section class="content" >
						<?= $this->Flash->render() ?>
						<?php echo $this->fetch('content'); ?>
					</section>
			</aside>
        </div>

        
        
    </body>
    <?= $this->Html->script([
                    '/assets/js/jquery.min.js',     
                    '/assets/js/jquery.slimscroll.min.js',
                    '/assets/js/mCustomScrollbar/jquery.mCustomScrollbar.concat.min',
                    '/assets/js/bootstrap-toastr/toastr.min.js',
                    '/assets/js/bootstrap-toastr/ui-toastr.js'
        ]); ?>

        <?= $this->fetch('page_level_js'); ?>
        <?= $this->fetch('select2js'); ?>
        <?= $this->fetch('datepickerjs'); ?>
        <?= $this->fetch('timepickerjs'); ?>
        <?= $this->fetch('fileinputjs'); ?>
        <?= $this->fetch('taginputjs'); ?>
        <?= $this->fetch('validatejs'); ?>
        <?= $this->fetch('block_js'); ?>
        <?= $this->fetch('editorJs'); ?>
   
       
        <?= $this->Html->script([
                    '/assets/js/jquery-ui-1.10.3.min.js',
                    '/assets/js/bootstrap.min.js',
                    '/assets/js/AdminLTE/app.js',
                    ]); ?>
        <?= $this->fetch('advancedFormjs'); ?>
<script type="text/javascript">
    
    var csrf = <?=json_encode($this->request->getParam('_csrfToken'))?>;
    $.ajaxSetup({
        headers: { 'X-CSRF-Token': csrf }
    });

    $(window).load(function(){
    $.mCustomScrollbar.defaults.scrollButtons.enable=true; 
    $.mCustomScrollbar.defaults.axis='yx'; 
    $('.content-scroll').mCustomScrollbar({theme:'dark-3'});
   
});
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
</script>
<?= $this->fetch('scriptPageBottom'); ?>
</html>