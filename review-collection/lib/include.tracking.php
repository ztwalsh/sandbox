<?php if ($tracking) { ?>

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-50558000-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-50558000-2', {
    'page_title': '<?php echo $page_title ?>'
  });
</script>

<?php } else { ?>

<!-- No Tracking in Test Environment -->

<?php } ?>
