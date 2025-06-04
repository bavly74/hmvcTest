<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('send-mail.text')}}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input name="email" type="email"><br>
        <label for="message">Message</label>
        <textarea name="message"></textarea><br>
        <button type="submit">send</button>
    </form>
</body>
</html>
