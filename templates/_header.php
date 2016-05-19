<header class="header">
  <h1>Development statistics for:</h1>
  <h2><?php echo $stats['summary']['name']; ?></h2>

  <section>
    <h3>Generated:</h3>
    <p><?php echo date('r'); ?></p>

    <h3>Report period</h3>
    <p>
      <?php echo $this->plural((strtotime($stats['summary']['last_commit']) - strtotime($stats['summary']['first_commit'])) / (60 * 60 * 24), "day"); ?>. From
      <?php echo date('Y-m-d', strtotime($stats['summary']['first_commit'])); ?> to <?php echo date('Y-m-d', strtotime($stats['summary']['last_commit'])); ?>
    </p>
  </section>

</header>

<section class="status">

  <div>
    <div class="big-number">
      <?php echo number_format(count($database['commits'])); ?>
    </div>
    <p>Commits</p>
  </div>

  <div>
    <div class="big-number">
      <?php echo number_format($stats['summary']['total_files']); ?>
    </div>
    <p>Total files</p>
  </div>

  <div>
    <div class="big-number">
      <?php echo number_format($stats['summary']['total_loc']); ?>
    </div>
    <p>Lines of code</p>
  </div>

  <div>
    <div class="big-number">
      <?php echo number_format($stats['summary']['author_count']); ?>
    </div>
    <p>Authors</p>
  </div>

</section>