<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Parsing</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
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
.wrap h2{
    text-align: center;
    cursor:pointer;
}
#idelement1 button{
margin: 20px;
display: block;
padding: 5px 15px;
}
body{
    padding: 20px;
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
        <div class="wrap">
            <h2 data-toggle="collapse" и data-target="#idelement1">Задание Jquery</h2>
            <div id="idelement1" class="collapse in">
                <button class="">1</button>
                <button class="">2</button>
                <button class="">3</button>
            </div>
            <h3>Решение:</h3>
            <p>
            $( "button" ).click(function() {<br>
                var el = document.querySelector("button");<br>
                el.remove();<br>
                $('#idelement1').append(el);<br>
            });<br>
            </p>
        </div>
        <script type="text/javascript">
            $( "button" ).click(function() {
                var el = document.querySelector("button");
                el.remove();
                $('#idelement1').append(el);
            });
        </script>
    </body>
</html>
