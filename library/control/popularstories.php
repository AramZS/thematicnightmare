<?php
/** Most popular stories this week, if I can get it to work. **/

function get_stats_exclude_home($numDays,$numPosts) {
      $numPostsPlus = $numPosts + 1;
      $blnHasHome = false;
      $intRowsLoop = 0;
      $intRowFound;
      $intRowsCount;
      $most_read_posts;

      $strArgs = 'days=' . $numDays . '&limit=' . $numPostsPlus;

      if (function_exists('stats_get_csv')) {
        $most_read_posts = stats_get_csv('postviews', $strArgs);
      }

      foreach ($most_read_posts as $single_post) {
        $postTitle = $single_post['post_title'];
        if($postTitle == 'Home page') {
          $blnHasHome = true;
          $intRowFound = $intRowsLoop;
        }
        $intRowsLoop = $intRowsLoop + 1;
      }

      $intRowsCount = $intRowsLoop + 1;

      if($blnHasHome) {
        unset($most_read_posts[$intRowFound]);
      } else {
        if($intRowsCount > $numPosts){
          unset($most_read_posts[$numPosts]);
        }
      }

      return $most_read_posts;
} 


?>