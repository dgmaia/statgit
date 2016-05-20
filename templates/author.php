<?php
$author = $argument;
?>

<?php
  require(__DIR__ . "/_header.php");
?>

<section class="page-header">
  <div class="breadcrumb">
    <a href="index.html">Home</a>
    <a href="authors.html">Authors</a>
  </div>
  <h2><?php echo htmlspecialchars($author['email']); ?></h2>
</section>

<section class="container">

  <?php require(__DIR__ . "/_navigation.php") ?>

  <div class="right-column">
    <h2>Name</h2>
    <p><?php echo htmlspecialchars($author['name']); ?></p>

    <h2>First commit</h2>
    <p>
      <?php echo $this->linkCommit($author['first_hash']); ?>
      <br>
      <i><?php echo htmlspecialchars($author['first_subject']); ?></i>
    </p>

    <h2>Last commit</h2>
    <p>
      <?php echo $this->linkCommit($author['last_hash']); ?>
      <br>
      <i><?php echo htmlspecialchars($author['last_subject']); ?></i>
    </p>

    <h2>Commits</h2>
    <p><?php echo number_format($author['commits']); ?></p>

    <h2>Changes</h2>
    <p>
      <?php echo $this->plural($author['added'], "addition"); ?>,
      <?php echo $this->plural($author['removed'], "deletion"); ?>
    </p>
    <?php

    $commit_email = $author['email'];
    require(__DIR__ . "/_author_activity.php");

    ?>

    <h2>Files with Most Revisions</h2>

    <table class="statistics">
      <thead>
        <tr><th>File</th><th>Commits</th></tr>
      </thead>
      <tbody>
    <?php

    foreach ($author['files'] as $filename => $commits) {
      $exists = $stats['file_revisions'][$filename]['exists'];

      echo "<tr>";
      echo "<th class=\"filename\"><span class=\"file" . ($exists ? " exists" : " deleted") . "\">" . htmlspecialchars($filename) . "</span></th>";
      echo "<td class=\"number\">" . number_format($commits) . "</td>";
      echo "</tr>\n";
    }

    ?>
      </tbody>
    </table>

    <h2>Tag Cloud of Words in Commit Log Messages</h2>

    <?php
    $tags = $stats['tagcloud'][$author['email']];
    require(__DIR__ . "/_tag_cloud.php");
    ?>

    <h2>Most Owned Files</h2>

    <table class="statistics">
      <thead>
        <tr><th>File</th><th>Blame %</th></tr>
      </thead>
      <tbody>
    <?php

    foreach ($author['blame_files'] as $filename => $blame) {
      $exists = $stats['file_revisions'][$filename]['exists'];

      echo "<tr>";
      echo "<th class=\"filename\"><span class=\"file" . ($exists ? " exists" : " deleted") . "\">" . htmlspecialchars($filename) . "</span></th>";
      echo "<td class=\"number\">" . sprintf("%0.2f%%", 100 * $blame) . "</td>";
      echo "</tr>\n";
    }

    ?>
      </tbody>
    </table>

  </div>

</section>
