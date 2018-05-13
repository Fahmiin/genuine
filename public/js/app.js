const drop = document.querySelector('.dropdown-trigger');
M.Dropdown.init(drop);

const modal = document.querySelectorAll('.modal');
M.Modal.init(modal);

const float = document.querySelector('.fixed-action-btn');
M.FloatingActionButton.init(float);

const tool = document.querySelectorAll('.tooltipped');
M.Tooltip.init(tool);

const openFile = function(event)
{
	const input = event.target;

	const reader = new FileReader();
	reader.onload = () =>
	{
		const dataURL = reader.result;
		const output = document.getElementById('postPic');
		output.src = dataURL;
	};
	reader.readAsDataURL(input.files[0]);
};

$(document).ready(() =>
{
	$('#search, #search2').on('keyup', () =>
	{
		let value = $('#search').val();
		let value2 = $('#search2').val();
		//REVEAL ONLY IF SEARCH INPUT IS FOCUSED AND HAS VALUE
		if ((value != "") || (value2 != ""))
		{
			$('.searchDropdown').removeClass('hidden');
		}
	});

	$(document).on('click', (e) =>
	{
		//CHECK TO SEE IF THE CLICKED AREA IS NOT THE DROPDOWN OR NOT
		if ((!$(event.target).closest('#search').length) || (!$(event.target).closest('#search2').length))
		{
			$('.searchDropdown').addClass('hidden');
		}
	});

	$('#search').on('keypress', () =>
	{	
		if (event.keyCode === 13)
		{
			event.preventDefault();
		}	

		let value = $('#search').val();
		$.ajax(
		{
			type: 'GET',
			url: '/search/users',
			data: {'search': value},
			success: function(data)
			{
				$('.searchResults').html(data);
			}
		});
	});

	$('#search2').on('keypress', () =>
	{
		if (event.keyCode === 13)
		{
			event.preventDefault();
		}

		let value = $('#search2').val();
		$.ajax(
		{
			type: 'GET',
			url: '/search/users',
			data: {'search': value},
			success: function(data)
			{
				$('.searchResults').html(data);
			}
		});
	});
});