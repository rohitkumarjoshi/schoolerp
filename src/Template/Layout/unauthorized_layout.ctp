<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Unauthorized</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        echo $this->Html->css([ 
                        '/assets/css/bootstrap.min.css',
                        '/assets/css/font-awesome.min.css',
                        '/assets/css/ionicons.min.css',
                        '/assets/css/font-nunito-sans.css',
                        '/assets/css/AdminLTE.css'
            ]) ?>

        <link rel="shortcut icon" href="<?php echo $this->Url->build('/img/favicon.png'); ?>"/>
       <style type="text/css">
          body {
                background-image: url(<?php echo $this->Url->build(['controller' =>'/img/bg.jpg', '_full'=>true, '_ssl'=>false]); ?>);
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                padding-top:3px;
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-position: center center;
                position: fixed;
                top: 0;
                left: 0;
                z-index: -1;
                width: 100%;
                height: 100%;
                content: '';
            }
       </style>
    </head>
     <body>
        <section class="content" style="background: #efefef00;margin-top: 10%;" >
            <?= $this->Flash->render() ?>
            <?php echo $this->fetch('content'); ?>
        </section>
    </body>
    <?= $this->Html->script([
                    '/assets/js/jquery.min.js',     
        ]); ?>

        <?= $this->Html->script([
                    '/assets/js/jquery-ui-1.10.3.min.js',
                    '/assets/js/bootstrap.min.js',
                    '/assets/js/AdminLTE/app.js'
                    ]); ?>

</html>