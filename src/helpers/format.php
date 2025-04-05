
<?php

// date format function
function dateFormat($date) {
    // set timezone
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $currentDate = new DateTime();
    $date = new DateTime($date);

    $interval = $currentDate->diff($date);

    if ($interval->y > 0) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m > 0) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } elseif ($interval->i > 0) {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } else {
        return 'just now';
    }
}

function truncateText($text, $limit) {
    return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
}

function formatRole() {
    return $_SESSION['role_id'] === '1' ? 'student' : 'admin';
}

?>