<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{config('app.name', 'Magic Office')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <style type="text/css">

        body{
            font-size: 12px;
        }

        .center {
            text-align: center;
        }
        .green{
            color: green;
        }
        .red{
            color: red;
        }
        .panel{
            margin-bottom: 5px;
        }
        .panel-body {
            padding-top: 5px;
        }
        h1, .h1, h2, .h2, h3, .h3, h4, h4 {
            margin-top: 3px;
            margin-bottom: 3px;
        }
        .no-padding {
            padding: 0;
        }
        .panel-heading {
            padding: 1px 3px;
        }
        .left {
            padding-right: 3px;
        }
        .right {
            padding-left: 3px;
        }
        .no-border-bottom {
            border-bottom: none;
        }
        .no-border {
            border: none !important;
        }
        .no-margin-bottom {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
