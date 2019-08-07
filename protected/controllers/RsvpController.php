<?php namespace srad\controllers;
/**
 * Created by PhpStorm.
 * User: brad
 * Date: 7/8/18
 * Time: 5:33 PM
 */
use srad\components\ControllerComponent;
use DateTime;

class RsvpController extends ControllerComponent {


    public function actionIndex()
    {

        $pageTitle = "RSVP";
        $json = json_encode([[
            "pageTitle" => $pageTitle,
            "pageContent" => $this->renderView("rsvp/index")
        ]]);
        echo $json;
    }
    public function actionForm()
    {
        if(// $_SERVER['SCRIPT_FILENAME'] == '/var/www/html/elements/ajaxRequests/rsvpForm.php' &&
            ((integer)$_POST['Part']) > 0
        ) {
        } else {
            throw new Exception('Nice try!');
            return;
        }


        $formData = array(
            'FirstName' => '',
            'LastName' => '',
            'Attending' => '0',
            'PlusOne' => '0',
            'Comment' => '',
        );

        if(isset($_POST['FirstName'])) {
            $formData['FirstName'] = strtoupper($_POST['FirstName']);
        }
        if(isset($_POST['LastName'])) {
            $formData['LastName'] = strtoupper($_POST['LastName']);
        }
        if(isset($_POST['Attending'])) {
            if($_POST['Attending'] == 'true') {
                $formData['Attending'] = 'YES';
            } else {
                $formData['Attending'] = 'NO';
            }
        }
        if(isset($_POST['PlusOne'])) {
            if($_POST['PlusOne'] == 'true') {
                $formData['PlusOne'] = 'YES';
            } else {
                $formData['PlusOne'] = 'NO';
            }
        }
        if(isset($_POST['Comment'])) {
            $formData['Comment'] = $_POST['Comment'];
        }


        foreach($formData as $data) {
            $item = strtoupper($data);
            if(strpos($item, ';') !== false) {
                throw new Exception('Nice try!');
            }
            if(strpos($item, '--') !== false) {
                throw new Exception('Nice try!');
            }
            if(strpos($item, 'DROP') !== false) {
                throw new Exception('Nice try!');
            }
            if(strpos($item, 'TRUNCATE') !== false) {
                throw new Exception('Nice try!');
            }
            if(strpos($item, 'DELETE') !== false) {
                throw new Exception('Nice try!');
            }
        }


        $config = parse_ini_file('C:\\inetpub\\sradzone.ini');
        $mysqli = mysqli_connect("localhost",$config['username'],$config['password'],$config['db']);
        if(!$mysqli){
            die("Failed to connect to Database");
        }
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // truncate whitespace around first and last name.
        $nameArray = str_split($formData['FirstName']);
        $formData['FirstName'] = "";
        foreach($nameArray as $key => $char) {
            $intVal = ord($char);
            if($intVal > 64 && $intVal <91) {
                $formData['FirstName'] .= $char;
            }
            unset($nameArray[$key]);
        }

        $nameArray = str_split($formData['LastName']);
        $formData['LastName'] = "";
        foreach($nameArray as $key => $char) {
            $intVal = ord($char);
            if($intVal > 64 && $intVal <91) {
                $formData['LastName'] .= $char;
            }
            unset($nameArray[$key]);
        }


        if(isset($_POST['Part']) && $_POST['Part']== '1') {

            $sql = "SELECT * FROM `srad`.`gu1_guest`";
            $result = $mysqli->query($sql);
;            while($row = $result->fetch_assoc()) {
                if($formData['FirstName'] == $row['FirstName'] && $formData['LastName'] == $row['LastName']) {
                    header('Content-type: application/json');
                    echo json_encode(
                        array(
                            'status'=>'success',
                            'code'=>200,
                            'Attending' => ($row['Attending']=='YES'? true:false),
                            'PlusOne' => ($row['PlusOne']=='YES'?true:false),
                            'Comment' => $row['Comment']
                        )
                    );
                    return;
                }
            }
            header('Content-type: application/json');
            echo json_encode(array('status'=>'error', 'code'=>400, 'message'=>'Sorry, we could not find you  :('));
            return;


        } elseif(isset($_POST['Part']) && $_POST['Part']== '2') {
            $stmt = $mysqli->prepare(
                "
                UPDATE
                    `srad`.`gu1_guest`
                SET
                    Attending = ?,
                    PlusOne = ?,
                    Comment = ?,
                    Replied = '".(new DateTime())->format("Y-m-d H:i:s")."'
                WHERE
                    FirstName = ? AND
                    LastName = ?
            "
            );
            if ($stmt){
                $stmt->bind_param('sssss',
                    $formData['Attending'],
                    $formData['PlusOne'],
                    $formData['Comment'],
                    $formData['FirstName'],
                    $formData['LastName']
                );

                $stmt->execute();
                $stmt->close();
                header('Content-type: application/json');
                echo json_encode(
                    array(
                        'status'=>'success',
                        'code'=>200,
                    )
                );
                return;
            }
            else {
                //Error
                printf("Prep statment failed: %s\n", $mysqli->error);
            }
        }
        $mysqli->close();

    }
}
