<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $actionInfo['title']; ?> --yaoAdmin</title>

    <!-- Bootstrap -->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/js/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style type="text/css">
		body { padding-top: 70px; }
	</style>
  </head>
  <body>
    <!--start:导航-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <p class="navbar-text">欢迎，<strong><?php echo $this->session->userdata('admin_name'); ?></strong></p>
            </div>
            
			<ul class="nav navbar-nav navbar-right">
                <a href="/admin/account/logout">
                    <button type="button" class="btn btn-danger navbar-btn"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 登出</button></a>
				&nbsp; &nbsp;
	  		</ul>
        </div>
    </nav>
    <!--end:导航-->

    <div class="container-fluid">
        <div class="row">
            <!--start:侧边栏-->
            <div class="col-md-2">
				<div class="sidebar-nav"> 
					<div class="well" > 
						<ul class="nav nav-pills">  
							<?php
								$all_act_arr = $this->adminaction->cur_act;
								foreach ($all_act_arr as $key=>$act) {
									if ('no' == $act['display']) { continue; }

									$father_bar = $son_bar = '';
									$verify_arr = array();
									if (!empty($act['subact'])) {
										$son_bar = "<ul class=\"dropdown-menu\">";
										foreach ($act['subact'] as $subact) {
											$verify_arr[] = $subact['verify'];
											if ($subact['display'] == 'yes') {
												$son_bar .= "<li><a href=\"{$subact['target']}\">{$subact['title']}</a></li>";
											}
										}
										$son_bar .= "</ul>";

										$active_class = in_array($this->adminaction->act_verify, $verify_arr) ? 'class="active"' : '';
                                        $father_bar = "<li {$active_class}>
                                            <a href=\"{$act['target']}\" data-toggle=\"dropdown\">" .
                                            
                                            "<span class=\"glyphicon glyphicon-{$act['icon']}\" aria-hidden=\"true\">&nbsp;</span>" .
											"{$act['title']}<span class=\"caret\"></span></a>";
									}
									echo $father_bar . $son_bar;
								}
							?>
						</ul> 
					</div> 
				</div> 
            </div>
            <!--end:侧边栏-->
            <div class="col-md-10">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $actionInfo['title']; ?></h3>
				  	</div>
				  	<div class="panel-body">
                		<?php echo $content; ?>
				  	</div>
				</div>
            </div>
        </div>
    </div>
  </body>
</html>
