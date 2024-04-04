<?php
if(isset($_GET['search'])) {
    $search = $_GET['search'];
    
    $apiKey = 'AIzaSyBPan8NB2gZOUS6MSJWD04EN65Re4mjxKM';
    $cx = '6092fb3e58dc14a8b';
    
    $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    
    if(isset($data['items'])) {
        $items = $data['items'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    h2 {
        text-align: center;
        margin-top: 20px;
    }

    form {
        text-align: center;
        margin-top: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"] {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        padding: 8px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    h3 {
        margin-top: 20px;
        text-align: center;
    }

    p {
        margin-left: 20px;
        margin-right: 20px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    a {
        color: #1a0dab;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<h2>My Browser</h2>

<form method="GET" action="">
<label for="search">Search:</label>
<input type="text" id="search" name="search" value=""><br><br>
<input type="submit" value="Submit">
</form>

<?php
if(isset($items)) {
    echo "<h3>Search result: {$search}</h3>";
    foreach($items as $item) {
        echo "<p><a href='{$item['link']}'>{$item['title']}</a><br>{$item['snippet']}</p>";
    }
}
?>
</body>
</html>




