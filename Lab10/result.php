<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>result</title>

    <style></style>

</head>
<body>
    <p>
        <?php
        $year = $_POST["year"];
        $month = $_POST["month"];
        $day = $_POST["day"];
        $height = $_POST["height"];
        $weight = $_POST["weight"];

        $bmi = $weight / pow($height / 100, 2);
        $birth = "$year/$month/$day";
        $weekday = date('l', strtotime($birth));


        function getconstellation($month, $day) 
        {
            $constellations = [
                ['水瓶座', 1, 20], ['雙魚座', 2, 19], ['牡羊座', 3, 21], ['金牛座', 4, 20],
                ['雙子座', 5, 21], ['巨蟹座', 6, 21], ['獅子座', 7, 23], ['處女座', 8, 23],
                ['天秤座', 9, 23], ['天蠍座', 10, 23], ['射手座', 11, 22], ['魔羯座', 12, 22]
            ];
            foreach ($constellations as $i => [$name, $m, $d]) 
            {
                if ($month == $m && $day >= $d || ($month == ($i + 2) % 12 && $day < $constellations[($i + 1) % 12][2])) 
                {
                    return $name;
                }
            }
            return "魔羯座";
        }

        function isLeapYear($year) 
        {
            return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
        }
        $leapText = isLeapYear($year) ? "當年為閏年" : "當年不為閏年";

        function getBMICategory($bmi)
        {
            if ($bmi < 18.5) return "過輕";
            if ($bmi < 24) return "剛剛好，繼續保持下去囉";
            if ($bmi < 27) return "過重";
            return "肥胖";
        }

        $constellation = getconstellation($month, $day);
        $weekdayText = ['Sunday' => '星期日', 'Monday' => '星期一', 'Tuesday' => '星期二', 'Wednesday' => '星期三', 'Thursday' => '星期四', 'Friday' => '星期五', 'Saturday' => '星期六'];
        $weekdayCN = $weekdayText[$weekday];


        echo "<h2>Result:</h2>";
        echo "<p>執行結果</p>";
        echo "<hr>";


        echo "<div style='text-align:center;'>";

        echo "<h3>星座</h3>";
        // echo "<p>$constellation</p>";
        echo "<img src='image/$constellation.png' alt='$constellation' width='100'><br>";
        echo "<h3>閏年</h3>";
        echo "<p>$leapText</p>";
        echo "<br>";
        echo "<h3>當日星期($birth)</h3>";
        echo "<p>$weekdayCN</p>";
        echo "<br>";
        echo "<h3>BMI</h3>";
        echo "<p>" . round($bmi, 4) . "</p>";
        echo "<br>";
        echo "<h3>評語</h3>";
        echo "<p>" . getBMICategory($bmi) . "</p>";
        
        echo "</div>";

        ?>

    </p>
</body>
</html>