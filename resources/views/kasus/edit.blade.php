@extends('home')
@section('contents')
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Input Data Gejala Penyakit</h3>
                    </div>
                    <!-- form start -->
                    <form action="{{route('kasus.store')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Level</label>
                            <select class="form-control @error('gejala') is-invalid @enderror" name="gejala" value="{{ old('gejala') }}" >
                                @forelse ($gejalas as $gejala)
                                    <option value="{{$gejala->kode}}">{{$gejala->name}}</option>
                                    @empty
                                    <option>kosong</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Level</label>
                            <select class="form-control @error('penyakit') is-invalid @enderror" name="penyakit" value="{{ old('penyakit') }}" >
                                @forelse ($penyakits as $penyakit)
                                    <option value="{{$penyakit->kode}}">{{$penyakit->name}}</option>
                                    @empty
                                    <option>kosong</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBobot">Bobot</label>
                            <input type="text" class="form-control @error('bobot') is-invalid @enderror" name="bobot" value="{{ old('bobot',$post->bobot) }}"  id="exampleInputBobot" placeholde r="Enter Gejala">
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