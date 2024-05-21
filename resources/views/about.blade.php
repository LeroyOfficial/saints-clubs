<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'About';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="bg-cream min-vh-100 py-5">
        <div data-aos="fade-down" class="text-center">
            <h1>Saints Club at a glance</h1>
            <p>As a research university and nonprofit institution, Saints Club is focused on creating educational opportunities for people from many lived experiences.</p>
        </div>
        <div class="row">
            <div data-aos="fade-right" class="col-md-6 text-center">
                <img src="{{asset('assets/img/971bd135-8dcd-4262-ad98-735b356e8321.svg')}}">
            </div>
            <div data-aos="fade-left" class="col-md-6">
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2021</h3>
                    <p>Saints Club was established</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2022</h3>
                    <p>reached 100+ clubs</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2023</h3>
                    <p>reached 500 students</p>
                </div>
                <div class="p-2 mb-4 shadow-sm">
                    <h3 class="fw-bold">2024</h3>
                    <p>reached 1000 students</p>
                </div>
            </div>
        </div>
    </div>

    @include('components.student.footer')
</body>

</html>
