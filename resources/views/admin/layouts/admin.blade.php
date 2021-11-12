<!DOCTYPE html>
<html lang="en">
   <head>
      @include('admin.includes.head')
   </head>
   <body>
      <div class="container-scroller">
         <!-- partial:../../partials/_navbar.html -->
         @include('admin.includes.navbar')
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            @include('admin.includes.sidebar')
            <!-- partial -->
            <div class="main-panel">
               <div class="content-wrapper">
                  @yield('content')
               </div>
               <!-- content-wrapper ends -->
               <!-- partial:../../partials/_footer.html -->
               @include('admin.includes.footer')
               <!-- partial -->
            </div>
            <!-- main-panel ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>

      @include('admin.includes.script')
   </body>
</html>