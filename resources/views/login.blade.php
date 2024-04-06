<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Page</title>
  </head>
  <body>

	<section>
		<div class="container mt-5 pt-5">
			<div class="row">
				<div class="col-12 col-sm-8 col-md-6 m-auto">
					<div class="card border-0 shadow" style="background-color: #343a40;">
						<div class="card-body">
							<svg class="d-block mx-auto my-3 text-white" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
								<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
							</svg>
							<form class="mx-4" action="">
								<div class="input-box">
									<label for="email" class="text-white">Email</label>
									<input type="text" id="email" name="email"` class="form-control" onblur="validateEmail()" oninput="deleteMessage()" required>
									<span id="emailError" style="font-size: 0.8em; color: rgb(255, 68, 68); font-style: italic; border: solid 1px transparent;"></span>
								</div>
								<div class="input-box">
									<label for="password" class="text-white">Mot de passe</label>
									<input type="password" type="password" id="password" class="form-control" required>
								</div>
								<div class="text-center mt-3">
									<button class="btn btn-primary rounded-pill">Se connecter</button>
									<a class="d-block px-3 py-2 text-decoration-none text-white" href="#">Mot de passe oublié ?</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		function validateEmail() {
			const emailInput = document.getElementById('email');
			const email = emailInput.value.trim();
			const errorSpan = document.getElementById('emailError');
	
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	
			if (!emailRegex.test(email)) {
				errorSpan.innerText = 'Veuillez entrer une adresse email valide. example@email.com';
				emailInput.style.border = "solid 1px red";
			} else {
					errorSpan.textContent = ''; // Effacer le message d'erreur s'il est valide
			}
		}
	
		function deleteMessage() {
				const errorSpan = document.getElementById('emailError');
	
				errorSpan.textContent = '';
		}
	</script>
  </body>
</html>
