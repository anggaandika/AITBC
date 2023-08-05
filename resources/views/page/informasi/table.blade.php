@extends('home')
@section('contents')
  <section class="content">
    <div class="container">
        <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable {{ucfirst(Request::segment(1))}}</h3>
                <div class="card-tools">
                </div>  
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Penyakit</th>
                    <th>Solusi</th>
                  </tr>
                  </thead>
                  <tbody>  
                  @forelse ($posts as $post)
                    <tr>
                        <td>{{$post->name}}</td>
                        <td>{{$post->solusi}}</td>
                    </tr>                  
                  @empty
                  <div class="alert alert-danger">
                      Data Post belum Tersedia.
                  </div>
                  @endforelse
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Penyakit</th>
                    <th>Solusi</th>
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