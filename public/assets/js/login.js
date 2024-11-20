const { origin: base_url } = window.location;

window.addEventListener('load', function () {
  captchaLoad();
}, false);

async function captchaLoad() {
	try {
		  document.getElementById('loginbtn').disabled = true;
		  document.getElementById('captcha_img').innerHTML = `loading...`
		  document.getElementById('captcha').classList.add("hidden");
		  document.getElementById('key').value = '';

		  const response = await fetch(`${base_url}/captcha/api/default`);
		  const captcha = await response.json();
		  document.getElementById('key').value = captcha.key;
		  document.getElementById('captcha_img').innerHTML = `<img src='${captcha.img}' alt='loading...' />&nbsp;&nbsp;<button title="click here to regenerate captcha" class="btn btn-xs" onClick="captchaLoad()" type='button'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 4v6h-6M1 20v-6h6" /><path d="M3.51 15a9 9 0 1 0 1.13-9.36L1 10" /></svg></button>`;
		  document.getElementById('captcha').classList.remove("hidden");
		  document.getElementById('loginbtn').disabled = false;
		} 
	catch (error) {
		  // TypeError: Failed to fetch
		  console.log('There was an error', error);
	}
}