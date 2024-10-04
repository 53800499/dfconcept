{{-- @extends('layout.app1')

@section('title')
    Ajouter Catégorie
@endsection
@section('contenu')
        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
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
                  <h4 class="card-title">Ajouter catégorie</h4>
                  <form class="cmxform" id="commentForm" method="POST" action="{{ route('sauvercategorie') }} " enctype="multipart/form-data">
                    {{csrf_field()}}
                     {{-- <fieldset> 
                      <div class="form-group">
                        <label for="cname">Nom de la catégorie</label>
                        <input id="cname" class="form-control" name="category_name" minlength="2" type="text" >
                      </div>
                      <input class="btn btn-primary" type="submit" value="Ajouter">
                    </fieldset>
                  </form>  
                </div>
              </div>
            </div>
          </div>
@endsection --}}

@extends('layout.app1')
@section('tilte')
    Edits catégorie
@endsection
@section('contenu')
        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
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
                  <h4 class="card-title">Ajouter catégorie</h4>
                  <form class="cmxform" id="commentForm" method="POST" action="{{ url('/modifiercategory/'.$categorie->id) }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                     {{-- <fieldset> --}}
                      <div class="form-group">
                        <label for="cname">Nom de la catégorie</label>
                        <input id="cname" class="form-control" value="{{$categorie->category_name}}" name="category_name" minlength="2" type="text" >
                      </div>
                      <input class="btn btn-primary" type="submit" value="Modifier">
                    </fieldset>
                  </form>  
                </div>
              </div>
            </div>
          </div>
@endsection{{-- 
@section('scripts')
<script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script>
@endsection --}}