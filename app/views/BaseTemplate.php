<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/js/libs/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/js/libs/bootstrap-3.3.5/css/signin.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="/js/libs/jquery-2.1.1.js"></script>
    <script src="/js/libs/jQuery-validation/jquery.validate.js"></script>
    <script src="/js/libs/bootstrap-3.3.5/js/bootstrap.min.js"></script>

    <title></title>
</head>
<body>
<body>


<div class="container">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div id="navbar" class="navbar-collapse collapse">
                <?php if(!empty($_COOKIE['isAuthUser'])){?>
                <ul class="nav navbar-nav">
                    <li>
                        <a class="fa fa-envelope-square" href="/auth/logout/">&nbsp;
                            Logout</a></li>
                </ul>
                <?php }?>

            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <div>
        <div class="bg-danger" id="error-message" style="visibility: hidden;"><h4></h4><a href="#" class="close">&times;</a>

        </div>
        <a class="btn btn-primary" href="/auth/getRegistrationForm/" role="button" style="visibility: hidden;" id="registration">
            Registration
        </a>
    </div>


    <?php include __DIR__.'/'.$partialView; ?>
</div><!--/.container-->

<hr>
<footer class="footer">
    <div class="sticky-container">
        <p class="text-muted"></p>
    </div>
</footer>
</body>

</html>