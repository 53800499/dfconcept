@extends('layout.app1')
@section('tilte')
    Ajouter slider
@endsection
@section('contenu')
        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter slider</h4>
                  @if (Session::has('status'))
                  <div class="alert alert-success">
                      {{Session::get('status')}}
                  </div>
                  @endif
                  @if (count($errors)>0)
                  <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{$error}}</li>
                      @endforeach
                </ul>
                  </div>
                  @endif
                  
                  <form class="cmxform" id="commentForm" method="post" action="{{ action('SliderController@sauverslider') }}"  enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group">
                        <label for="cname">Description 1</label>
                        <input id="cname" class="form-control" name="description1" minlength="2" type="text" >
                      </div>
                      <div class="form-group">
                        <label for="cname">Description 2</label>
                        <input id="cname" class="form-control" name="description2" minlength="2" type="text" >
                      </div>
                      <div class="form-group">
                        <label for="cname">Image </label>
                        <input id="cname" class="form-control" name="slider_image" minlength="2" type="file" >
                      </div>
                   
                      
                      <input class="btn btn-primary" type="submit" value="Ajouter">
                    </fieldset>
                  </form>  
                </div>
              </div>
            </div>
          </div>
@endsection
{{-- @section('scripts')
<script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script>
@endsection --}}