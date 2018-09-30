<!--Pagination -->
<nav aria-label="...">
	<ul class="pagination">

	<?php
		//page number
		/*$sql_query_pages     = "SELECT id FROM student";
		Take before*/
		$result_pages        = $db->query($sql_query_pages);
		$total_records_pages = $result_pages->num_rows;
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