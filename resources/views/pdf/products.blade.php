<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Amiri', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 14px;
        }

        table {
            direction: ltr;
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-family: sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2> List of Filtered Products  </h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Stock Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} SAR</td>
                    <td>{{ $product->category->name ?? 'Undefined' }}</td>
                    <td>{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
 