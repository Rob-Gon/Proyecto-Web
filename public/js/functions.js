/**
 * Show & hide password
 */
function togglePassword() {
    var password = document.getElementById("password");
    var hidePassword = document.getElementById("iconHidePassword");
    var showPassword = document.getElementById("iconShowPassword");
    if (password.type === "password") {
        password.type = "text";
        showPassword.style.display = "inline";
        hidePassword.style.display = "none";
    } else {
        password.type = "password";
        hidePassword.style.display = "inline";
        showPassword.style.display = "none";
    }
}

/**
 * User validation & operations
 */

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function checkEmailAvailability(email) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response["available"] === false) {
                alert("El correo electrónico ya está en uso. Por favor, elija otro.");
                return false;
            }
        }
    };
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var params = "email=" + email;
    xhttp.open("post", "check-email", true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}

function register() {
    var user = document.getElementById("user").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errorMessage = "";

    if (user.length === 0) {
        errorMessage += "Por favor, ingrese un usuario.\n";
    } else if (user.length > 255) {
        errorMessage += "El usuario no puede tener más de 255 caracteres.\n";
    }

    if (email.length === 0) {
        errorMessage += "Por favor, ingrese un email.\n";
    } else if (email.length > 255) {
        errorMessage += "El email no puede tener más de 255 caracteres.\n";
    } else if (!isValidEmail(email)) {
        errorMessage += "Por favor, ingrese un email válido.\n";
    }  else if (checkEmailAvailability(email) === false) {
        errorMessage += "El correo electrónico ya está en uso. Por favor, elija otro.\n";
    }

    if (password.length === 0) {
        errorMessage += "Por favor, ingrese una contraseña.\n";
    } else if (password.length < 6) {
        errorMessage += "La contraseña debe tener al menos 6 caracteres.\n";
    } else if (password.length > 255) {
        errorMessage += "La contraseña no puede tener más de 255 caracteres.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response["register"] !== true) {
                alert(
                    "No se pudo completar el registro. Por favor, inténtelo de nuevo."
                );
            } else {
                alert("Registro realizado con éxito");
                window.location.href = "/login";
            }
        }
    };
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var user = document.getElementById("user").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var is_premium = document.getElementById("isPremium").checked ? 1 : 0;
    var params = "user=" + user + "&email=" + email + "&password=" + password + "&is_premium=" + is_premium;
    xhttp.open("post", "register", true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
    return false;
}

function login() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errorMessage = "";

    if (email.length === 0) {
        errorMessage += "Por favor, ingrese un email.\n";
    } else if (email.length > 255) {
        errorMessage += "El email no puede tener más de 255 caracteres.\n";
    } else if (!isValidEmail(email)) {
        errorMessage += "Por favor, ingrese un email válido.\n";
    } 

    if (password.length === 0) {
        errorMessage += "Por favor, ingrese una contraseña.\n";
    } else if (password.length < 6) {
        errorMessage += "La contraseña debe tener al menos 6 caracteres.\n";
    } else if (password.length > 255) {
        errorMessage += "La contraseña no puede tener más de 255 caracteres.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            if (response["login"] !== true) {
                alert("No se pudo iniciar la sesión. Por favor, inténtelo de nuevo.");
            } else {
                alert("Sesión iniciada con éxito");
                window.location.href = "/language";
            }
        }
    };
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var params = "email=" + email + "&password=" + password;
    xhttp.open("post", "login", true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", token);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
    return false;
}

function logout() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response["logout"] === true) {
                    alert("Sesión cerrada con éxito");
                    window.location.href = "/login";
                } else {
                    alert("No se pudo cerrar la sesión. Por favor, inténtelo de nuevo.");
                }
            } else {
                alert("Error al cerrar la sesión. Por favor, inténtelo de nuevo.");
            }
        }
    };
    xhttp.open("get", "/logout", true);
    xhttp.send();
}

/**
 * Form validations
 */

function validateWordCreate() {
    var word = document.getElementById("word").value;
    var example = document.getElementById("example").value;
    var category_id = document.getElementById("category_id").value;
    var translation = document.getElementById("translation").value;
    var errorMessage = "";

    if (word.length === 0) {
        errorMessage += "Por favor, ingrese una palabra.\n";
    } else if (word.length > 255) {
        errorMessage += "La palabra no puede tener más de 255 caracteres.\n";
    }

    if (example.length > 255) {
        errorMessage += "El ejemplo no puede tener más de 255 caracteres.\n";
    }

    if (!category_id) {
        errorMessage += "Por favor, ingrese una categoría.\n";
    }

    if (translation.length === 0) {
        errorMessage += "Por favor, ingrese una traducción.\n";
    } else if (translation.length > 255) {
        errorMessage += "La traducción no puede tener más de 255 caracteres.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    document.getElementById("wordCreateForm").submit();
}

function validateWordUpdate() {
    var word = document.getElementById("word").value;
    var example = document.getElementById("example").value;
    var category_id = document.getElementById("category_id").value;
    var errorMessage = "";

    if (word.length === 0) {
        errorMessage += "Por favor, ingrese una palabra.\n";
    } else if (word.length > 255) {
        errorMessage += "La palabra no puede tener más de 255 caracteres.\n";
    }

    if (example.length > 255) {
        errorMessage += "El ejemplo no puede tener más de 255 caracteres.\n";
    }

    if (!category_id) {
        errorMessage += "Por favor, ingrese una categoría.\n";
    }

    var translations = document.querySelectorAll('input[name^="translations"]');
    translations.forEach(function(translationInput) {
        var translationValue = translationInput.value;
        if (translationValue.length === 0) {
            errorMessage += "Por favor, ingrese una traducción.\n";
        } else if (translationValue.length > 255) {
            errorMessage += "La traducción no puede tener más de 255 caracteres.\n";
        }
    });

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    document.getElementById("wordUpdateForm").submit();
}

function validateCategory() {
    var category = document.getElementById("category").value;
    var color = document.getElementById("color").value;
    var errorMessage = "";

    if (category.length === 0) {
        errorMessage += "Por favor, ingrese una categoría.\n";
    } else if (category.length < 3) {
        errorMessage += "La categoría no puede tener menos de 3 caracteres.\n";
    } else if (category.length > 255) {
        errorMessage += "La categoría no puede tener más de 255 caracteres.\n";
    }

    if (color.length !== 7) {
        errorMessage += "Por favor, seleccione un color.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    document.getElementById("categoryForm").submit();
}