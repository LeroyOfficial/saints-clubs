<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Sign up';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="vh-10">
    </div>
    <div class="min-vh-100 py-5">
        <div class="text-center py-5">
            <h1>Sign Up</h1>
            <h2>Create An Account</h2>
        </div>
        <div class="row justify-content-center p-2">
            <div class="col-8 col-md-6">
                <form method="get" action="login.html">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="first_name">First Name</label>
                            <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name" required="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="last_name">Last Name</label>
                            <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Last Name" required="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Gender</label>
                            <div class="d-flex justify-content-evenly">
                                <div>
                                    <label class="form-label fw-bold me-1" for="male">Male</label>
                                    <input type="radio" id="male" name="gender" value="male" required="">
                                </div>
                                <div>
                                    <input type="radio" id="female" name="gender" value="female" required="">
                                    <label class="form-label fw-bold ms-1" for="female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="class">Class</label>
                            <select class="form-select" id="class" name="class" required="">
                                <option value="" selected="">Choose your class</option>
                                <option value="Form 1">Form 1</option>
                                <option value="Form 2">Form 2</option>
                                <option value="Form 3">Form 3</option>
                                <option value="form 4">Form 4</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="email">Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" required="">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required="">
                            <input class="form-control mt-3 d-none" type="password" id="password_confirmation" name="password" placeholder="Password Confirmation" required="">
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark rounded-pill btn-md" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.student.footer')
</body>

</html>
