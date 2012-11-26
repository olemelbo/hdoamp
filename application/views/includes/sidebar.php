<div id="sidebar">
		<div id="sidebar_head">
			<h2 class="mnd">M&aring;nedens</h2>
			<h2 class="deb">debattant</h2>
		</div>
		<div id="sidebar_content">
			<?php if(isset($ranking)) : ?>
			<ol>
				<?php foreach($ranking as $rank) : ?>
					<li><?php echo $rank['fname'] . " " . $rank['ename'] . " (" . $rank['points'] . ")";?></li>
				<?php endforeach; ?>
			</ol>
			<?php else : ?>
				<p>Ingen brukere har fått poeng</p>
			<?php endif; ?>
		</div>
	</div><!-- end sidebar -->

	<div id="sidebar2">
		<div id="sidebar_head2">
			<p>#Her #kommer #hashtags!</p>
	</div>
</div><!-- end sidebar -->
