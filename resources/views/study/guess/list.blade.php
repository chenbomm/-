<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="width:100%">
<div style="margin:0px auto">
    <table style="width: 300px;text-align: center">
        <tr><td>竞猜列表</td></tr>
        @if(!empty($lists))
            @foreach($lists as $value)
                <tr style="width: 300px;text-align: center"><td>{{$value['team_a']}}VS{{$value['team_b']}}</td>
                    <td>
                        @if(strtotime($value['end_at'])>time())
                            <a href="/study/guess/guess?id={{$value['id']}}&user_id={{$user_id}}">竞猜</a>
                            @else
                            <a href="/study/guess/result?id={{$value['id']}}&user_id={{$user_id}}">查看结果</a></td>
                            @endif

                </tr>
            @endforeach
            @endif
    </table>
</div>
</body>
</html>