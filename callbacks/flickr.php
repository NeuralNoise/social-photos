<?php
    /* Last updated with phpFlickr 2.3.2
     *
     * Edit these variables to reflect the values you need. $default_redirect
     * and $permissions are only important if you are linking here instead of
     * using phpFlickr::auth() from another page or if you set the remember_uri
     * argument to false.
     */
    require_once(dirname(dirname(__FILE__)) . "/social_network.php");
    $api_key                 = Config::get("flickr_api_key");
    $api_secret              = Config::get("flickr_api_secret");
    $default_redirect        = "/";
    $permissions             = "delete";
    $path_to_phpFlickr_class = "../";

    ob_start();
    require_once($path_to_phpFlickr_class . "phpFlickr.php");
    unset($_SESSION['phpFlickr_auth_token']);

    if (isset($_SESSION['phpFlickr_auth_redirect']) && !empty($_SESSION['phpFlickr_auth_redirect']) ) {
        $redirect = $_SESSION['phpFlickr_auth_redirect'];
        unset($_SESSION['phpFlickr_auth_redirect']);
    }

    $f = new phpFlickr($api_key, $api_secret);

    if (empty($_GET['frob'])) {
        $f->auth($permissions, false);
    } else {
        $f->auth_getToken($_GET['frob']);
    }

    if (empty($redirect)) {
        header("Location: ../basic_info.php?network=2");
    } else {
        header("Location: ../basic_info.php?network=2");
    }

?>
