<?php 
//
// When you're first creating this file, comment out the  
// opcache_reset below so that the page refreshes in a decent
// amount of time. Re-comment it when you're done.
//
// opcache_reset();
//
// 
//0-CourseID,1-Status,2-CourseName,3-CourseShort,4-ItemCode,5-ClassTimes,6-ClassDays,7-ELM,8-PreWork,9-PostWork,10-CourseOwner,
//11-MinMax,12-CourseNotes,13-Requested,14-RequestedBy,15-EffectiveDate,16-CourseDescription,17-CourseAbstract,18-Prerequisites,
//19-Keywords,20-Categories,21-Method,22-elearning,23-WeShip,24-ProjectNumber,25-Responsibility,26-ServiceLine,
//27-STOB,28-MinEnroll,29-MaxEnroll,30-StartTime,31-EndTime,32-Color

$courseid = 20210507084423;
$path = $_SERVER['DOCUMENT_ROOT'] . '\lsapp\inc\lsapp.php';
require($path);
$deets = getCourse($courseid);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="The Learning Centre">

<meta name="description" content="<?= $deets[16] ?>">

<title><?= $deets[2] ?> - Course Pre-work</title>

<link rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
      crossorigin="anonymous">
      
<style>
/** You can also use .img-fluid on images, but I almost never want a different
    behaviour, so I set responsive images (and iframes) globally */
iframe,
img {
  height: auto;
  max-width: 100%;
}
</style>
</head>
<body>
<nav class="site-header py-3 text-white" style="background-color: #003366;">
  <div class="container d-flex justify-content-between">
    <span class="navbar-brand d-inline-block mt-2" style="font-size: 1.6em;">Course Pre-Work</span>
    <img alt="Where Ideas Work logo" class="d-none d-md-block" src="where-ideas-work.png" width="300">
  </div>
</nav>

<div class="container-fluid bg-light">
<div class="row justify-content-md-center">
<div class="col-md-6">
<?php if(canAccess()): ?>
<?php // you can put a message here for anyone who has access to LSApp ?>
<?php endif ?>
<div class="my-5 p-5 bg-white rounded-3 shadow-lg">
  <h1><?= $deets[2] ?></h2>
  <div>
  <?= $deets[16] ?>
  </div>
</div>
 

  <!-- DELETE THIS LINE (and below too) TO ENABLE ZOOM COLLECTION NOTICE

  <div class="alert alert-warning">

    <p><strong>You are not required to create a Zoom account in order to join 
    this meeting. </strong></p>
    <p><em>If you choose to create an account and/or download the Zoom software, 
    please ensure you have your ministry/organization approval to do so.</em></p>

    <div><strong>Collection Notice</strong></div>

    <p>Any personal information shared during this Zoom session is collected by the 
    BC Public Service Agency as per s. 26(c) of the Freedom of Information and 
    Protection of Privacy Act and will be used for the purposes of your 
    participation in the Our Lens to the World: Understanding Our Frame of 
    Reference. While no recordings will be saved to the Zoom storage cloud, 
    Zoom conducts data and logs usage analytics including personal information 
    such as IP address which may be shared with third parties and stored outside 
    of Canada. By participating in this session you are consenting to the 
    collection of your personal information by Zoom and its third-parties. Should 
    you have any questions regarding the collection of this personal information 
    please contact <?= $deets[10] ?></p>

  </div>

  DELETE THIS LINE (and above too) TO ENABLE ZOOM COLLECTION NOTICE --> 

</div>
</div>
</div>

<div class="container-fluid bg-light">
<div class="row justify-content-md-center">
<div class="col-md-6">
<div class="bg-white my-5 p-5 text-center rounded-lg shadow-sm">
<img alt="Where Ideas Work" src="wiw-pos-rgb.png" width="420">
</div>
</div>
<div class="col-md-6">
<div class="bg-white my-5 p-5 text-center rounded-lg shadow-sm">
Brought to you by:<br>
<a href="https://learningcentre.gww.gov.bc.ca/"
    target="_blank" 
    rel="noopener">
      <img alt="Brought to you by the Learning Centre" height="100" src="lc-logo-wordmark-300x100.png" width="300">
</a>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
          crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.6/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="/docs/4.6/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" 
        crossorigin="anonymous"></script>


</body>
</html>
