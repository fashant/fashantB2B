<?php

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

include_once "../libraries/PHPExcel/Classes/PHPExcel.php";
include_once "../classes/addNewBrand.php";

if(isset($_FILES['excel']) && file_exists($_FILES['excel']['tmp_name'])) {
    $upload_dir = "../excel/";
    $upload_file = $upload_dir . "working_brand_file.xlsx";
    $ext = '.' . pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION);

    /*  Excel Template
        0. name
        1. about
        2. categories
        3. primary_tagging
        4. secondary_tagging
        5. city
        6. shopping_center
        7. store_location
        8. address
        9. phone
        10. email
        11. logo
        12. gallery
        13. price_category
        14. policies
        15. open_mon
        16. closed_mon
        17. open_tues
        18. closed_tues
        19. open_wed
        20. closed_wed
        21. open_thurs
        22. closed_thurs
        23. open_fri
        24. closed_fri
        25. open_sat
        26. closed_sat
        27. open_sun
        28. closed_sun
        29. id
    */

    if(strcmp($ext, '.xlsx') === 0){ // File extension is right

        if (move_uploaded_file($_FILES['excel']['tmp_name'], $upload_file)) { // File is successfully saved
            // READ EXCEL
            $excelReader = PHPExcel_IOFactory::createReaderForFile($upload_file);
            $excelObj = $excelReader->load($upload_file);
            $worksheet = $excelObj->getActiveSheet();
            $lastRow = $worksheet->getHighestRow();

            echo "success ";
            echo "<br><br><br>";

            // MAIN LOOP
            for($row = 2; $row <= $lastRow; $row++) {
                $brand = getExcelBrand($worksheet, $row);

                if($_SESSION['id'] == $brand->getUkey()) {
                    // Update brand
                    updateBrand($brand);

                    $brand_id = $brand->getId();

                    // Delete and Upload logo
                    if ($brand->logo !== NULL || $brand->logo !== '') {
                        uploadLogo($brand->logo, $brand_id);
                    }

                    // Delete and Upload gallery
                    if (!empty($brand->gallery)) {
                        uploadGallery($brand->gallery, $brand_id);
                    }

                }
            }

        } else {
            echo "failed (2)Something went wrong with the upload...";
        }
    } else {
        echo "failed Wrong format, file should be .xlsx";
    }
} else {
    echo "failed (1)Something went wrong with the upload...";
}

