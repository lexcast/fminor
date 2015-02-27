<?php $view->extend('base.php') ?>

<?php $view['slots']->set('title', $exception->getMessage()) ?>

<h1>Ooops, error <?php echo $exception->getStatusCode(); ?></h1>
<h2><?php echo $exception->getMessage(); ?></h2>
