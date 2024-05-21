<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Login';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')
    <div class="vh-10">
    </div>
    <div class="min-vh-100 py-5">
        <div class="text-center py-5">
            <h1>Login</h1>
            <h2>Log in your account</h2>
        </div>
        <div class="row justify-content-center p-2">
            <div class="col-8 col-md-6">
                <form method="get" action="login.html">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold" for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold" for="password">Password</label>
                        <input class="form-control" type="email" id="email-1" name="password" placeholder="Email Address">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-dark rounded-pill btn-md" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.student.footer')
</body>

</html>
