@extends('home')
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Update Data User</h3>
                    </div>
                    <!-- form start -->
                    <form action="{{route('user.update',$post->id)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName1">Nama pengguna</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $post->name) }}"  id="exampleInputName1" placeholde r="Enter nama pengguna">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $post->email) }}"  id="exampleInputEmail1" placeholde r="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password', $post->password) }}"  id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Pilih Level</label>
                            <select class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level', $post->level) }}" >
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" name="image" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                        @error('image')
                                            <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
                    </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection  