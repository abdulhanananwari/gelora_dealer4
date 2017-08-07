<!DOCTYPE html>
<html ng-app="Gelora.SalesAdmin">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta http-equiv="Content-Security-Policy" content="connect-src * blob: *; default-src *; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'; img-src * data: blob:;">
    <meta name="mobile-web-app-capable" content="yes">

    <title ng-bind="pageTitle"></title>

    <link rel="stylesheet" type="text/css" href="/custom/bootstrap/bootstrap-yeti.min.css">
    <link rel="stylesheet" type="text/css" href="/standard/jquery-ui-1.11.4/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/standard/font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/standard/web-fonts/fonts.css">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="/standard/custom/css/form.css">
    <link rel="stylesheet" type="text/css" href="/standard/custom/css/pastel-colors.css">

    <script type="text/javascript" src="/standard/jquery/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/standard/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/standard/angular/angular-1.6.2.min.js"></script>
    <script type="text/javascript" src="/standard/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/standard/lodash-4.13.1/lodash.min.js"></script>
    <script type="text/javascript" src="/standard/localforage/localforage.min.js"></script>
    <script type="text/javascript" src="/standard/uri-1.17.0/uri.min.js"></script>
    <script type="text/javascript" src="/standard/moment-2.11.2/moment.min.js"></script>

    <script type="text/javascript" src="/solumax/setting/app.js"></script>
    <script type="text/javascript" src="/solumax/dependencies/all.js"></script>
    <script type="text/javascript" src="/solumax/file-manager/v3.0/file-manager.js"></script>
    <script type="text/javascript" src="/solumax/logger/plugins/v1.0/logger.js"></script>
    <script type="text/javascript" src="/solumax/auth-client/plugins/all.js"></script>
    
    <script type="text/javascript" src="/gelora/base-shared/app/all.js"></script>
    <script type="text/javascript" src="/gelora/credit-sales-shared/app/all.js"></script>
    <script type="text/javascript" src="/gelora/sales-shared/app/all.js"></script>
    <script type="text/javascript" src="/gelora/pol-reg-shared/app/all.js"></script>
    <script type="text/javascript" src="/gelora/human-resource-shared/app/all.js"></script>
    
    <!-- Replace For Production -->
    <script type="text/javascript" src="{{ env('APP_ENV') == 'dev' ? ('http:' . explode(':', Request::root())[1] . ':11019/') : 'https://transaction.hondagelora.com/'}}plugins2/all.js"></script>
    <script type="text/javascript" src="{{ env('APP_ENV') == 'dev' ? ('http:' . explode(':', Request::root())[1] . ':11088/') : 'https://kendaraan.hondagelora.com/'}}shared/all.js"></script>
    <script type="text/javascript" src="{{ env('APP_ENV') == 'dev' ? ('http:' . explode(':', Request::root())[1] . ':10777/') : 'https://entity.hondagelora.com/'}}plugins/v2/all.js"></script>
    <script type="text/javascript" src="{{ env('APP_ENV') == 'dev' ? ('http:' . explode(':', Request::root())[1] . ':30001/') : 'https://plafond.hondagelora.com/'}}gelora/price-plugin/app/all.js"></script>

    <script type="text/javascript" src="app/all.js"></script>
    
  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        
        <div class="navbar-header">
          <button type="button button-primary" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <tenant-select class="navbar-brand"></tenant-select>
        </div>


        <div id="mainNavbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li module-selector></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a ui-sref='index' data-toggle="collapse" data-target="#mainNavbar">Home</a></li>
            <li sol-auth module-id="30000"></li>

          </ul>
        </div>

      </div>
    </nav>

    <style type="text/css">
    body {
    padding-top: 60px;
    }
    </style>

    <div class="container-fluid" id="ui-view-container">
        <section ui-view></section>
    </div>


  </body>
</html>