<?php

require "conection.php";

if (isset($_GET["c"])) {

    $district_id = $_GET["c"];
    $district_rs = Database::search("SELECT * FROM `city` WHERE `district_id`='" . $district_id . "'");

    $district_num = $district_rs->num_rows;

    for ($x = 0; $x < $district_num; $x++) {

        $district_data = $district_rs->fetch_assoc();

        $city = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $district_data["city_id"] . "'");
        $city_data = $city->fetch_assoc();

?>
        <option value="<?php echo $city_data["city_id"]; ?>"><?php echo $city_data["city_name"]; ?></option>
<?php

    }
}

?>