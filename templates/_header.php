<header class="header">
  <h1>Development statistics for:</h1>
  <h2><?php echo $stats['summary']['name']; ?></h2>
</header>

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