<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>
<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="Pagination">
        <li class="Pagination-Cation"><span>Страницы</span></li>
	    <?php echo $presenter->render(); ?>
	</ul>
<?php endif; ?>
