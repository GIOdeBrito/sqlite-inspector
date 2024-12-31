
function createStyle (text)
{
	let tag = document.createElement('style');
	tag.type = "text/css";

	tag.innerText = text;

	document.head.appendChild(tag);

	return tag;
}

export default createStyle;
