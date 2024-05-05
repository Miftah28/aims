<script>
    document.addEventListener("DOMContentLoaded", function () {
        var roleSelect = document.getElementById("role-create");
        var instansiInput = document.getElementById("instansi");

        roleSelect.addEventListener("change", function () {
            if (this.value === "admin") {
                instansiInput.parentElement.style.display = "block";
                instansiInput.required = true; // Menjadikan required saat opsi admin dipilih
            } else {
                instansiInput.parentElement.style.display = "none";
                instansiInput.required = false; // Menghapus required saat opsi selain admin dipilih
            }
        });

        // Inisialisasi status tampilan saat halaman dimuat
        if (roleSelect.value === "admin") {
            instansiInput.parentElement.style.display = "block";
            instansiInput.required = true; // Menjadikan required saat halaman dimuat dengan opsi admin terpilih
        } else {
            instansiInput.parentElement.style.display = "none";
            instansiInput.required = false; // Menghapus required saat halaman dimuat dengan opsi selain admin terpilih
        }
    });
</script>
{{-- <script>
        var passwordField = document.getElementById("new_password{{ $akuns->id }}");
        var confirmPasswordField = document.getElementById("password-confirm{{ $akuns->id }}");
        var confirmPasswordError = document.getElementById("password-error{{ $akuns->id }}");
        var submitButton = document.getElementById("submitButton");

        function validatePassword() {
            if (passwordField.value !== confirmPasswordField.value) {
                if(passwordField.value !== '' && confirmPasswordField.value == ''){
                    confirmPasswordError.innerText = "Konfirmasi password belum diisi.";
                    confirmPasswordError.style.display = "block";
                    confirmPasswordField.classList.add("is-invalid");
                    confirmPasswordField.required = true; 
                    submitButton.disabled = true;
                    return false;
                }else{
                    confirmPasswordError.innerText = "Konfirmasi password tidak cocok.";
                    confirmPasswordError.style.display = "block";
                    confirmPasswordField.classList.add("is-invalid");
                    submitButton.disabled = true;
                    return false;
                }
                
            }else{
                confirmPasswordError.style.display = "none";
                confirmPasswordField.classList.remove("is-invalid");
                submitButton.disabled = false;
                confirmPasswordField.required = false; 
                return true;
            }
        }
        
        confirmPasswordField.addEventListener("keyup", validatePassword);
</script> --}}
