<?php

function wowzers() { return "hi"; }

function getStatus($errors) {
    $status = 500;
    $codes = [];
    if (count($errors)) {
        $status = $errors[0]->status;

        foreach($errors as $error) {
            if (property_exists($error, "status")) {
                $codes[] = $error->status;
            }
        }

        if (count($codes) === 1) {
            $status = $codes[0];
        }
    }

    return $status;
}

function addAPIError($code, &$errors) {
    if (!(is_string($code) && strlen($code) > 0) && !is_numeric($code)) {
        $code = "---";
    }

    $status = 500;

    switch($code) {
        case 100:
            $title = "Invalid Collection";
            $message = "The expected collection of results is invalid, or does not exist.";
            break;
        case 101:
            $title = "Empty Collection";
            $message = "The requested collection of results was empty.";
            break;
        case 102:
            $title = "Not Found";
            $message = "The requested object could not be found.";
            break;
        case 103:
            $title = "Password Reset Error";
            $message = "The password reset link could not be sent.";
            break;
        case 403:
            $status = 403;
            $title = "Not Authorized";
            $message = "The request is not authorized for the current user.";
        default:
            $title = "Unknown Error";
            $message = "An unknown error was encountered.";
    }

    $errors[] = (object)[
        "status" => $status,
        "code" => $code,
        "title" => $title,
        "detail" => $message
    ];
}

function update_user(&$request, &$user) {
    if ($user->hasRole('sitter')) {
        // Experience Description
        setIfHasInput($request, 'experience_description', $user);

        // Experience Fields
        setIfHasBoolInput($request, 'experience_infant', $user);
        setIfHasBoolInput($request, 'experience_toddler', $user);
        setIfHasBoolInput($request, 'experience_school_age', $user);
        // END Experience Fields

        // Special Needs
        setIfHasBoolInput($request, 'experience_add_adhd', $user);
        setIfHasBoolInput($request, 'experience_asd', $user);
        setIfHasBoolInput($request, 'experience_visually_impaired', $user);
        setIfHasBoolInput($request, 'experience_hearing_impaired', $user);
        setIfHasBoolInput($request, 'experience_developmental', $user);
        setIfHasBoolInput($request, 'experience_behavioral', $user);
        setIfHasBoolInput($request, 'experience_down_syndrome', $user);
        setIfHasBoolInput($request, 'experience_seizures', $user);
        // END Special Needs

        // Video Resume
        setIfHasInput($request, 'video_resume', $user);

        // Hourly Rate
        setIfHasInput($request, 'standard_hourly_rate', $user);

    } elseif ($user->hasRole('parent')) {
        $children = buildChildrenArray($request->input("children"));
        if (is_array($children)) {
            $user->children = json_encode($children);
        }
    }

    // Name
    setIfHasInput($request, 'first_name', $user);
    setIfHasInput($request, 'last_name', $user);
    setIfHasInput($request, 'display_name', $user);

    // Address Info
    setIfHasInput($request, 'city', $user);
    setIfHasInput($request, 'region', $user);

    // About
    setIfHasInput($request, 'about', $user);

    // Journey with Christ
    setIfHasInput($request, 'journey', $user);

    if ($request->input('registration_complete') === "1") {
        $user->registration_complete = true;
    }

    $user->save();
}
