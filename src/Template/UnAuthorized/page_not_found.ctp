<?php $this->set('title', 'Page not found'); ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out" style="animation-duration: 0.8s; opacity: 1;background: var(--accentColor);">
    <div class="page-content vertical-align-middle">
      <h1 style="font-size: 50px;font-weight: 700;color: white !important;">404</h1>
      <h5 style="font-size: 35px;color: white !important;">PAGE NOT FOUND</h5>
      <p style="font-size: 18px;color: white !important;">The page requested couldn't be found. This could be a spelling error in the URL or a removed page.</p>
      <div id="footer">
            <?= $this->Html->link(__('Back'),'javascript:history.back()',['class'=>'btn btn-default','style'=>'background-color:#FFF;']) ?>
        </div>
      <footer class="page-copyright">
        <p style="color: white !important;">© 2017 Entry Hires.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
	  
    </div>
  </div>

</html>