<?php

/**
 * Page view
 *
 * @package Socker
 * @version 0.3
 * @author Mikita Stankevich <designovermatter@gmail.com>
 */

$this->getHeader();

?>

<h1>Yey! You did it!</h1>

<p>This is what <code>$something</code> variable want to tell us: <?php echo $something; ?></p>

<p>You're now viewing <em>page()</em> method of Home controller. <a href="/socker/home/index/">Return to <em>index()</em> method of Home controller</a></p>


<?php

$this->getFooter();