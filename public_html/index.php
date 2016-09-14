<?php
/*  author: smiks
    version: 0.8.5
    latest minor upgrade:
    - error checking when class does not exist
    - rewrote function render in Controller.php

    latest bigger upgrades: 
    - gzip compression
    - function render in controller
*/
session_start();
#ob_start();

/* PHP IDPS */
include("PHPIDPS/__main__.php");
$feedback = feedback();
$threatLevel = $feedback["threatLevel"];
$threatTags = $feedback['tags'];
if($threatLevel > 50){
    print_r($threatTags);
    echo("<br>");
    exit("You shall not pass!");
}


header("Cache-Control: max-age=86400");
require_once 'config/page_settings.php';
require_once 'config/config.php';
require_once 'config/connect.php';
require_once 'core/Router.php';
require_once 'core/Functions.php';
require_once 'core/Global.php';

if($_PAGE_LOAD_TIME){
    $_PAGE_LOAD_START = microtime(true);
}
/* when to go to login page */

if(!isset($_SESSION['loggedin']) && $_GET['page'] != "login"){
    $_GET['page'] = "login";
}


/* routing */
Router::home('login', 'app/controllers/Login.php');
Router::set(array(
    'home' => 'app/controllers/Home.php',
    'profile' => 'app/controllers/Profile.php',
    'usergallery' => 'app/controllers/UserGallery.php',
    'login' => 'app/controllers/Login.php',
    'logout' => 'app/controllers/Logout.php',
    'settings' => 'app/controllers/Settings.php',
    'editpicture' => 'app/controllers/EditPicture.php',
    'editwall' => 'app/controllers/EditWall.php',
    'edituser' => 'app/controllers/EditUser.php',
    'editdescription' => 'app/controllers/EditDescription.php',
    'journals' => 'app/controllers/Journals.php',
    'postcomment' => 'app/controllers/PostComment.php',
    'upload' => 'app/controllers/Upload.php',
    'search' => 'app/controllers/Search.php',
    'sub' => 'app/controllers/Sub.php',
    'bidsub' => 'app/controllers/BidSub.php',
    'newjournal' => 'app/controllers/NewJournal.php',
    'editjournal' => 'app/controllers/EditJournal.php',
    'deletejournal' => 'app/controllers/DeleteJournal.php',
    'commissions' => 'app/controllers/Commissions.php',
    'buynow' => 'app/controllers/Buynow.php',
    'messages' => 'app/controllers/Messages.php',
    'conversation' => 'app/controllers/Conversation.php',
    'postmessage' => 'app/controllers/PostMessage.php',
    'messagehistory' => 'app/controllers/MessageHistory.php',
    'newmessage' => 'app/controllers/NewMessage.php',
    'transactions' => 'app/controllers/Transactions.php',
    'removefavourite' => 'app/controllers/RemoveFavourite.php',
    'addfavourite' => 'app/controllers/AddFavourite.php',
    'archiveauction' => 'app/controllers/ArchiveAuction.php',
    'feedback' => 'app/controllers/Feedback.php',
    'filter' => 'app/controllers/Filter.php',
    ));
Router::route();


if($_PAGE_LOAD_TIME){
    $pageLoad = number_format( ((microtime(true) - $_PAGE_LOAD_START)*1000) , 2);
    echo"<br>Page loaded in {$pageLoad}ms";
}
if($_NUM_QUERIES){
    echo"<br>{$db->num_queries} queries";
}
if($_MEMORY_USAGE){
    $memory = number_format(memory_get_usage()/(1024*1024),2);
    $maxMemory = number_format(memory_get_peak_usage()/(1024*1024), 2);
    echo"<br>Memory usage: {$memory }MB (Peak: {$maxMemory} MB)";
}
if($_DEBUG){
    echo"<div style='overflow:auto; color:#FFF'>DEBUG MODE<br>";
    debug_print_backtrace();
    echo"<hr>";
    echo"Last error <br>";
    print_r(error_get_last());
    echo"</div>";
}
