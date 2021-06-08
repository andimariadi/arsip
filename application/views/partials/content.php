<?php
$this->load->view('partials/head.php', array('title' => $title));
$this->load->view('partials/sidebar.php');
echo $contents;
$this->load->view('partials/footer.php');
?>