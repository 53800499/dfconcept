@extends('layout.app1')

@section('title')
    Catégories
@endsection
<input type="hidden" name="" value="{{$increment=1}}">

@section('contenu')
  <!-- partial -->
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Categories</h4>
          @if (Session::has('status'))
          <div class="alert alert-success">
              {{Session::get('status')}}
          </div>
          @endif
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Nom de la categorie</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categorie as $categorie)
                    <tr>
                      <td>{{$increment}}</td>
                      <td>{{$categorie->category_name}}</td>
                     {{--  <td>
                        <label class="badge badge-info">On hold</label>
                      </td> --}}
                      <td>
                        <button class="btn btn-outline-primary" onclick="window.location='{{url('/editcategory/'.$categorie->id)}}'">Edit</button>
                         <a href="{{url('/supprimercategory/'.$categorie->id)}}"  id="delete" class="btn btn-outline-danger">Delete</a>

                      </td>
                   </tr>
                   <input type="hidden" name="" value="{{$increment=$increment+1}}">
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              </div>
            </div>
      </div>
 
@endsection
@section('scripts')
    <script src="backend/js/data-table.js"></script>
@endsection