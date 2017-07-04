<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Parsing</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style type="text/css">
table {
  font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
  font-size: 14px;
  width: 640px;
  text-align: left;
  border-collapse: collapse;
  background: #252F48;
  margin: 10px;
}
table th {
  color: #EDB749;
  border-bottom: 1px solid #37B5A5;
  padding: 12px 17px;
}
table td {
  color: #CAD4D6;
  border-bottom: 1px solid #37B5A5;
  border-right:1px solid #37B5A5;
  padding: 7px 17px;
}
table tr:last-child td {
  border-bottom: none;
}
table td:last-child {
  border-right: none;
}
table tr:hover td {
  text-decoration: underline;
}
        </style>
    </head>
    <body>
        <table>
            <tbody>
           <tr><td colspan="4">Parsing a website http://www.bills.ru/  Data from the database:</td></tr>
            <tr><td>ID</td><td>Title</td><td>Url</td><td>Date</td></tr>
                @foreach ($parse as $pars)
                    <tr>
                    <td>{{ $loop->index + 1 }}</td>
                        @foreach ($pars as $tag)
                            <td>
                                {{ $tag }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
