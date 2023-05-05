<div class="col-md-2 bg-light sidebar shadow-box">
    <a href="/" class="link-dark text-decoration-none">
        <p class="text-center fs-4 pt-3">DS-Timesheet</p>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/timesheets" class="nav-link link-dark">Timesheets</a>
        </li>
        <li>
            <a href="/users" class="nav-link link-dark">Users</a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">Tools</a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">Requests</a>
        </li>
        <li>
            <a href="#" class="nav-link link-dark">Company</a>
        </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var currentPath = window.location.pathname;
        $('.sidebar a').each(function() {
            if (currentPath.includes($(this).attr('href'))) {
                $(this).addClass('active');
            }
        });
    });
</script>