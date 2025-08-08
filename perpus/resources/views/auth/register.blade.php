<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}" type="text/css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>REGISTER</title>
    <style>
      body {
        background-image: url(image/12.jpg);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
      }
     
      </style>
  </head>
  <body>
    @if (session('status'))
        <div class="alert alert-success" style="background: #d4edda; padding: 10px; color: #155724; margin: 10px;">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" style="background: #f8d7da; padding: 10px; color: #721c24; margin: 10px;">
            {{ session('error') }}
        </div>
    @endif
    <div class="box">
      <div class="container">
        <form class="form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            {{csrf_field() }}
          <div class="top">
            <header>REGISTER</header>
          </div>

          <div class="input-field">
            <input type="text" class="input" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama" required />
            <i class="bx bx-plus bx-spin bx-sm"></i>
          </div>
          <div class="input-field">
            <input type="text" class="input" name="username" value="{{ old('nama') }}" placeholder="Masukkan Username" required />
            <i class="bx bx-plus bx-spin bx-sm"></i>
          </div>
          <div class="input-field">
            <input type="password" class="input" name="password" placeholder="Masukkan Password" required />
            <i class="bx bx-plus bx-spin bx-sm"></i>
          </div>

          <div class="input-field">
                <input type="file" name="foto"/>
              </div>

              <div class="input-field">
                <tr class = "pilih">
                  <td class="button1" >
                    <a href="/"> <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 75px; text-align:center; vertical-align:middle; " ><span class="glyphicon glyphicon-remove" style="font-size : 17px; color:black;"></span> Cancel</button> </a>
                  </td>  
                  <td class="button1" >
                    <input type="reset" name="batal" value="Reset" class="btn" style="width: 75px; text-align:center; vertical-align:middle">
                  </td>
                  <td class="button1">
                    <button type="submit" class="btn btn-primary" style="width: 70px; text-align:center; vertical-align:middle; "><span class="glyphicon glyphicon-floppy-disk" style="height: 50;font-size : 17px; ">Save</span> </button>
                  </td>
                </tr>
              </div>

          
        </form>
      </div>
    </div>
  </body>
</html>