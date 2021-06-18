<?php 
/**
 * Video Chapterizer
 * 
 * Take a video and provide a chapters.csv file for it.
 * If this file, the video file, and the chapters.csv file are 
 * present in a directory, then the page will automatically
 * render the video, with the chapter list laid out and functional
 * so that you can jump around the various time points specified
 * in the CSV file.
 * 
 * Made by Allan.Haggett@gov.bc.ca
 * ----------------
 * Brought to you by the Learning Centre
 * ----------------
 */


// Let's fill in some basic settings

$video_title = 'One Public Servant\'s View on Coaching';
$video_description = 'Join Tamara Leonard-Vail, Program Lead for Managing in 
the BCPS and Tony Pesklevits, Strategic Advisor with the BC Wildfire Service 
as they talk about various aspects of the Coaching Approach to conversations.';
$video_file_name = 'coaching-approach-one-public-servant-20201229.mp4'; // coaching-approach-one-public-servant-SOURCE.mp4 
$chapters_file = 'chapters.csv';
$logo_file = 'coaching-approach-logo.png'; // max-width = ~200px landscape
$splash_image = 'coaching-approach-title-slide-blank.png'; // background: cover
$running_time = '10m 46s';
$captions_file = 'coaching-approach-one-public-servant-captions.vtt';
$speakers = [
    ['Tony Pesklevits', 'Strategic Adviser, BC Wildfire Service'],
    ['Tamara Leonard-Vail', 'Program Lead, Managing in the BCPS']
];

/**
 * 
 * DO NOT EDIT BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING :)
 * 
 */

// Disable in production
opcache_reset();

// The file name (of this file) is important! It acts as a URL-safe slug that 
// is used in multiple places. Please follow convention of all lower-case, 
// no spaces or special characters e.g. one-public-servant.php
$slug = basename(__FILE__, '.php');
$thisfile = $slug . '.php';

// We want to provide links to administrators and facilitors that 
// the learner population doesn't need and we want to keep back.
// LSApp is the Learning Centre's operations application, so we
// leverage it's RBAC. 
// See https://gww.bcpublicservice.gov.bc.ca/lsapp/people.php
// for a list of people who will be able to access content hidden
// behind a if(canAccess()) function. If you can't see the list,
// you're not on it. Request access if you can.
// You should be able to remove this part without much ado.
$path = $_SERVER['DOCUMENT_ROOT'] . '\lsapp\inc\lsapp.php';
require($path);

// We check the current chapter from the URL, so capture that here
$chapter = $_GET['chapter'];

// We're going to open the chapters file and read through it 
// once and push everything to an array so that you we can loop 
// through that array multiple times without having to open/close 
// it each time.
// The chapters file has the following headers (example included):
//
// slug,title,start,finish
// part-1,"Part 1 - Example Title",30,120

$chapters = array();
if (($handle = fopen($chapters_file, "r")) !== FALSE) {
    $dropheaders = fgetcsv($handle);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        array_push($chapters,$data);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="/learning/lsapp/favicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
        crossorigin="anonymous">

<title><?= $video_title ?></title>

<style>
#splashy { 
    background-image: url('<?= $splash_image ?>');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: bottom;
}
video {
    /* border: 2px solid #333; */
    border-radius: 3px;
    box-shadow: 10px 10px 40px #333;
    height: auto;
    max-width: 100%;
}
</style>

</head>
<body class="bg-light">
<div class="p-5" id="splashy">
<div class="container">
<div class="row">
<div class="col-12">

    <img alt="small logo for SBCPS" 
            class="" 
            src="<?= $logo_file ?>" 
            width="220">
    <a href="pre-work.php" class="btn btn-primary">View Course Pre-Work</a>

    <h1 class="display-4"><?= $video_title ?></h1>
    <p><em><?= $video_description ?></em></p>
    
</div>
<div class="col-md-3">
<div class="bg-white p-3 mt-3 mb-5 rounded-3 shadow-sm">
<ul class="nav nav-pills flex-column">
<?php foreach($chapters as $chap): ?>
    <?php $active = '' ?>
    <li class="nav-item">
        <?php if($chapter == $chap[0]) $active = 'active' ?>
        <a href="?chapter=<?= $chap[0] ?>" 
            class="nav-link chapta <?= $active ?>" 
            id="<?= $chap[0] ?>"
            data-seconds="<?= $chap[2] ?>">
                <?= $chap[1] ?>
                <!-- <span class="badge bg-dark badge-sm"><?= $chap[2] ?></span> -->
        </a>
        
    </li>
