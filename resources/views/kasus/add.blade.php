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
                    <form action="{{route('kasus.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Penyakit</th>
                                        <th>Gejala</th>
                                        <th>Bobot</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="form-control @error('penyakit') is-invalid @enderror" name="inputs[0][penyakit]" value="{{ old('penyakit') }}" >
                                                @forelse ($penyakits as $penyakit)
                                                    <option value="{{$penyakit->kode}}">{{$penyakit->name}}</option>
                                                    @empty
                                                    <option>kosong</option>
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control @error('gejala') is-invalid @enderror" name="inputs[0][gejala]" value="{{ old('gejala') }}" >
                                                @forelse ($gejalas as $gejala)
                                                    <option value="{{$gejala->kode}}">{{$gejala->name}}</option>
                                                    @empty
                                                    <option>kosong</option>
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input id="myRange" type="range" max="10" min="1" value="1" class="form-control @error('bobot') is-invalid @enderror" name="inputs[0][bobot]" value="{{ old('bobot') }}">
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class=" btn btn-tool" id="add">
                                                Tambah 
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Penyakit</th>
                                        <th>Gejala</th>
                                        <th>Bobot</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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
    {{-- <script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;
        
        slider.oninput = function() {
          output.innerHTML = (this.value / 10);
        }
    </script>         --}}
    <script>
    var i = 0;
    document.getElementById("add").onclick = function() {myAdd()};
    function myAdd() {
        ++i;
        $('.table').append(
                `<tr id = "t1">
                    <td>
                        <select class="form-control @error('penyakit') is-invalid @enderror" name="inputs[`+i+`][penyakit]" value="{{ old('penyakit') }}" >
                            @forelse ($penyakits as $penyakit)
                                <option value="{{$penyakit->kode}}">{{$penyakit->name}}</option>
                                @empty
                                <option>kosong</option>
                            @endforelse
                        </select>
                    </td>
                    <td>
                        <select class="form-control @error('gejala') is-invalid @enderror" name="inputs[`+i+`][gejala]" value="{{ old('gejala') }}" >
                            @forelse ($gejalas as $gejala)
                                <option value="{{$gejala->kode}}">{{$gejala->name}}</option>
                                @empty
                                <option>kosong</option>
                            @endforelse
                        </select>
                    </td>
                    <td>
                        <div class="form-group">
                            <input id="myRange" type="range" max="10" min="1" class="form-control @error('bobot') is-invalid @enderror" name="inputs[`+i+`][bobot]" value="{{ old('bobot') }}"  id="exampleInputBobot" placeholder="Enter Gejala">
                        </div>
                    </td>
                    <td>
                        <button type="button" class=" btn btn-tool remove-table-row" onclick="remove(this)">
                            Hapus
                            <i class="fas fa-minus"></i>
                        </button>
                    </td>
                </tr>`);
    }
    function remove(that) {
        that.parentNode.parentNode.remove();
    }
    </script>
@endsection  