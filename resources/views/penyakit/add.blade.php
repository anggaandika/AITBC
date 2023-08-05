@extends('home')
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Input Data User</h3>
                    </div>
                    <!-- form start -->
                    <form action="{{route('penyakit.store')}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputName">Kode</label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}"  id="exampleInputKode" placeholder="Input Kode Penyakit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  id="exampleInputName" placeholder="Input Nama Penyakit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDeskripsi">Deskripsi</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}"  id="exampleInputDeskripsi" placeholder="Input Deskripsi">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSolusi">Solusi</label>
                            <input type="text" class="form-control @error('solusi') is-invalid @enderror" name="solusi" value="{{ old('solusi') }}"  id="exampleInputSolusi" placeholder="Input Solusi">
                        </div>
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