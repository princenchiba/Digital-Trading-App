<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(2);
?>

<nav aria-label="<?php echo lang('Pager.pageNavigation') ?>" class="dataTables_paginate paging_simple_numbers">
	<ul class="pagination">
		<?php if ($pager->hasPrevious()) : ?>
			<li class="paginate_button page-item">
				<a href="<?php echo $pager->getFirst() ?>" aria-label="<?php echo lang('Pager.first') ?>" class="page-link">
					<span aria-hidden="true"><?php echo lang('Pager.first') ?></span>
				</a>
			</li>
			<li class="paginate_button page-item">
				<a href="<?php echo $pager->getPrevious() ?>" aria-label="<?php echo lang('Pager.previous') ?>" class="page-link">
					<span aria-hidden="true"><?php echo lang('Pager.previous') ?></span>
				</a>
			</li>
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li <?php echo $link['active'] ? 'class="active paginate_button page-item"' : 'class="paginate_button page-item"' ?>>
				<a href="<?php echo $link['uri'] ?>" class="page-link">
					<?php echo $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if ($pager->hasNext()) : ?>
			<li>
				<a href="<?php echo $pager->getNext() ?>" aria-label="<?php echo lang('Pager.next') ?>" class="page-link">
					<span aria-hidden="true"><?php echo lang('Pager.next') ?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo $pager->getLast() ?>" aria-label="<?php echo lang('Pager.last') ?>" class="page-link">
					<span aria-hidden="true"><?php echo lang('Pager.last') ?></span>
				</a>
			</li>
		<?php endif ?>
	</ul>
</nav>
