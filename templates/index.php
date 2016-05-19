<?php
  require(__DIR__ . "/_header.php");
?>

<dl>

  <dt>Latest commit</dt>
  <dd>
    <?php echo $this->linkCommit($stats['summary']['last_hash']); ?>
    <br>
    <i><?php echo htmlspecialchars($stats['summary']['last_subject']); ?></i>
  </dd>

</dl>

<ul class="navigation">
  <li><a href="authors.html">Authors</a></li>
  <li><a href="loc.html">Lines of code</a></li>
  <li><a href="languages.html">Language statistics</a></li>
  <li><a href="files.html">File statistics</a></li>
  <?php if ($stats['summary']['phpstats']) { ?>
    <li><a href="php.html">PHP statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['rubystats']) { ?>
    <li><a href="ruby.html">Ruby statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['rails'] && $stats['summary']['rails']['controllers']) { ?>
    <li><a href="rails.html">Ruby on Rails statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['schema'] && $stats['summary']['schema']['tables']) { ?>
    <li><a href="schema.html">Schema statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['rspec'] && $stats['summary']['rspec']['its']) { ?>
    <li><a href="rspec.html">Rspec statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['cucumber'] && $stats['summary']['cucumber']['scenarios']) { ?>
    <li><a href="cucumber.html">Cucumber statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['composer']) { ?>
    <li><a href="composer.html">Composer statistics</a></li>
  <?php } ?>
  <?php if ($stats['summary']['gemfile']) { ?>
    <li><a href="gemfile.html">Gemfile statistics</a></li>
  <?php } ?>
  <li><a href="churn.html">Churn</a></li>
</ul>

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

<h2>Tag Cloud of Words in Commit Log Messages</h2>

<?php
$tags = $stats['tagcloud']['all'];
require(__DIR__ . "/_tag_cloud.php");
?>

