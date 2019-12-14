$(document).ready(function() {
	$(".city").change(function() {
		 var id = $(".city").val();
		// $.post('data.php', {id: 'id'}, function(data) {
		// 	$(".tinh").html(data);
		console.log(id);
		// });
	});
});