@extends('home')
@section('contents')
  <section class="content">
    <div class="container">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable {{ucfirst(Request::segment(1))}}</h3>
                <div class="card-tools">
                  @if (ucfirst(Request::segment(1)) == 'Konsultasi')
                    <button onclick="location.href='{{route('user.create')}}'" type="button" class="btn btn-tool">
                      <i class="fas fa-save"></i>
                      <b>Mengecek</b>
                    </button>
                  @endif
                </div>  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Gejala</th>
                    <th align="center">Jika Iya</th>
                  </tr>
                  </thead>
                  <tbody>  
                  @forelse ($posts as $post)
                    <tr>
                      @switch(Request::segment(1))
                          @case('konsultasi')
                                <td><input type="text" style="border-color: transparent" name="kode" value={{$post->kode}} disabled> </td>
                                <td><input type="text" style="border-color: transparent" name="gejala" value={{$post->name}} disabled></td>
                                <td align="center"><input type="checkbox" name="iya"></td>
                              @break
                          @case('informasi')
                              <td>{{$post->kode}}</td>
                              <td>{{$post->name}}</td>
                              @break
                          @default
                              
                      @endswitch
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
  
  <script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
  </script>

@endsection    