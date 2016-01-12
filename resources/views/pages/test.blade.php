<!DOCTYPE html>
<html>
<head>
    <script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/chartphp.js"></script>
    <link rel="stylesheet" href="lib/js/chartphp.css">

    <style>
        /* white color data labels */
        .jqplot-data-label{color:white;}
    </style>
</head>

<body>
<div style="width:40%; min-width:450px;">
    {!!$out!!}
    {{ dump($q) }}

    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Stock</th>
            <th>Order Amount</th>
            <th>Date</th>
        </tr>
        </thead>


    </table>

</div>
</body>
</html>
