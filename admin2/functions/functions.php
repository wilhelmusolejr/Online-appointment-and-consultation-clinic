<?php 
// valid arrays
$rank_list  = array('Instructor','Asst. Professor','Asso. Professor','Professor');
$department_list = array('Computer Science','Information Technology');
$addmission_list = array('Interviewer','Admission Officer');

function echo_safe($string){
    echo htmlentities($string);
}

function valid_string($string,$min,$max){
    $length = strlen($string);
    if(strlen($string) == strlen(trim($string) ) && ($length>$min && $length <$max)){
        return 'valid';
    }else {
        return 'invalid';
    } // returns 1 if valid else returns 0 as invalid
} 

function string_min_max($string,$min,$max){
    $length = strlen($string);
    if($length>$min && $length <$max){
        return 'valid';
    } else {
        return 'invalid';
    }// returns 1 as valid else returns 0 as invalid
}

// no regex today
function validate_email($email,$domain){
    $email = filter_var($email,FILTER_VALIDATE_EMAIL);
    $counter = $length = strlen($email)-1;
    $domaincounter=0;
    while($counter){
        if($email[$counter] == $domain[$domaincounter]){
            if($length - $counter+1 != strlen($domain))
            return 'invalid';
            while($length > $counter + $domaincounter){
                $domaincounter++;
                if($email[$counter+$domaincounter] != $domain[$domaincounter]){
                    return 'invalid';  //invalid domain
                }
            }
            return 'valid';   // valid domain
        }
        $counter--;
    }
}

function validate_from_array($string,$string_arr){
    foreach ($string_arr as $value){
        if($value == $string){
            return 'valid';
        }
    }
    return 'invalid';
}
//
    // function validate_all($_post){

    // // array declaration
    // $rank_list  = array('Instructor','Asst. Professor','Asso. Professor','Professor');
    // $department_list = array('Computer Science','Information Technology');
    // $addmission_list = array('Interviewer','Admission Officer');

    // if(isset($_post['fn']) && isset($_post['ln'])  && isset($_post['email'])  && isset($_post['rank']) && isset($_post['department']) && isset($_post['role'])){
    // $firstname = $_post['fn'];
    // $lastname = $_post['ln'];
    // $email = $_post['email'];
    // $rank = $_post['rank'];
    // $department = $_post['department'];
    // $role = $_post['role'];
    // if(isset($_post['status']))
    // $status = 'valid';

    // $arr = array();


    // $valid = true;
    // // firstname
    // array_push($arr,valid_string($firstname,1,255));
    // array_push($arr,valid_string($lastname,1,255));
    // array_push($arr,validate_email($email,'@wmsu.edu.ph'));
    // array_push($arr,validate_from_array($rank,$rank_list));
    // array_push($arr,validate_from_array($department,$department_list));
    // array_push($arr,validate_from_array($role,$addmission_list));


    // return $arr;
    // }
    // }
?>