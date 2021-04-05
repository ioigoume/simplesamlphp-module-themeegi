<?php
$this->data['header'] = $this->t('{userid:error:header}');
$this->data['jquery'] = array('core' => TRUE);

$this->data['head'] = <<<EOF
<meta name="robots" content="noindex, nofollow" />
<meta name="googlebot" content="noarchive, nofollow" />
EOF;

$this->includeAtTemplateBase('includes/header.php');
$retryUrl = $this->data['parameters']['%BASEDIR%'] . 'saml2/idp/initSLO.php?RelayState=' . urlencode($this->data['parameters']['%RESTARTURL%']);
$translationParams = [
  '%IDPNAME%' => $this->data['parameters']['%IDPNAME%'],
];
?>
<div class="row">
  <div class="col-sm-12">
  <?php
    $friendlyTitle = '<h2>' . $this->t('{themeegi:userid_error:friendly_title}') . '</h2>';
    echo $friendlyTitle;
  ?>
    <p><?php echo $this->t('{themeegi:userid_error:friendly_description}', $translationParams); ?></p>
    <p><?php echo $this->t('{themeegi:userid_error:resolution_description}', array('%RETRY_URL%' => $retryUrl)); ?></p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="text-center">
    <a href="<?php echo $retryUrl; ?>" class="ssp-btn btn ssp-btn__action text-uppercase">
        <?php echo $this->t('{themeegi:userid_error:go2disco}'); ?>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <h2><?php echo $this->t('{themeegi:userid_error:details_title}'); ?></h2>
    <p><?php echo $this->t('{themeegi:userid_error:details_description}'); ?></p>
    <pre class="ssp-error-code">
      <?php foreach ($this->data['parameters']['%ATTRIBUTES%'] as $attr) echo $attr . '<br>'; ?>
    </pre>
  </div>
</div>
<?php
$this->includeAtTemplateBase('includes/footer.php');
