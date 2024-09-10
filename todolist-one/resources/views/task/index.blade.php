<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Todo List</title>
</head>
<body>
  <form action="{{ url('/create') }}" method="POST">
    @csrf
    <input type="text" name="task">
    <input type="submit" value="Add">
  </form>
</body>
</html>