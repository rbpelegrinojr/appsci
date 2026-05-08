<?php include 'header.php'; ?>
<!-- Page Header -->

<!-- Registration Form -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Create an Account</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <form action="controller/process.php" method="POST">
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" readonly="" value="VI" class="form-control" id="grade" name="grade" placeholder="Last Name" required>
                                    <label for="grade">Grade</label>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="section" name="section" placeholder="Last Name" required>
                                    <label for="section">Section</label>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="btnReg" type="submit">Register</button>
                            </div>

                            <!-- Already Have an Account -->
                            <div class="col-12 text-center">
                                <p>Already have an account? <a href="login_view.php" class="btn btn-outline-primary">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
