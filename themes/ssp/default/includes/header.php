<?php



/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = array(
  'htmlContentPre' => array(),
  'htmlContentPost' => array(),
  'htmlContentHead' => array(),
);


$jquery = array();
if (array_key_exists('jquery', $this->data)) $jquery = $this->data['jquery'];

if (array_key_exists('pageid', $this->data)) {
  $hookinfo = array(
    'pre' => &$this->data['htmlinject']['htmlContentPre'],
    'post' => &$this->data['htmlinject']['htmlContentPost'],
    'head' => &$this->data['htmlinject']['htmlContentHead'],
    'jquery' => &$jquery,
    'page' => $this->data['pageid']
  );

  SimpleSAML_Module::callHooks('htmlinject', $hookinfo);
}
// - o - o - o - o - o - o - o - o - o - o - o - o -

/**
 * Do not allow to frame SimpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put SimpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<title>
  <?php
  if (strpos($this->t('{themeegi:default:browser_tab_title}'), 'not translated') === FALSE) {
    echo $this->t('{themeegi:default:browser_tab_title}');
  }
  if(array_key_exists('header', $this->data)) { echo (' | ' . $this->data['header']); } 
  ?>
</title>

<link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars(SimpleSAML_Module::getModuleURL('themeegi/resources/css/app.css')); ?>" />

<link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars(SimpleSAML_Module::getModuleURL('themeegi/resources/images/logo_site-300x300.png')); ?>" />
<link rel="apple-touch-icon" href="<?php echo htmlspecialchars(SimpleSAML_Module::getModuleURL('themeegi/resources/images/logo_site-300x300.png')); ?>" />

<?php

if(!empty($jquery)) {
  $version = '1.8';
  if (array_key_exists('version', $jquery))
    $version = $jquery['version'];

  if ($version == '1.8') {
    if (isset($jquery['core']) && $jquery['core'])
      echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-1.8.js"></script>' . "\n");

    if (isset($jquery['ui']) && $jquery['ui'])
      echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui-1.8.js"></script>' . "\n");

    if (isset($jquery['css']) && $jquery['css'])
      echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] .
      'resources/uitheme1.8/jquery-ui.css" />' . "\n");
  }
}

if (isset($this->data['clipboard.js'])) {
  echo '<script type="text/javascript" src="/'. $this->data['baseurlpath'] .
    'resources/clipboard.min.js"></script>'."\n";
}

if(!empty($this->data['htmlinject']['htmlContentHead'])) {
  foreach($this->data['htmlinject']['htmlContentHead'] AS $c) {
    echo $c;
  }
}




if ($this->isLanguageRTL()) {
?>
  <link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/default-rtl.css" />
<?php
}
?>


  <meta name="robots" content="noindex, nofollow" />


<?php
if(array_key_exists('head', $this->data)) {
  echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>
<?php
$onLoad = '';
if(array_key_exists('autofocus', $this->data)) {
  $onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
  $onLoad .= $this->data['onLoad'];
}

if($onLoad !== '') {
  $onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?>>

<div class="header">
<?php
  if ($this->t('{themeegi:default:ribbon_text}')) {
    echo '<div class="corner-ribbon red">';
    echo $this->t('{themeegi:default:ribbon_text}');
    echo '</div>';
  }
  ?>
  <div class="text-center ssp-logo">
    <a href="<?php echo $this->t('{themeegi:default:logo_link_url}'); ?>" title="<?php echo $this->t('{themeegi:default:header_title}'); ?>">
      <img src="<?php echo SimpleSAML_Module::getModuleURL('themeegi/resources/images/logo.svg'); ?>" alt="EGI" />
    </a>
  </div>
  <h1 class="text-center">
    <?php echo $this->t('{themeegi:default:header_title}'); ?>
    <small><?php echo $this->t('{themeegi:default:header_subtitle}'); ?></small>
  </h1>
</div> <!-- /header -->
<div class="ssp-container" id="content">
<div class="container js-spread">


<?php

if(!empty($this->data['htmlinject']['htmlContentPre'])) {
  foreach($this->data['htmlinject']['htmlContentPre'] AS $c) {
    echo $c;
  }
}
