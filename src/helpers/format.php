
<?php

// date format function
function dateFormat($date) {
    $currentDate = new DateTime();
    $date = new DateTime($date);

    $interval = $currentDate->diff($date);
    if ($interval->days > 365) {
        return floor($interval->days / 365) . ' years ago';
    } elseif ($interval->days > 30) {
        return floor($interval->days / 30) . ' months ago';
    } elseif ($interval->days) {
        return $interval->days . ' days ago';
    } elseif ($interval->h > 0) {
        return $interval->h . ' hours ago';
    } elseif ($interval->i > 0) {
        return $interval->i . ' minutes ago';
    } else {
        return 'just now';
    }
}

?>