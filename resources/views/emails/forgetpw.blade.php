<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{ $data['subject'] }}</h2>
        <div>{{ $data['msg'] }}</div>
        <br><br>
        <div><b>您的帳號:</b> {{ $data['name'] }}</div>
        <div><b>重置密碼:</b> {{ $data['password'] }}</div>
        <div><b>登入網址:</b> {{ $data['url'] }}</div>
    </body>
</html>