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