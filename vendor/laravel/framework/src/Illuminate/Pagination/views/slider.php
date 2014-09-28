<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>
<?php if ($paginator->getLastPage() > 1): ?>
	<div class="Pagination">
		<ul>
            <li class="Pagination-Cation"><span>Страницы</span></li>
			<?php echo $presenter->render(); ?>
		</ul>
	</div>
<?php endif; ?>
