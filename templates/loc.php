<?php
  require(__DIR__ . "/_header.php");
?>

<section class="page-header">
  <div class="breadcrumb">
    <a href="index.html">Home</a>
  </div>
  <h2>Lines of Code</h2>
</section>

<section class="container">

  <?php require(__DIR__ . "/_navigation.php") ?>

  <div class="right-column">
    <h2>Total files</h2>
    <p><?php echo number_format($stats['summary']['total_files']); ?></p>

    <h2>Total lines of code</h2>
    <p><?php echo number_format($stats['summary']['total_loc']); ?></p>

    <h2>First commit</h2>
    <p><?php echo date('r', strtotime($stats['summary']['first_commit'])); ?></p>

    <h2>Last commit</h2>
    <p><?php echo date('r', strtotime($stats['summary']['last_commit'])); ?></p>

    <?php

    $rows = array();
    foreach ($database['commits'] as $commit) {
      $date = $commit['author_date'];
      $loc = $this->getTotalLoc($database['stats'][$commit['hash']]);
      $rows[date('Y-m-d', strtotime($date))] = array($date, $loc);
    }

    $this->renderLineChart($rows, "chart_loc", "LOC", 800, 600);

    ?>
  </div>

</section>