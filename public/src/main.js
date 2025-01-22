
import Modal from "./components/modal.js";
import FileUploader from "./components/file-uploader.js";

window.onload = () =>
{
	let modal = new Modal('welcome', 'welcome', 500, 350);

	modal.onload = () =>
	{
		const options = {
			accepts: ["application/octet-stream"],
			url: "/api/v1/sendfile/test",
			sendoninput: true
		};

		let uploader = new FileUploader(modal.root.querySelector('div[data-file-uploader]'), options);

		console.log(uploader);

		uploader.onbeforesend = () => console.log("boefroeeee");
	};
};

