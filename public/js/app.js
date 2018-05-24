const drop = document.querySelector('.dropdown-trigger');
M.Dropdown.init(drop);

const modal = document.querySelectorAll('.modal');
M.Modal.init(modal);

const float = document.querySelector('.fixed-action-btn');
M.FloatingActionButton.init(float);

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
	//AJAX SETUP ON CSRF TOKEN FOR NON-FORMS
	$.ajaxSetup(
	{
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});


	//SELECT2 INIT
	$('.select2').select2();


	$('#search, #search2').on('keyup', () =>
	{
		const value = $('#search').val();
		const value2 = $('#search2').val();
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


	//LIVE SEARCH FUNCTIONALITY
	$('#search').on('keypress', () =>
	{	
		if (event.keyCode === 13)
		{
			event.preventDefault();
		}	

		const value = $('#search').val();
		$.ajax(
		{
			type: 'GET',
			url: '/search/users',
			data: {search: value},
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

		const value = $('#search2').val();
		$.ajax(
		{
			type: 'GET',
			url: '/search/users',
			data: {search: value},
			success: function(data)
			{
				$('.searchResults').html(data);
			}
		});
	});


	//REPLIES FUNCTIONALITY
	$('.reply').on('click', function()
	{
		const comment = $(this).data('comment');
		const reply = $(this).data('reply');
		$(comment).show(500);
		$(reply).hide(500);
	});

	$('.cancelReply').on('click', function()
	{
		const comment = $(this).data('comment');
		const reply = $(this).data('reply');
		$(comment).hide(500);
		$(reply).show(500);
	});


	//LIKES FUNCTIONALITY
	$('.like').on('click', function(e)
	{
		const postID = $(this).data('post');
		e.preventDefault();

		$.ajax(
		{
			type: 'POST',
			url: '/like',
			data: {post_id: postID},
			success: function(data)
			{
				const like = '#like'+postID;

				if (data == 'like created!')
				{
					$(like).removeClass('black-text').addClass('liked');
				}

				else
				{
					if ($(like).hasClass('liked'))
					{
						$(like).removeClass('liked').addClass('black-text');
					}
				}
			}
		});
	});


	//FOLLOW FUNCTIONALITY
	$('.follow').on('click', function(e)
	{
		const userP_id = $(this).data('userid');
		e.preventDefault();

		$.ajax(
		{
			type: 'POST',
			url: '/favourite',
			data: {userP_id: userP_id},
			success: function(data)
			{
				const follow = '#follow' + userP_id;

				if (data == 'faved')
				{
					$(follow).removeClass('orange darken-2');
					$(follow).addClass('blue-grey darken-1 white-text')
						.text('Unfollow')
						.append('<i class="material-icons left">person</i>');
				}

				else
				{
					$(follow).removeClass('blue-grey darken-1 white-text')
						.text('Follow')
						.append('<i class="material-icons left">person_add</i>');
					$(follow).addClass('orange darken-2');
				}
			}
		});
	});
});