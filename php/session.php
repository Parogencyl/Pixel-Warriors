<?php
   include('connect.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $sessionSql = "SELECT player.Login FROM player WHERE player.Login='$user_check'";
   $ses_sql = mysqli_query($connection, $sessionSql);
   if (mysqli_num_rows($ses_sql) > 0) {
       $row = mysqli_fetch_assoc($ses_sql);
       $login_session = $row['Login'];
   }

   
   if(!isset($_SESSION['login_user'])){
      header("location: ../index.php");
      die();
   }

   // Ustawienie daty ostetniej aktywności
   $lastActive = "SELECT LastActive FROM player WHERE player.Login='$user_check'";
   $lastActiveQuery = mysqli_query($connection, $lastActive);
   if (mysqli_num_rows($lastActiveQuery) > 0) {
       $row = mysqli_fetch_assoc($lastActiveQuery);
       $lastActive = $row['LastActive'];
   }

   $currentDate = date("Y-m-d");

   if($lastActive != date("Y-m-d")){
      $lastActive = "UPDATE player SET LastActive='$currentDate' WHERE player.Login='$user_check'";
      $lastActiveQuery = mysqli_query($connection, $lastActive);
   }

/*
   if(isset($_SESSION['ip'])) {
      if($_SESSION['ip'] <> $_SERVER['REMOTE_ADDR']){
         header("location: ../index.php");
         session_unset();
         session_destroy();
         die();
      }
   } else {
      $_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; 
   }
   */
?>