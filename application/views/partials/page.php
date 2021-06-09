<?php $paging_info = get_paging_info($page_total,1,$page); ?>

<!-- Card footer -->
<div class="card-footer py-4">
	<nav aria-label="pagging">
		<ul class="pagination justify-content-end mb-0">
			<?php if($paging_info['curr_page'] > 1) : ?>
				<li class="page-item"><a class="page-link" href='<?= $url;?>1' title='Page 1'><i class="fas fa-angle-left"></i><i class="fas fa-angle-left"></i></a></li>
				<li class="page-item"><a class="page-link" href='<?= $url;?><?php echo ($paging_info['curr_page'] - 1);?>' title='Page <?php echo ($paging_info['curr_page'] - 1); ?>'>
					<i class="fas fa-angle-left"></i></a></li>
				<?php
			endif; 
			$max = 5;
			if($paging_info['curr_page'] < $max)
				$sp = 1;
			elseif($paging_info['curr_page'] >= ($paging_info['pages'] - floor($max / 2)) )
				$sp = $paging_info['pages'] - $max + 1;
			elseif($paging_info['curr_page'] >= $max)
				$sp = $paging_info['curr_page']  - floor($max/2);
			?>

			<?php if($paging_info['curr_page'] >= $max) : ?>
				<li class="page-item"><a class="page-link" href='<?= $url;?>1' title='Page 1'>1</a></li>
				<li class="page-item"><a class="page-link" href="#">..</a></li>
			<?php endif; ?>
			<?php for($i = $sp; $i <= ($sp + $max -1);$i++) : ?>
				<?php

				if($i > $paging_info['pages'])
					continue;
				?>
				<?php if($paging_info['curr_page'] == $i) : ?>
					<li class="page-item active"><a class="page-link" href="#"><b><?php echo $i; ?></b></a></li>
				<?php else : ?>
					<li class="page-item"><a class="page-link" href='<?= $url;?><?php echo $i;?>' title='Page <?php echo $i; ?>'><?php echo $i; ?></a></li>
				<?php endif; ?>
			<?php endfor; ?>

			<?php if($paging_info['curr_page'] < ($paging_info['pages'] - floor($max / 2))) : ?>
				<li class="page-item"><a href="#" class="page-link">..</a></li>
				<li class="page-item"><a class="page-link" href='<?= $url;?><?php echo $paging_info['pages'];?>' title='Page <?php echo $paging_info['pages']; ?>'><?php echo $paging_info['pages']; ?></a></li>
			<?php endif; ?>
			<?php if($paging_info['curr_page'] < $paging_info['pages']) : ?>
				<li class="page-item"><a class="page-link" href='<?= $url;?><?php echo ($paging_info['curr_page'] + 1);?>' title='Page <?php echo ($paging_info['curr_page'] + 1); ?>'>					
					<i class="fas fa-angle-right"></i></a></li>
				<li class="page-item"><a class="page-link" href='<?= $url;?><?php echo $paging_info['pages'];?>' title='Page <?php echo $paging_info['pages']; ?>'><i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i></a></li>
			<?php endif; ?>
		</ul>
	</nav>
</div>