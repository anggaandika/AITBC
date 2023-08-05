@extends('home')
@section('contents')
<form action="{{ route('konsul.post') }}" method="post">
  @csrf
  <section class="content">
    <div class="container">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable {{ucfirst(Request::segment(1))}}</h3>
                <div class="card-tools">
                  <button type="submit" class="btn btn-tool">
                    <i class="fas fa-save"></i>
                    <b>Mengecek</b>
                  </button>
                </div>  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Gejala</th>
                      <th align="center">Jika Iya</th>
                    </tr>
                  </thead>
                  
                  <tbody>  
                  @forelse ($posts as $key => $post)
                  <input type="text" style="border-color: transparent" name="inputs[{{$key}}][bobot]" value="{{ old('name',$post->bobot) }}">
                    <tr>
                      <td><input type="text" style="border-color: transparent" name="inputs[{{$key}}][kode]" value="{{ old('name',$post->kode) }}"></td>
                      <td><input type="text" style="border-color: transparent" name="inputs[{{$key}}][name]" value="{{ old('name',$post->name) }}"></td>
                      <td align="center">
                      <select class="form-control" name="inputs[{{$key}}][milih]">
                          @forelse ($bobots as $bobot)
                              <option value="{{$bobot->id}}">{{$bobot->name}}</option>
                              @empty
                              <option>kosong</option>
                          @endforelse
                      </select>
                    </tr>                  
                  @empty
                  <div class="alert alert-danger">
                      Data Post belum Tersedia.
                  </div>
                  @endforelse
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Kode</th>
                      <th>Gejala</th>
                      <th align="center">Jika Iya</th>
                    </tr>
                  </tfoot>
                </table>
                
                {{-- {{ $posts->links() }} --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
      <!-- /.content -->
    </div>
    <!-- /.container-fluid -->
  </section>
</form>

  <script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
  </script>
@endsection    