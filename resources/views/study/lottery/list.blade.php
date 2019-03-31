<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    div{
        width: 500px;
        height: 500px;
        margin: 0 auto;
        background-color: #bf5329;
        text-align: center;
    }
    a{
        width: 150px;
        height: 50px;
        display: inline-block;
        font-size: 20px;
        margin: auto;
    }
    p{
        font-size: 25px;
        color: #bce8f1;
    }
</style>
<body>
<div>
<h1>中奖名单</h1>
    <p>姓名：{{$res->real_name}}</p>
    <p>电话号码：{{$res->phone}}</p>
    <p>奖品：{{$res->lottery_name}}</p>
    <a href="/study/lottery/index">返回抽奖页面</a>
</div>
</body>
</html>