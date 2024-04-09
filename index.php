<?php
include 'connection.php';

if (isset($_GET['city'])) {
    $city = $_GET["city"];

    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&appid=52fa4270c6cde90aae1224c3f5746413&units=metric";
    $data = @file_get_contents($url);

    if ($data === FALSE) {
        http_response_code(500); // Internal Server Error
        exit(json_encode(array("error" => "Error fetching city data")));
    }

    $data = json_decode($data, true);
    $city = $data['name'];
    $temp = $data["main"]["temp"];
    $weatherType = $data["weather"][0]["main"];

    $fetch_query = "SELECT * FROM weather_db WHERE city = '{$city}' AND weather_when >= DATE_SUB(NOW(),INTERVAL 1000 SECOND) ORDER BY weather_when DESC LIMIT 1";
    $result = mysqli_query($con, $fetch_query)->num_rows;

    if ($result == 0) {
        $insert_query = "INSERT INTO weather_db(city,temp, weather_type,weather_when) VALUES('{$city}', '{$temp}', '{$weatherType}', NOW())";
        $r = mysqli_query($con, $insert_query);
    }

    $query_main = "SELECT * FROM weather_db WHERE city = '{$city}' AND weather_when >= DATE_SUB(NOW(),INTERVAL 1000 SECOND) ORDER BY weather_when DESC LIMIT 1";
    $result_main = mysqli_query($con, $query_main);
    $main_data = [];
    while ($row_main = mysqli_fetch_assoc($result_main)) {
        $main_data[] = $row_main;
    }
    $response = [
        'city' => $main_data[0]['city'],
        'temp' => $main_data[0]['temp'],
        'weather_type' => $main_data[0]['weather_type'],
        'weather_when' => $main_data[0]['weather_when']
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Weather Information</title>
</head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-size: 22px;
      font-family: sans-serif;
}
    body{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url("background-pic.jpg");
        background-position: center;
        background-size: cover;
    }
    .container{
        width: 45%;
        height: 50vh;
        display: inherit;
        flex-direction: column;
        backdrop-filter: blur(10px);
        justify-content: space-evenly;
        align-items: center;
        color: #ffffff;
        border: 5px solid #ffffff;
        border-radius: 10px;
    }
     .infos{
        display: grid;
        grid-template-columns: auto auto;
        gap: 30px;
     }
     .temp{
        background-color: green;
        padding: 10px 25px;
        border-radius: 5px;
     }
     .city{
        background-color: purple;
        padding: 10px 25px;
        border-radius: 5px;
     }
     .des{
        background-color: brown;
        padding: 10px 25px;
        border-radius: 5px;
     }
     .date{
        background-color: blue;
        padding: 10px 25px;
        border-radius: 5px;
     }
     .button{
        padding: 5px 15px;
        background-color: blue;
        border-radius: 5px;
        color: #ffffff;
     }
     #search{
        padding: 5px 15px;
        color: green;
        letter-spacing: 2px;
        border-radius: 10px;
     }
  </style>
<body>

    <div class="container">
        <form>  
            <input type="text" name="city" id="search" spellcheck="false" placeholder="Enter city name">
            <button type="submit" id="submit" class="button">Search</button>
        </form>
        <div class="infos">
            <h1 class="city">City: <span id="city"></span></h1>
            <h1 class="temp">Temperature: <span id="temp"></span></h1>
            <h1 class="des">Description: <span id="des"></span></h1>
            <h1 class="date">Date: <span id="date"></span></h1>
        </div>
    </div>


    <script src="script.js" ></script>
</body>
</html>