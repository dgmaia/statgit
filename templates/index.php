<?php
  require(__DIR__ . "/_header.php");
?>

<section class="status">

  <div>
    <a href="#">
      <div class="big-number">
        <?php echo number_format(count($database['commits'])); ?>
      </div>
      <p>Commits</p>
    </a>
  </div>

  <div>
    <a href="files.html">
      <div class="big-number">
        <?php echo number_format($stats['summary']['total_files']); ?>
      </div>
      <p>Total files</p>
    </a>
  </div>

  <div>
    <a href="loc.html">
      <div class="big-number">
        <?php echo number_format($stats['summary']['total_loc']); ?>
      </div>
      <p>Lines of code</p>
    </a>
  </div>

  <div>
    <a href="authors.html">
      <div class="big-number">
        <?php echo number_format($stats['summary']['author_count']); ?>
      </div>
      <p>Authors</p>
    </a>
  </div>

</section>

<section class="information">
  <h3>Generated:</h3>
  <p><?php echo date('r'); ?></p>

  <h3>Report period</h3>
  <p>
    <?php echo $this->plural((strtotime($stats['summary']['last_commit']) - strtotime($stats['summary']['first_commit'])) / (60 * 60 * 24), "day"); ?>. From
    <?php echo date('Y-m-d', strtotime($stats['summary']['first_commit'])); ?> to <?php echo date('Y-m-d', strtotime($stats['summary']['last_commit'])); ?>
  </p>

  <h3>Latest commit</h3>
  <p>
    <?php echo $this->linkCommit($stats['summary']['last_hash']); ?>
    <br/>
    <i><?php echo htmlspecialchars($stats['summary']['last_subject']); ?></i>
  </p>
</section>

<section class="container">

  <?php require(__DIR__ . "/_navigation.php") ?>

  <div class="right-column">

    <h2>Lines of Code</h2>

    <?php

    $rows = array();
    foreach ($database['commits'] as $commit) {
      $date = $commit['author_date'];
      $loc = $this->getTotalLoc($database['stats'][$commit['hash']]);
      $rows[date('Y-m-d', strtotime($date))] = array($date, $loc);
    }

    $this->renderLineChart($rows, "chart_loc", "LOC");

    ?>

    <h2>Languages</h2>

    <?php

    $rows = array();
    $commit = $database['stats'][$stats['summary']['last_hash']];
    foreach ($commit as $language => $value) {
      $rows[$language] = $value['code'];
    }

    $this->renderPieChart($rows, "chart_languages", "Lines of Code");

    ?>

    <h2>Top Authors</h2>

    <?php

    $sorted = $stats["summary"]["authors"];
    uasort($sorted, function ($a, $b) {
      if ($a["commits"] == $b["commits"]) {
        return 0;
      }
      return $a["commits"] > $b["commits"] ? -1 : 1;
    });
    $rows = array();
    foreach ($sorted as $author) {
      if ($author["email"]) {
        $rows[$author['email']] = $author['commits'];
      }
    }

    $this->renderPieChart($rows, "chart_authors_pie_commits", "Commits", 500, 300);

    ?>

    <?php

    $sorted = $stats["summary"]["authors"];
    uasort($sorted, function ($a, $b) {
      if ($a["changed"] == $b["changed"]) {
        return 0;
      }
      return $a["changed"] > $b["changed"] ? -1 : 1;
    });
    $rows = array();
    foreach ($sorted as $author) {
      if ($author["email"]) {
        $rows[$author['email']] = $author['changed'];
      }
    }

    $this->renderPieChart($rows, "chart_authors_pie_changes", "Changes", 500, 300);

    ?>

    <section class="tag-cloud">
      <h2>Tag Cloud of Words in Commit Log Messages</h2>
      <?php
        $tags = $stats['tagcloud']['all'];
        require(__DIR__ . "/_tag_cloud.php");
      ?>
    </section>
  </div>

</section>

