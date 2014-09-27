<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo Yii::t('main',Yii::app()->name) ?></title>
    
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
    <![endif]-->
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form.css') ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/blog.css') ?>
    <?php Yii::app()->clientScript->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') ?>
    <?php Yii::app()->clientScript->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css') ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <?php echo CHtml::link(Yii::t('main',Yii::app()->name),Yii::app()->getBaseUrl(true)) ?>
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-sm-12">  
        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
        <?php endif?>  
        </div>      
            
        <?php echo $content; ?>    

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
    </div>

    <?php Yii::app()->clientScript->registerScript('ie10-viewport-bug-workaround',"
        (function () {
            'use strict';
            if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
              var msViewportStyle = document.createElement('style')
              msViewportStyle.appendChild(
                document.createTextNode(
                  '@-ms-viewport{width:auto!important}'
                )
              )
              document.querySelector('head').appendChild(msViewportStyle)
            }
        })();
    ") ?>
    <?php Yii::app()->clientScript->registerScriptFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') ?>
  </body>
</html>

