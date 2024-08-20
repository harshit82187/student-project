<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Page</title>
  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">


    <style>
       
        body {
            font-family: Arial, sans-serif;
        }
        .header, .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .main-content {
            margin: 50px auto;
            width: 80%;
            text-align: center;
        }
        .main-content .btn {
            margin-bottom: 20px;
        }
        .table-responsive {
            margin: 20px auto;
        }
        .footer {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <header class="header">
        <h1>Welcome to Our Student Page</h1>
    </header>

    <div class="main-content">
        <a href="#" data-toggle="modal" data-target="#addStudent" class="btn btn-primary">Register</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name ?? '' }}</td>
                        <td>{{ $student->fname ?? '' }}</td>
                        <td>{{ $student->mobile_no ?? '' }}</td>
                        <td>{{ $student->email ?? '' }}</td>
                        <td>{{ $student->dob ?? '' }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#editStudent{{ $student->id }}" class="btn btn-success btn-sm" >Edit</a>
                            <button onclick="changeStatus({{ $student->id }})" class="btn btn-danger btn-sm" >Delete</button>

                        </td>

                    </tr>

{{-- Edit Modal --}}
<div class="modal fade" id="editStudent{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="editStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update') }}" method="POST" >
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $student->id }}">

                    <div class="col-md-12">
                        <label style="margin-right: 521px;">Name</label>
                        <input  class="form-control" onkeyup="validateAlphabeticalInput(this)" placeholder="Enter your name" type="text" name="name" value="{{ $student->name ?? '' }}" required>
                    </div>
        
                    <div class="col-md-12">
                        <label style="margin-right: 521px;">Father Name</label>
                        <input  class="form-control" onkeyup="validateAlphabeticalInput(this)" placeholder="Enter your name" type="text" name="fname"  value="{{ $student->fname ?? '' }}" required>
                    </div>
        
                    <div class="col-md-12">
                        <label style="margin-right: 521px;">Mobile No</label>
                        <input  class="form-control" onkeyup="validateNumericInput(this)" placeholder="Enter your name" type="number" name="mobile_no"  value="{{ $student->mobile_no ?? '' }}" required>
                    </div>
        
                    <div class="col-md-12">
                        <label style="margin-right: 521px;">Email</label>
                        <input  class="form-control" placeholder="Enter your email" type="email" name="email"  value="{{ $student->email ?? '' }}" required>
                    </div>
        
                    <div class="col-md-12">
                        <label style="margin-right: 521px;">DOB</label>
                        <input  class="form-control" type="date" name="dob"  value="{{ $student->dob ?? '' }}" required>
                    </div>
        
                    
        
                    
                    </div>

            
            
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
                    @endforeach
                 
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; {{  date('Y'); }}  All rights reserved.</p>
    </footer>

 
  <div class="modal fade" id="addStudent" tabindex="-1" role="dialog" aria-labelledby="addStudentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('register') }}" method="POST" >
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <label>Name</label>
                        <input  class="form-control" onkeyup="validateAlphabeticalInput(this)" placeholder="Enter your name" type="text" name="name" required>
                    </div>
        
                    <div class="col-md-12">
                        <label>Father Name</label>
                        <input  class="form-control" onkeyup="validateAlphabeticalInput(this)" placeholder="Enter your name" type="text" name="fname" required>
                    </div>
        
                    <div class="col-md-12">
                        <label>Mobile No</label>
                        <input  class="form-control" onkeyup="validateNumericInput(this)" placeholder="Enter your name" type="number" name="mobile_no" required>
                    </div>
        
                    <div class="col-md-12">
                        <label>Email</label>
                        <input  class="form-control" placeholder="Enter your email" type="email" name="email" required>
                    </div>
        
                    <div class="col-md-12">
                        <label>DOB</label>
                        <input  class="form-control" type="date" name="dob" required>
                    </div>
        
                   
        
                    
                  </div>

           
          
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
       </form>
      </div>
    </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    @if (Session::has('success') || Session::has('error') || $errors->any())
    <script>
        @if (Session::has('success'))
            var messageType = 'success';
            var messageColor = 'green';
            var message = "{{ Session::get('success') }}";
        @elseif (Session::has('error'))
            var messageType = 'warning';
            var messageColor = 'orange';
            var message = "{{ Session::get('error') }}";
        @elseif ($errors->any())
            var messageType = 'error';
            var messageColor = 'red';
            var message = @json($errors->all());
        @endif

        if (Array.isArray(message)) {
            message.forEach(function (msg) {
                iziToast[messageType]({
                    message: msg,
                    position: 'topRight',
                    timeout: 4000,
                    displayMode: 0,
                    color: messageColor,
                    theme: 'light',
                    messageColor: 'black',
                });
            });
        } else {
            iziToast[messageType]({
                message: message,
                position: 'topRight',
                timeout: 4000,
                displayMode: 0,
                color: messageColor,
                theme: 'light',
                messageColor: 'black',
            });
        }
    </script>
    @endif

    <script>
        $(document).ready(function (){
            $('#dataTable').DataTable();
        });
    </script>

    <script>
         function validateAlphabeticalInput(input) {
            input.value = input.value.replace(/[^A-Z a-z]/g, '');
        }

        function validateNumericInput(input) {		
            input.value = input.value.replace(/[^0-9]/g, '');		
            input.value = input.value.slice(0, 10);
        }

    </script>

    
<script>
    function changeStatus(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText:'Delete ',
            customClass: {
                popup: 'swal2-large',
                content: 'swal2-large'
            }
        }).then((result) => {
            if (result.isConfirmed) {
				window.location.href = "{{ url('delete') }}/" +id;				
                console.log("Harshit");
            }
        });
    }
</script>

       
</body>
</html>
