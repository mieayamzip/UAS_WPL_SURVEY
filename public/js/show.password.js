document.addEventListener("DOMContentLoaded", function () {
    // Login page
    const togglePasswordLogin = document.getElementById("togglePassword");
    const passwordLogin = document.getElementById("password");
    const iconLogin = document.getElementById("iconEye");

    if (togglePasswordLogin && passwordLogin && iconLogin) {
        togglePasswordLogin.addEventListener("click", function () {
            if (passwordLogin.type === "password") {
                passwordLogin.type = "text";
                iconLogin.classList.remove("bi-eye");
                iconLogin.classList.add("bi-eye-slash");
            } else {
                passwordLogin.type = "password";
                iconLogin.classList.remove("bi-eye-slash");
                iconLogin.classList.add("bi-eye");
            }
        });
    }

    // Register page - password
    const togglePasswordRegister = document.getElementById("togglePassword");
    const passwordRegister = document.getElementById("password");
    const iconRegister = document.getElementById("iconEyePassword");

    if (togglePasswordRegister && passwordRegister && iconRegister) {
        togglePasswordRegister.addEventListener("click", function () {
            if (passwordRegister.type === "password") {
                passwordRegister.type = "text";
                iconRegister.classList.remove("bi-eye");
                iconRegister.classList.add("bi-eye-slash");
            } else {
                passwordRegister.type = "password";
                iconRegister.classList.remove("bi-eye-slash");
                iconRegister.classList.add("bi-eye");
            }
        });
    }

    // Register page - confirm password
    const togglePasswordConfirm = document.getElementById(
        "togglePasswordConfirm"
    );
    const passwordConfirm = document.getElementById("password_confirmation");
    const iconConfirm = document.getElementById("iconEyeConfirm");

    if (togglePasswordConfirm && passwordConfirm && iconConfirm) {
        togglePasswordConfirm.addEventListener("click", function () {
            if (passwordConfirm.type === "password") {
                passwordConfirm.type = "text";
                iconConfirm.classList.remove("bi-eye");
                iconConfirm.classList.add("bi-eye-slash");
            } else {
                passwordConfirm.type = "password";
                iconConfirm.classList.remove("bi-eye-slash");
                iconConfirm.classList.add("bi-eye");
            }
        });
    }
});
