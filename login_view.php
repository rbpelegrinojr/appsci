<?php include 'header.php'; ?>
<!-- Contact Start -->
<style>
  .password-wrapper {
    position: relative;
  }

  .password-wrapper input[type="password"],
  .password-wrapper input[type="text"] {
    padding-right: 2.5rem; /* space for the eye icon */
  }

  .toggle-password {
    position: absolute;
    top: 50%;
    right: 0.75rem;
    transform: translateY(-50%);
    cursor: pointer;
    user-select: none;
    font-size: 1.25rem;
    color: #555;
  }
</style>
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <form action="controller/process.php" method="POST">
                        <div class="row g-3">
                            <!-- Username Field -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            
                            <!-- Password Field -->
                            
                            <div class="col-12">
                                <div class="form-floating password-wrapper">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    <span class="toggle-password" onclick="togglePassword()" title="Show/Hide Password">
                                    👁️
                                    </span>
                                </div>
                                </div>


                            <!-- Login Button -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="btnLogin" type="submit">Login</button>
                            </div>

                            <!-- Register Button -->
                            <div class="col-12 text-center">
                                <p>Don't have an account? <a href="register_view.php" class="btn btn-outline-primary">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  function togglePassword() {
    const pwInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-password');

    if (pwInput.type === 'password') {
      pwInput.type = 'text';
      toggleIcon.textContent = '🙈';  // Change icon to closed eye
    } else {
      pwInput.type = 'password';
      toggleIcon.textContent = '👁️';  // Change icon to open eye
    }
  }
</script>
<?php include 'footer.php'; ?>