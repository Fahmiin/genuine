const elem = document.querySelector('.collapsible');
M.Collapsible.init(elem, 
{
	accordion: false
});

const openFileProfile = function(event)
{
	const input = event.target;

	const reader = new FileReader();
	reader.onload = () =>
	{
		const dataURL = reader.result;
		const output = document.getElementById('profilePic');
		output.src = dataURL;
	};
	reader.readAsDataURL(input.files[0]);
};

$(document).ready(() =>
{	
	$('#seeMoreProfile').on('click', () =>
	{
		if ($('#seeMore').hasClass('hide-on-med-and-down'))
		{
			$('#seeMore').removeClass('hide-on-med-and-down');
		}
		else
		{
			$('#seeMore').addClass('hide-on-med-and-down');
		}	
	});

	$('.editButton').on('click', function()
	{
		const target = $(this).data('target');
		const target2 = $(this).data('target2');
		$(target).hide(500);
		$(target2).show(500);
	});

	$('.saveButton').on('click', function()
	{
		const target = $(this).data('target');
		const target2 = $(this).data('target2');
		$(target2).hide(500);
		$(target).show(500);
	});

	$('.productsHeader').on('click', () =>
	{
		if ($('.productsBody').hasClass('hide-on-med-and-down'))
		{
			$('.productsBody').removeClass('hide-on-med-and-down');
		}
		else
		{
			$('.productsBody').addClass('hide-on-med-and-down');
		}
	});

	$('.editPost').on('click', function()
	{
		const data = $(this).data('id');
		const data2 = $(this).data('hide');
		$(data).show(500);
		$(data2).hide(500);
		$(this).hide(500);
	});

	$('.cancelEditPost').on('click', function()
	{
		const data = $(this).data('id');
		const data2 = $(this).data('hide');
		const data3 = $(this).data('edit');
		$(data).hide(500);
		$(data2).show(500);
		$(data3).show(500);
	});
});