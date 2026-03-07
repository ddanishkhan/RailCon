<!--Pagination -->
<nav aria-label="Page navigation">
	<ul class="pagination">

	<?php
		$total_records_pages = $total_filtered ?? 0;
		$pages         = intval($total_records_pages / $size);

		for ($i = 0; $i < $currpage; $i++) {
			echo "<li class='page-item'>";
			echo "<a class='page-link' href='?page=".$i."'> $i </a>";
			echo "</li>";
			}

			echo "<li class='page-item active'>";
			echo "<a class='page-link' href='?page=".$i."'> $i </a>";
			echo "</li>";
		$i++;

		for (; $i <= $pages; $i++) {
			echo "<li class='page-item'>";
			echo "<a class='page-link' href='?page=".$i."'> $i </a>";
			echo "</li>";
			}
	?>
	</ul>
</nav>
<!--Pagination -->
