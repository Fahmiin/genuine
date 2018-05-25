$(document).ready(() =>
{
	$('.quickView').on('click', function(e)
	{
		e.preventDefault();
		const userid = $(this).data('id');
		
		$.ajax(
		{
			type: 'GET',
			url: '/quickview',
			data: {userid: userid},
			success: function(data)
			{
				$('#quickView').html(data);
			}
		});
	});
});