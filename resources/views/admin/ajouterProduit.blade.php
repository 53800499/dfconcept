@extends('layout.app1')
@section('tilte')
    Ajouter produit
@endsection
@section('contenu')

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter produit</h4>
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
                  <form class="cmxform" id="commentForm" method="post" action="{{ action('ProductController@sauverproduit') }}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                      <div class="form-group">
                        <label for="cname">Nom du produit</label>
                        <input id="cname" class="form-control" name="product_name" minlength="2" type="text" >
                      </div>
                      <div class="form-group">
                        <label for="cname">Prix du produi</label>
                        <input id="cname" class="form-control" name="product_price" minlength="2" type="number" >
                      </div>
                      <div class="form-group">
                        <label for="cname">Categorie du produit</label>
                        <select name="product_category" class="form-control">
                             <option value="" selected null>Select categorie</option>
                            @foreach ($categorie  as $key => $value)
                                <option value="{{ $key }}">{{ $value}}</option>
                            @endforeach
                        </select>
                      </div> 
                      <div class="form-group">
                        <label for="cname">Image du produit</label>
                        <input id="cname" class="form-control" name="product_image" minlength="2" type="file" >
                      </div>

                      <input class="btn btn-primary" type="submit" value="Ajouter">
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