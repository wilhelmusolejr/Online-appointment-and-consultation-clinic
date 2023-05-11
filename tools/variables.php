<?php
    date_default_timezone_set('Asia/Manila');

    // navigator variable
    $page_title = "";
    $home = "";
    $consultation = "";
    $rnds = "";
    $tools = "";
    $faq = "";
    $about = "";
    $contact = "";
    $monitoring = "";

    $page_name = "WMSU Dietitian Consult";

    // 
    $isWithValue = false;

    // iputs 
    $multipleInputSample = $isWithValue ? "Test1, test2" : "";
    $isSelected = $isWithValue ? true : false;
    $isRadio = $isWithValue ? true : false;
    $sampleText = $isWithValue ? "Test" : "";
    $randomDate = $isWithValue ? "2023-10-10" : "";
    $randomTime = $isWithValue ? "10:10:00" : "";

    $inputWeight = $isWithValue ? 90 : "";
    $inputHeight = $isWithValue ? 150 : "";
    
    $multipleInputMessage = "Put comma in between for multiple inputs. Eg. \"Example1, Example2\".";
    $tootTipWeight = "Weight in kilogram";
    $tootTipHeight = "Height in centimeter";

?>