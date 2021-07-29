<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

    body{
        padding: 100px;
    }
</style>
</head>
<body>

<!--Add Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('products/'.$products->id.'/product-model')}}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-body">
      
      
                <div class="form-group">
                  <label for="name">Name</label>  
                    <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Enter Model name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                        <label for="file">Choose Image</label>
                        <input type="file" name="image" 
                        class="form-control @error('image') is-invalid @enderror" onchange="previewFile(this)">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="previewImg" alt="profile image" style="max-width:130px;margin-top:20px;"/>
                    </div>

                

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>







<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Models of <b class="text-muted">{{ $products->name }}</b></h5>
                   
                   <!-- Button trigger modal -->
                    <a href="" data-toggle="modal" data-target="#exampleModal"><button type="button" class="btn btn-info float-right mb-3" >
                     Add New Model
                    </button></a>

                    @if(Session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <strong>{{ Session('success') }}</strong>
                        <button class="close" data-dismiss="alert">&times;</button>
                       
                    </div>
                    @endif


                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                           
                        </tr>
                        <tbody>
                        
                        @foreach($product_models as $product_model)
                        
                        
                        
                        <tr>
                            <td>{{ $product_model->id }}</td>
                            <td><img src="{{asset('images')}}/{{$product_model->image}}" style="max-width:75px;"/> </td>
                            <td>{{ $product_model->name }}</td>
                            
                            <td>
                              
                                    <!--Edit Modal -->
                              <div class="modal fade" id="editModal{{$product_model->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Model</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="{{url('products/'.$product_model->id.'/product-model/')}}" method="POST" enctype="multipart/form-data">
                                              {{ csrf_field() }}
                                              {{ method_field('PUT') }}
                                              <div class="modal-body">
                                              
                                              
                                                        <div class="form-group">
                                                          <label for="name">Name</label>  
                                                            <input type="text" name="name"  id="name" value="{{$product_model->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Model name" >
                                                            @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                             @enderror
                                                        </div>

                                                        <div class="form-group">
                                                        <label for="file">Choose Image</label>
                                                        <input type="file" name="image" 
                                                        class="form-control @error('image') is-invalid @enderror" onchange="previewFile(this)">
                                                        @error('image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                            <img id="previewImg" alt="profile image" src="{{asset('images')}}/{{$product_model->image}}"  style="max-width:130px;margin-top:20px;"/>

                                                            
                                                        </div>

                                                        

                                                </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    
                                    <form action="{{url('products/'.$product_model->id.'/product-model/')}}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#editModal{{$product_model->id}}">Edit</button>
                                    <button type="submit" class="btn btn-danger btn-md" onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                    </form>
                        </td>
                        </tr>
                       @endforeach
                        
                        </tbody>
                        
                    </table>
                    {{ $product_models->links() }}
            </div>
            
        </div>
    </div>

  
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function previewFile(input){
      var file=$("input[type=file]").get(0).files[0];
      if(file){
        var reader = new FileReader();
        reader.onload = function(){
          $('#previewImg').attr("src",reader.result);
        }
        reader.readAsDataURL(file);
      }
    }
</script>


</body>
</html>