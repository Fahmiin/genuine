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