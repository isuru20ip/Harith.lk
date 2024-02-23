<?php

require "conection.php";

if (isset($_GET["p"])) {

    $province_id = $_GET["p"];
    $province_rs = Database::search("SELECT * FROM `district` WHERE `province_id`='" . $province_id . "'");

    $province_num = $province_rs->num_rows;

    for ($x = 0; $x < $province_num; $x++) {

        $province_data = $province_rs->fetch_assoc();

        $district_rs = Database::search("SELECT * FROM `district` WHERE `district_id`='" . $province_data["district_id"] . "'");
        $district_data = $district_rs->fetch_assoc();

?>
        <option value="<?php echo $district_data["district_id"]; ?>"><?php echo $district_data["district_name"]; ?></option>
<?php

    }
}

?>