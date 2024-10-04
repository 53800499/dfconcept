@extends('layout.app1')

@section('title')
    Slider
@endsection
<input type="hidden" name="" value="{{$increment=1}}">

@section('contenu')
  <!-- partial -->
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Slider</h4>
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
                        <th>Image</th>
                        <th>Description 1</th>
                        <th>Description 2</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($slider as $slider)
                    <tr>
                      <td>{{$increment}}</td>
                      <td><img src="storage/slider_images/{{$slider->slider_image}}" alt=""></td>
                      <td>{{$slider->description1}}</td>
                      <td>{{$slider->description2}}</td>
                      <td>
                        <label class="badge badge-info">Activer</label>
                      </td>
                      <td>
                        <button class="btn btn-outline-primary" onclick="window.location='{{url('/editslider/'.$slider->id)}}'">Edit</button>
                        <a href="{{url('/supprimerslider/'.$slider->id)}}"  id="delete" class="btn btn-outline-danger">Delete</a>
                        @if ($slider->status==1)
                        <button class="btn btn-outline-warning" onclick="window.location='{{url('desactiver_slider/'.$slider->id)}}'">Désactiver</button>      
                        @else
                        <button class="btn btn-outline-success" onclick="window.location='{{url('activer_slider/'.$slider->id)}}'">activer</button> 
                        @endif
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