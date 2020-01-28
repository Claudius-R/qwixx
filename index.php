
<html>
    <head>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
<style>
    div {
        padding: 10px;
    }

    .red {
        background-color: red;
    }

    .red button {
        background-color: white;
        color: red;
    }

    .yellow {
        background-color: yellow;
    }

    .yellow button {
        background-color: white;
        color: orange;
    }

    .green {
        background-color: green;
    }

    .green button {
        background-color: white;
        color: green;
    }

    .blue {
        background-color: blue;
    }

    .blue button {
        background-color: white;
        color: blue;
    }
</style>
<script>
    var checked = [
        [0],
        [1],
        [2],
        [3]
    ];

    var counter = [
        1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 66, 78
    ];

    var misses = 0;

    function check(row, column) {
        $("#"+row+"-"+column).attr("disabled", true);
        $("#"+row+"-"+column).css("background-color", "black");

        checked[row][column] = true;

        var count = 0;
        for(var key in checked[row]) if(checked[row].hasOwnProperty(key)) count++;

        $("#result-"+row).val(counter[count-2]);
        calculate();
    }

    function calculate() {
        var misses = 0;
        var count = 0;
        $('#result :checked').each(function() {
            misses = misses + 5;
        });

        $("#result-misses").val(misses);

        $(".results").each(function(index, elem) {
            count = count + parseInt($(elem).val());
        });

        $("#endresult").val(count - misses);
    }    

    function closeRow(row) {
        check(row, 13);

        $("#close-"+row).attr("disabled", true);
        $("#close-"+row).css("background-color", "black");
    }

    $(document).ready(function() {        
        $(".miss").change(function() {
            calculate();
        }); 
    });
</script>

</html>
<body>
<?php
    for($i = 0; $i <= 1; $i++) {
        print "<div ";
        if ($i == 0) {
            print "class=\"red\"";
        }
        if ($i == 1) {
            print "class=\"yellow\"";
        }
        print ">";
        for($j = 2; $j <= 12; $j++) {
            print "<button id=\"".$i."-".$j."\" onclick=\"check('".$i."', '".$j."');\">".($j)."</button>";
        }
        print "<button id=\"close-".$i."\" onclick=\"closeRow('".$i."');\"><i class=\"fal fa-lock\"></i></button></div><br />";
    }
    for($i = 0; $i <= 1; $i++) {
        print "<div ";
        if ($i == 0) {
            print "class=\"green\"";
        }
        if ($i == 1) {
            print "class=\"blue\"";
        }
        print ">";
        for($j = 12; $j >= 2; $j--) {
            print "<button id=\"".($i+2)."-".$j."\" onclick=\"check('".($i+2)."', '".$j."');\">".($j)."</button>";
        }
        print "<button id=\"close-".($i+2)."\" onclick=\"closeRow('".($i+2)."');\"><i class=\"fal fa-lock\"></i></button></div><br />";
    }
    print "Fehlwürfe: <div id=\"result\">";
    for ($i = 0; $i <= 3; $i++) {
        print "<input type=\"checkbox\" class=\"miss\"/>";
    }
    print "</div><br />";
    print "Ergebnis: ";
    for($i = 0; $i <= 3; $i++) {
        print "<input type=\"text\" readonly id=\"result-".$i."\" class=\"results\" value=\"0\"/>";
        if($i <= 2) {
            print "+";
        }
    }
    print "- <input type=\"text\" readonly id=\"result-misses\" value=\"0\"/>";
    print "= <input type=\"text\" readonly id=\"endresult\" />";
?>
</body>
</html>