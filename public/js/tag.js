$(document).ready(() =>
{
	$('#searchTag').on('keyup', () =>
	{
		let value = $('#searchTag').val();
		//REVEAL ONLY IF SEARCH INPUT IS FOCUSED AND HAS VALUE
		if (value != "")
		{
			$('.tagSearchResults').removeClass('hidden');
		}
	});

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