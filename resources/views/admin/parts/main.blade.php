<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.parts.head')
</head>

<body>
    <!-- Sidebar -->
    <section class="sidebar">
       @include('admin.parts.sidebar')
        </div>
    </section>
    <!-- End Sidebar -->

    <!-- Main -->
    <section class="main">
     @include('admin.parts.header')
        <div class="main-content">
            <div class="main-content-title">
                <h3>{{ isset($title) ? $title : "Dashboard" }}</h3>
            </div>
        </div>
        <div class="admin-content-main-content">
            @yield('content')
        </div>
    </section>
    <!-- End Main -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<footer> @include('admin.parts.footer')   </footer>
</body>

</html>