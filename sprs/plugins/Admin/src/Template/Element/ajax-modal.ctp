<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('click','.ajax-modal-popup',function(e){
			var loader_image = '<div class="modal-dialog modal-md"><div class="modal-content"><div class="modal-body"><div class="ajaxloader"></div></div></div></div>';
			
			e.preventDefault();
			var link = $(this).attr("href");
			$('#myModal').modal('show');
			$("#myModal").html(loader_image);

			$.ajax({
				url: link,
				success: function (data) {
					$(".ajaxloader").hide();
					$("#myModal").html(data);
					//$('.portfolio-view-content.nofollow a').attr('rel', 'nofollow');
				}
			});
		});
	});
</script>
