<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .container { padding-top: 200px; }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">

        <div class="col-md-4"> </div>

        <div class="col-md-4">
          <div class="alert alert-danger hide" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            用户名或密码错误，请重试！</div>

          <form method="post" action="admin/account/login">
            <div class="form-group">
              <label for="inputUserName">用户名</label>
              <input type="text" class="form-control" name="userName" id="inputUsername" placeholder="userName">
            </div>
            <div class="form-group">
              <label for="inputPassword">密码</label>
              <input type="password" class="form-control" name="password" id="inputPassword" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">登陆</button>
          </form>
        </div>

      </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/js/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(function() {
        var _login = '<?php echo isset($_GET['login']) ? $_GET['login'] : 0; ?>';
        if (_login == 'error') {
          $('.alert-danger').removeClass('hide');
        }
      })
    </script>
  </body>
</html>