<?php endforeach ?>

</ul>
<div id="chaptermanage">
<form method="post" action="chapterize.php" class="d-none">
<input type="text" class="chaptername form-control" name="chaptername" placeholder="Name">
<input type="text" class="form-control" id="chapterseconds" name="chapterseconds" placeholder="Seconds">
<button class="btn btn-dark" id="chapteradd">+</button>
</form>
</div> <!-- /#chaptermanage -->
</div> <!-- /.bg-white -->
</div> <!-- /.col -->

<div class="col-md-8 mb-5">

<div class="bg-white p-5 mt-3 mb-5 rounded-3 shadow-sm"> <!--ratio ratio-16x9-->


    <video id="video1" width="100%" controls>
        <source src="<?= $video_file_name ?>" 
                type="video/mp4">
        <?php if(!empty($captions_file)): ?>
        <track label="English" kind="subtitles" srclang="en" src="<?= $captions_file ?>" default>
        <?php endif ?>
            Your browser does not support the video tag.
    </video>

    <div class="alert alert-light bg-light mt-3">
    <?php foreach($speakers as $s): ?>
    <div class="mb-2"><strong><?= $s[0] ?></strong>, <?= $s[1] ?></div>
    <?php endforeach ?>
    <dl>
        <dt>Running time</dt>
            <dd><?= $running_time ?></dd>
        <dt>Closed Captions</dt>
            <dd>
                <a href="<?= $captions_file ?>">Download</a> <em>(coming soon)</em>
            </dd>

    </dl>
    </div>


</div>

<?php if(canAccess()): ?>
 <div class="bg-white p-5 mb-5 rounded-3 shadow-sm">
    <h2>Download/Embed Links</h2>
    <ul class="list-group">
    <li class="list-group-item">
        <a href="<?= $video_file_name ?>" class="">
            Whole video
        </a>
    </li>
</ul>
</div>
<?php endif ?>

</div>
</div>
</div>
<footer class="footer mt-5 bg-white p-5 text-center">
<div class="container">
    <img src="coaching-approach-logo.png" alt="small logo for SBCPS" width="250">
    <div class="text-muted text-uppercase mb-2">Brought to you by: </div>
    
    <div class="mt-2 mb-1">
    <span class="d-inline-block rounded-3 mt-2 p-3 bg-light">
        Coaching Services</div>
    </span>

    <span class="d-inline-block rounded-3 p-3 bg-light">
        <img alt="Leanring Centre Logo" 
            height="30" 
            src="learning-logo-small-transparent.png" 
            width="30">
        The Learning Centre
        </span>
    </div>



</div>
</footer>

<script>
<?php 
$start = 0;
foreach($chapters as $chap) {
    if($chap[0] == $chapter) $start = $chap[2];
}
?>
var csecs = document.getElementById("chapterseconds");
var ctime = 1;
var video = document.getElementById("video1");
video.currentTime = <?= $start ?>;

document.addEventListener('click', function(event) {
    
    let stateObj = {
       foo: "bar",
    }
    var baseurl = '<?= $thisfile ?>?chapter=';

    <?php foreach($chapters as $chap): ?>
if(event.target.id === '<?= $chap[0] ?>') {
        event.preventDefault();
        video.currentTime = <?= $chap[2] ?>;
        video.play();

        let goto =  baseurl + event.target.id;
        history.pushState(stateObj, "", goto);
        _removeClasses();
        event.target.classList.add('active');
    }
    <?php endforeach ?>

    if(event.target.id === 'chapteradd') {
        event.preventDefault();
        video.pause();
        alert('add!');
    }

});

var els = document.getElementsByClassName('chapta active');
function _removeClasses() {
  while (els[0]) {
    els[0].classList.remove('active');
    return;
  }
}   

var chs = document.getElementsByClassName("chapta");
function _updateMenu(seconds) {   
    for (var i = 0; i < chs.length; i++) {
        if(seconds >= chs.item(i).getAttribute('data-seconds')) {
            _removeClasses();
            chs.item(i).classList.add('active');
        }
        
    } 
}

setInterval(function(){
    if(!video.paused) {
        _updateMenu(video.currentTime);
        //ctime = Math.floor(video.currentTime) + 1;
        //csecs.setAttribute('value', ctime);
    }
    
},1000);

</script>
</body>
</html>