
function createDialog (name, point)
{
	let root = document.createElement('dialog');
	root.setAttribute('data-modal-name', name);
	root.style = `
		display: flex;
		width: ${point.X};
		height: ${point.Y};
		z-index: 1;
		position: fixed;
		left: calc(50% - ${point.X} / 2);
		top: calc(50% - ${point.Y} / 2);
		background-color: rgba(255, 255, 255, 0.8);
		border-style: solid;
		border-color: var(--main-light-green);
		border-radius: 1rem;
		border-width: 1rem 0 0 0;
		overflow: auto;
		transition: transform .2s ease;
		margin: 0;
		scrollbar-width: thin;
		box-sizing: border-box;
		box-shadow: rgba(0, 0, 0, 0.25) 0px 0px 2rem;
	`;

	return root;
}

function createBackground ()
{
	let background = document.createElement('div');
	background.style = `
		position: fixed;
		width: 100%;
		height: 100%;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: rgba(45, 45, 45, 0);
		transition: background-color 0.22s ease;
	`;

	setTimeout(() => background.style.backgroundColor = 'rgba(45, 45, 45, .75)', 0);

	return background;
}

export {
	createDialog,
	createBackground
};
