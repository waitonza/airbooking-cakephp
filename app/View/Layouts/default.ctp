<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
		<!-- Set the viewport width to device width for mobile -->
  		<meta name="viewport" content="width=device-width" />

  		<title>Page Title</title>

  		<!-- Included CSS Files, use foundation.css if you do not want minified code -->
  		<link rel="stylesheet" href="../foundation/stylesheets/foundation.min.css">
  		<link rel="stylesheet" href="../foundation/stylesheets/app.css">
      <link rel="stylesheet" href="../css/booking.css" />
      <script src="../foundation/javascripts/jquery.js"></script>

  		<!-- Custom Modernizr for Foundation -->
  		<script src="../foundation/javascripts/foundation/modernizr.foundation.js"></script>
	<?php

		//echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<!-- Basic Needs -->
	<nav class="top-bar" style="">
                    <ul>
                      <!-- Title Area -->
                      <li class="name">
                        <h1>
                          <a href="#">
                            Airline Booking Online
                          </a>
                        </h1>
                      </li>
                      <li class="toggle-topbar"><a href="#"></a></li>
                    </ul>

                    
                  <section>
                      <!-- Right Nav Section -->
                      <ul class="right">
                        <li class="divider show-for-medium-and-up"></li>
                      	<li>
                      		<a href="../">หน้าแรก</a>
                      	</li>
                        <li class="divider show-for-medium-and-up"></li>
                        <li>
                          <a href="../booking">จองตั๋ว</a>
                        </li>
                        <li class="divider show-for-medium-and-up"></li>
                        <li class="has-dropdown">
                          <a href="#">ผู้ดูแลระบบ</a>
                          <!--
                          <ul class="dropdown"><li class="title back js-generated"><h5><a href="#">Item 2</a></h5></li>
                            <li><label>รายการ</label></li>
                            <li><a href="#">ดู/แก้ไขรายการการจอง</a></li>
                            <li class="divider"></li>
                            <li><label>ข้อมูลส่วนตัว</label></li>
                            <li><a href="#">แก้ไขข้อมูลส่วนตัว</a></li>
                            <li><a href="#">เปลี่ยนรหัสผ่าน</a></li>
                            <li class="divider"></li>
                            <li><a href="#">ออกจากระบบ</a></li>
                          </ul>
                        -->
                        </li>
                      </ul>
                    </section></nav>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<!-- Latest version of jQuery -->

			  <!-- Included JS Files (Unminified) -->
			  <!-- [JS Files] -->
			  <!-- We include all the unminified JS as well. Uncomment to use them instead -->

			  <!-- Included JS Files (Minified) -->
			  <script src="../foundation/javascripts/foundation.min.js"></script>

			  <!-- Initialize JS Plugins -->
			  <script src="../foundation/javascripts/app.js"></script>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
