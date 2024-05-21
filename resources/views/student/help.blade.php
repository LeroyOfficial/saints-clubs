<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    @php
        $page_title = 'Help';
    @endphp
    @include('components.student.css')
</head>

<body>
    @include('components.student.nav')

    <div class="bg-cream min-vh-100 py-5 mt-5">
        <div class="py-4"></div>
        <div data-aos="fade-down" class="text-center">
            <h1>Help</h1>
            <p>you can see how to use the system</p>
        </div>
        <div class="min-vh-100">
            <div id="questions" class="mb-5 min-vh-100">
                <h2>Questions</h2>
                <a href="#register-answer" class="fs-4 fw-bold mb-2 text-capitalizer">
                    <h4>
                    How do I register for an account?
                    </h4>
                </a>
                <a href="#events-answer" class="fs-4 fw-bold mb-2 text-capitalizer">
                    <h4>
                    How do I view upcoming events?
                    </h4>
                </a>
                <a href="#cancel-answer" class="fs-4 fw-bold mb-2 text-capitalizer">
                    <h4>
                    I registered for an event but can no longer attend.
                    </h4>
                </a>
                <a href="#announcement-answer" class="fs-4 fw-bold mb-2 text-capitalizer">
                    <h4>
                    Where can I find announcements or important updates from club administrators?
                    </h4>
                </a>
            </div>
            <div id="answers" class="mb-5 min-vh-100">
                <h2>Answers</h2>
                <p id="register-answer" class="fw-bold mb-2">Click on "sign up" and follow the prompts.</p>
                <p id="events-answer" class="fw-bold mb-2">Go to the "Events" section to see upcoming events.</p>
                <p id="cancel-answer" class="fw-bold mb-2">Visit the event page and click on "Leave club."</p>
                <p id="cancel-answer" class="fw-bold mb-2">Navigate to the member's profile and click on "Send Message."</p>
            </div>
        </div>
    </div>

    @include('components.student.footer')
</body>

</html>
