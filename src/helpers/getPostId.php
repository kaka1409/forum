<?php

function getPostId() {
    return explode('/', $_SERVER['REQUEST_URI'])[4];
}

?>