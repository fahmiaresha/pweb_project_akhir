<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{ asset('asset/admin/img/unair.png') }}">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Lupa Password</title>

    <!-- Custom fonts for this template-->

  <link href="{{ asset('asset/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('asset/admin/css/sb-admin-2.min.css') }}" rel="stylesheet"> 
  


  <!-- Sweet Alert-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

 <!-- Search 2-->
 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
 
  
   <!-- Toast-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> 
  
  <!-- ck editor -->
   <script src="{{ asset('asset/ckeditor/ckeditor.js')}}"></script>

   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
  />
  

    <!-- show password -->
  
</head>

<body>
@if(session('email_tdk_ada'))
      <font size="4"> 
      <script>
     Swal.fire({
          timer: 2000,
          icon: 'error',
          title: 'Oops',
          text: 'Email Tidak Terdaftar !',
        })
    </script>
    </font>
@endif

@if(session('user_tdk_ada'))
      <font size="4"> 
      <script>
     Swal.fire({
          timer: 2000,
          icon: 'error',
          title: 'Oops',
          text: 'Username Tidak Terdaftar !',
        })
    </script>
    </font>
@endif

@if(session('get_pass'))
      <font size="4"> 
      <script>
     Swal.fire({
        //   timer: 2000,
          icon: 'success',
          title: 'Password Anda',
          text: "{{ @session('get_pass') }}",
        })
    </script>
    </font>
@endif
<div class="container">
    <br>
    <br>
    
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <strong><font size="5" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Lupa Password</font></strong>
                 
                      
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/getpassword">
                           
                            @csrf
                    
                            <div class="form-group row"  >
                        <label for="email" class="col-md-4 col-form-label text-md-left" ><font size="4" style="font-family: Arial, Helvetica, sans-serif;">Email</font></label>

                        <div class="col-md-6 input-group" >
                            <input id="email" type="text" placeholder="youremail@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong><font size="2">{{ $message }}</font></strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-left"><font size="4" style="font-family: Arial, Helvetica, sans-serif;">Username</font></label>
                                <div class="col-md-6 input-group" >
                                <input id="username" type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username" >
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font size="2">{{ $message }} </font></strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                   
                    
                         


                    

                   

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Get Password
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  
  
</body>
  <!-- End of Page Wrapper -->

  
  
  


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <!-- <script src="./src/bootstrap-input-spinner.js"></script> -->
    <script src="{{ asset('asset/admin/vendor/jquery/jquery.min.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
  

  <!-- Bootstrap core JavaScript-->

  
  <script src="{{ asset('asset/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('asset/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('asset/admin/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <!-- <script src="{{ asset('asset/admin/vendor/chart.js/Chart.min.js') }}"></script> -->

  <!-- Page level custom scripts -->
  <!-- <script src="{{ asset('asset/admin/js/demo/chart-area-demo.js') }}"></script> -->
  <!-- <script src="{{ asset('asset/admin/js/demo/chart-pie-demo.js') }}"></script> -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->

   <!-- toast -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 
  
    </html>



 