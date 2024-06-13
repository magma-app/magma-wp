window.addEventListener('load', () => {
	const form = document.querySelector('.connect');
	const input = form.querySelector('#campaign-id');

	// A la connexion, on vérifie si le formulaire est bien rempli
	form.addEventListener('submit', async (e) => {
		e.preventDefault();
		const campaignId = input.value;

		const url = `https://v3.api.magma.app/api/integration/${campaignId}`;

		const response = await fetch(url);
		const data = await response.json();

		if (data.error) {
			const errorMessage = document.querySelector('.error-connect');
			errorMessage.textContent = data.message;
			return;
		}

		const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
		hiddenInputs.forEach((hide) => {
			switch (hide.id) {
				case 'magma_widget_top_left':
					const integration = data.find((item) => item.position === 'top_left');
					if (integration) {
						hide.value = integration.uuid;
					}
					break;
				case 'magma_widget_top_right':
					const integration1 = data.find(
						(item) => item.position === 'top_right'
					);
					if (integration1) {
						hide.value = integration1.uuid;
					}
					break;
				case 'magma_widget_bottom_left':
					const integration2 = data.find(
						(item) => item.position === 'bottom_left'
					);
					if (integration2) {
						hide.value = integration2.uuid;
					}
					break;
				case 'magma_widget_bottom_right':
					const integration3 = data.find(
						(item) => item.position === 'bottom_right'
					);
					if (integration3) {
						hide.value = integration3.uuid;
					}
					break;
				case 'magma_widget_banner_top':
					const integration4 = data.find((item) => item.position === 'top');
					if (integration4) {
						hide.value = integration4.uuid;
					}
					break;
				case 'magma_widget_banner_bottom':
					const integration5 = data.find((item) => item.position === 'bottom');
					if (integration5) {
						hide.value = integration5.uuid;
					}
					break;
				case 'magma_widget_block':
					const integration6 = data.find((item) => item.type === 'block');
					if (integration6) {
						hide.value = integration6.uuid;
					}
					break;
			}
		});

		form.submit();
	});
});
