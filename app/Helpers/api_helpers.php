<?php
//
//namespace App\Helpers;
//
//function wowzers() { return "hi"; }
//
//function addAPIError($code, Array &$errors) {
//    if (!(is_string($code) && strlen($code) > 0) && !is_numeric($code)) {
//        $code = "---";
//    }
//
//    $status = 500;
//
//    switch($code) {
//        case 100:
//            $title = "Invalid Collection";
//            $message = "The expected collection of results is invalid, or does not exist.";
//            break;
//        case 101:
//            $title = "Empty Collection";
//            $message = "The requested collection of results was empty.";
//            break;
//        case 403:
//            $status = 403;
//            $title = "Not Authorized";
//            $message = "The request is not authorized for the current user.";
//        default:
//            $title = "Unknown Error";
//            $message = "An unknown error was encountered.";
//    }
//
//    $errors[] = (object)[
//        "status" => $status,
//        "code" => $code,
//        "title" => $title,
//        "detail" => $message
//    ];
//}