function getExcelBrand($worksheet, $row){
    $brand = new addNewBrand();
    $brand->setId($worksheet->getCellByColumnAndRow(29, $row)->getValue());

    $old_brand = getBrand($brand->getId());

    $brand->setUkey($_SESSION['id']);
    $brand->setName($worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $brand->setAbout($worksheet->getCellByColumnAndRow(1, $row)->getValue());

    $category = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
    if($category === NULL || $category === '') {
        $brand->setCategories(array());
    } else {
        $brand->setCategories(explode(',', $category));
    }

    //$brand->setPrimaryCategory($worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $pc = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    if($pc === NULL || $pc === ''){
        $brand->setPrimaryCategory(array());
    } else {
        $brand->setPrimaryCategory(explode(',', $pc));
    }

    //ec$brand->setTaggings($worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $taggings = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    if($taggings === NULL || $taggings === '') {
        $brand->setTaggings(array());
    } else {
        $brand->setTaggings(explode(',', $taggings));
    }

    $brand->setCity($worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $brand->setShoppingCenter($worksheet->getCellByColumnAndRow(6, $row)->getValue());
    $brand->setStoreLocation($worksheet->getCellByColumnAndRow(7, $row)->getValue());
    $brand->setAddress($worksheet->getCellByColumnAndRow(8, $row)->getValue());
    $brand->setContactPhone($worksheet->getCellByColumnAndRow(9, $row)->getValue());
    $brand->setContactEmail($worksheet->getCellByColumnAndRow(10, $row)->getValue());
    $brand->setLogo($worksheet->getCellByColumnAndRow(11, $row)->getValue());


    $gallery = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
    if($gallery === NULL || $gallery === '') {
        $brand->setGallery(array());
    } else {
        $brand->setGallery(explode(PHP_EOL, $gallery));
    }

    $brand->setPriceCategory($worksheet->getCellByColumnAndRow(13, $row)->getValue());
    $brand->setPolicies($worksheet->getCellByColumnAndRow(14, $row)->getValue());
    $brand->setOpeningHours($old_brand->getOpeningHours());
    $brand->setOpenMon($worksheet->getCellByColumnAndRow(15, $row)->getValue());
    $brand->setCloseMon($worksheet->getCellByColumnAndRow(16, $row)->getValue());
    $brand->setOpenTues($worksheet->getCellByColumnAndRow(17, $row)->getValue());
    $brand->setCloseTues($worksheet->getCellByColumnAndRow(18, $row)->getValue());
    $brand->setOpenWed($worksheet->getCellByColumnAndRow(19, $row)->getValue());
    $brand->setCloseWed($worksheet->getCellByColumnAndRow(20, $row)->getValue());
    $brand->setOpenThurs($worksheet->getCellByColumnAndRow(21, $row)->getValue());
    $brand->setCloseThurs($worksheet->getCellByColumnAndRow(22, $row)->getValue());
    $brand->setOpenFri($worksheet->getCellByColumnAndRow(23, $row)->getValue());
    $brand->setCloseFri($worksheet->getCellByColumnAndRow(24, $row)->getValue());
    $brand->setOpenSat($worksheet->getCellByColumnAndRow(25, $row)->getValue());
    $brand->setCloseSat($worksheet->getCellByColumnAndRow(26, $row)->getValue());
    $brand->setOpenSun($worksheet->getCellByColumnAndRow(27, $row)->getValue());
    $brand->setCloseSun($worksheet->getCellByColumnAndRow(28, $row)->getValue());


    return $brand;
}

function uploadLogo($url, $brand_id){
    $data = file_get_contents($url);
    $uploaddir = '../uploads/brands/' . $_SESSION['id'] . '/' . $brand_id;
    $uploadfile = $uploaddir . '/logo.jpg';

    if (!file_exists($uploaddir)) {
        mkdir($uploaddir, 0777, true);
    }

    $files = glob($uploaddir . '/*');
    foreach($files as $file) {
        if(is_file($file)) {
            unlink($file);
        }
    }

    if(file_put_contents($uploadfile, $data)){
        $id = $brand_id;
        $mysqli = getConnection();
        $sql = "UPDATE brands SET logo = '$uploadfile' WHERE id = $id";
        if($mysqli->query($sql)) {
            echo "Logo uploaded <br>";
        }
    } else {
        echo "Logo NOT Uploaded <br>";
    }
}

function uploadGallery($gallery, $brand_id){
    if(!empty($gallery)) {
        $count = 0;
        foreach ($gallery as $url) {
            $data = file_get_contents($url);
            $uploaddir = '../uploads/brands/' . $_SESSION['id'] . '/' . $brand_id;
            $uploadfile = $uploaddir . '/' . $count . '.jpg';

            if (!file_exists($uploaddir)) {
                mkdir($uploaddir, 0777, true);
            }

            
            if(file_put_contents($uploadfile, $data)){
                $id = $brand_id;
                $mysqli = getConnection();

                $sql = "SELECT * FROM brands WHERE id = $id";
                $result = mysqli_query($mysqli, $sql);
                if($result){
                    while ($row = $result->fetch_array()){
                        $file = $row['gallery'] . ", " . $uploadfile;

                        $sql = "UPDATE brands SET gallery = '$file' WHERE id = $id";
                        if($mysqli->query($sql)) {
                            echo "Image uploaded <br>";
                        }
                    }
                }
            } else {
                echo "Image NOT Uploaded <br>";
            }

            $count++;
        }
    }
}

