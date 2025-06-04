<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('send-mail.view')}}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text"><br>
        <label for="email">Email</label>
        <input name="email" type="email"><br>
        <label for="message">Message</label>
        <textarea name="message"></textarea><br>
        <button type="submit">send</button>
    </form>
</body>
</html>
