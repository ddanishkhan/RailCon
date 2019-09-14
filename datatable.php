<html>
<table id="example" class="table table-striped table-sm" >
        <thead>
            <tr>
			  <th>#</th>
			  <th>Name</th>
			  <th>Gender</th>
			  <th>Age</th>
			  <th>Source</th>
			  <th>Destination</th>
			  <th>Passno</th>
			  <th>Class</th> 
			  <th>Duration</th> 
			  <th>DateOfEntry</th> 
			  <th>Status</th> 
			  <th>ID Card</th> 
			  <th>Issue</th> 
			  <th>Remarks</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>               
				<td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
                <td>$163,500</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>               
				<td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
                <td>$163,500</td>
                <td>$163,500</td>
            </tr>

        </tbody>
        <tfoot>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Age</th>
			<th>Source</th>
			<th>Destination</th>
			<th>Passno</th>
			<th>Class</th> 
			<th>Duration</th> 
			<th>DateOfEntry</th> 
			<th>Status</th> 
			<th>ID Card</th> 
			<th>Issue</th> 
			<th>Remarks</th> 
			</tr>
        </tfoot>
    </table>
</html>
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "../server_side/scripts/server_processing.php"
    } );
} );

var rotation = 0

$('img').on('click', function () {
    var image = $(this).attr('src');
    $('.showimage').attr('src', image);
    rotation = 0;
    rotate(0)
    $('#myModal').modal('show');
});

$('.rotate').on('click', function () {
      rotation += 45;
      rotate(rotation)
});

function rotate(deg) {
  $('.showimage').css({
      '-webkit-transform' : 'rotate('+ deg +'deg)',
      '-moz-transform' : 'rotate('+ deg +'deg)',
      '-ms-transform' : 'rotate('+ deg +'deg)',
      'transform' : 'rotate('+ deg +'deg)'
  });
}
</script>