$(document).ready(() =>
{
	$('#searchTag').on('keypress', () =>
	{
		if (event.keycode === 13)
		{
			event.preventDefault();
		}

		let value = $('#searchTag').val();
		$.ajax(
		{
			type: 'GET',
			url: '/search/tags',
			data: {'search': value},
			success: function (data)
			{
				$('.tagSearchResults').html(data);
			}
		});
	});
});